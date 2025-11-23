<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAchievementRequest;
use App\Http\Requests\Admin\UpdateAchievementRequest;
use App\Models\Achievement;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = Achievement::orderBy('sort_order')
            ->orderBy('title')
            ->paginate(15);

        return view('admin.achievements.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.achievements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAchievementRequest $request)
    {
        $validated = $request->validated();

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Achievement::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug.'-'.$counter;
            $counter++;
        }

        // Set default sort_order if not provided
        if (! isset($validated['sort_order'])) {
            $validated['sort_order'] = Achievement::max('sort_order') + 1;
        }

        // Handle checkbox value
        $validated['is_active'] = $request->has('is_active');

        $achievement = Achievement::create($validated);

        // Handle image uploads
        $this->handleImageUploads($achievement, $request);

        return redirect()
            ->route('admin.achievements.index')
            ->with('success', 'Achievement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Achievement $achievement)
    {
        return view('admin.achievements.show', compact('achievement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Achievement $achievement)
    {
        return view('admin.achievements.edit', compact('achievement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAchievementRequest $request, Achievement $achievement)
    {
        $validated = $request->validated();

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Ensure unique slug (excluding current record)
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Achievement::where('slug', $validated['slug'])
            ->where('id', '!=', $achievement->id)
            ->exists()) {
            $validated['slug'] = $originalSlug.'-'.$counter;
            $counter++;
        }

        // Handle checkbox value
        $validated['is_active'] = $request->has('is_active');

        $achievement->update($validated);

        // Handle existing images management
        $this->handleExistingImages($achievement, $request);

        // Handle new image uploads
        $this->handleImageUploads($achievement, $request);

        return redirect()
            ->route('admin.achievements.show', $achievement)
            ->with('success', 'Achievement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achievement $achievement)
    {
        $achievementTitle = $achievement->title;
        $achievement->delete();

        return redirect()
            ->route('admin.achievements.index')
            ->with('success', "Achievement '{$achievementTitle}' deleted successfully.");
    }

    /**
     * Handle uploaded images for an achievement
     */
    private function handleImageUploads(Achievement $achievement, Request $request): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        $images = $request->file('images');
        $altTexts = $request->input('image_alt_texts', []);
        $sortOrder = $achievement->images()->max('sort_order') ?? 0;

        foreach ($images as $index => $image) {
            // Store the image
            $path = $image->store('achievements', 'public');
            $url = Storage::url($path);

            // Create image record
            $achievement->images()->create([
                'url' => $url,
                'alt_text' => $altTexts[$index] ?? null,
                'sort_order' => ++$sortOrder,
            ]);
        }
    }

    /**
     * Handle existing images management during update
     */
    private function handleExistingImages(Achievement $achievement, Request $request): void
    {
        $existingImageIds = $request->input('existing_image_ids', []);
        $existingAltTexts = $request->input('existing_alt_texts', []);

        // Remove images that are not in the existing_image_ids array
        $achievement->images()->whereNotIn('id', $existingImageIds)->each(function ($image) {
            // Delete the file from storage
            $path = str_replace('/storage/', '', $image->url);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            // Delete the database record
            $image->delete();
        });

        // Update alt texts for existing images
        foreach ($existingAltTexts as $imageId => $altText) {
            $achievement->images()->where('id', $imageId)->update(['alt_text' => $altText]);
        }
    }
}
