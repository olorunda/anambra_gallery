<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAchievementRequest;
use App\Http\Requests\Admin\UpdateAchievementRequest;
use App\Models\Achievement;
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
}
