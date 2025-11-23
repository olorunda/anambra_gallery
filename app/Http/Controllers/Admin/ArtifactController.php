<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArtifactRequest;
use App\Http\Requests\Admin\UpdateArtifactRequest;
use App\Models\Artifact;
use Illuminate\Http\Request;
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
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Set default sort_order if not provided
        if (!isset($validated['sort_order'])) {
            $validated['sort_order'] = Artifact::max('sort_order') + 1;
        }

        // Handle checkbox value
        $validated['is_active'] = $request->has('is_active');

        $artifact = Artifact::create($validated);

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
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle checkbox value
        $validated['is_active'] = $request->has('is_active');

        $artifact->update($validated);

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
}
