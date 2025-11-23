<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArtifactRequest;
use App\Http\Requests\Admin\UpdateArtifactRequest;
use App\Models\Artifact;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtifactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artifacts = Artifact::orderBy('sort_order')
            ->orderBy('title')
            ->paginate(15);

        return view('admin.artifacts.index', compact('artifacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.artifacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtifactRequest $request)
    {
        $validated = $request->validated();

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Artifact::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug.'-'.$counter;
            $counter++;
        }

        // Set default sort_order if not provided
        if (! isset($validated['sort_order'])) {
            $validated['sort_order'] = Artifact::max('sort_order') + 1;
        }

        // Handle checkbox value
        $validated['is_active'] = $request->has('is_active');

        $artifact = Artifact::create($validated);

        // Handle image uploads
        $this->handleImageUploads($artifact, $request);

        return redirect()
            ->route('admin.artifacts.index')
            ->with('success', 'Artifact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artifact $artifact)
    {
        return view('admin.artifacts.show', compact('artifact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artifact $artifact)
    {
        return view('admin.artifacts.edit', compact('artifact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArtifactRequest $request, Artifact $artifact)
    {
        $validated = $request->validated();

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Ensure unique slug (excluding current record)
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Artifact::where('slug', $validated['slug'])
            ->where('id', '!=', $artifact->id)
            ->exists()) {
            $validated['slug'] = $originalSlug.'-'.$counter;
            $counter++;
        }

        // Handle checkbox value
        $validated['is_active'] = $request->has('is_active');

        $artifact->update($validated);

        // Handle existing images management
        $this->handleExistingImages($artifact, $request);

        // Handle new image uploads
        $this->handleImageUploads($artifact, $request);

        return redirect()
            ->route('admin.artifacts.show', $artifact)
            ->with('success', 'Artifact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artifact $artifact)
    {
        $artifactTitle = $artifact->title;
        $artifact->delete();

        return redirect()
            ->route('admin.artifacts.index')
            ->with('success', "Artifact '{$artifactTitle}' deleted successfully.");
    }

    /**
     * Handle uploaded images for an artifact
     */
    private function handleImageUploads(Artifact $artifact, Request $request): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        $images = $request->file('images');
        $altTexts = $request->input('image_alt_texts', []);
        $sortOrder = $artifact->images()->max('sort_order') ?? 0;

        foreach ($images as $index => $image) {
            // Store the image
            $path = $image->store('artifacts', 'public');
            $url = Storage::url($path);

            // Create image record
            $artifact->images()->create([
                'url' => $url,
                'alt_text' => $altTexts[$index] ?? null,
                'sort_order' => ++$sortOrder,
            ]);
        }
    }

    /**
     * Handle existing images management during update
     */
    private function handleExistingImages(Artifact $artifact, Request $request): void
    {
        $existingImageIds = $request->input('existing_image_ids', []);
        $existingAltTexts = $request->input('existing_alt_texts', []);

        // Remove images that are not in the existing_image_ids array
        $artifact->images()->whereNotIn('id', $existingImageIds)->each(function ($image) {
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
            $artifact->images()->where('id', $imageId)->update(['alt_text' => $altText]);
        }
    }
}
