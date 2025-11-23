<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreExecutiveCouncilMemberRequest;
use App\Http\Requests\Admin\UpdateExecutiveCouncilMemberRequest;
use App\Models\ExecutiveCouncilMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExecutiveCouncilMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = ExecutiveCouncilMember::orderBy('display_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.executive-council-members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.executive-council-members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExecutiveCouncilMemberRequest $request)
    {
        $validated = $request->validated();

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (ExecutiveCouncilMember::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Set default display_order if not provided
        if (!isset($validated['display_order'])) {
            $validated['display_order'] = ExecutiveCouncilMember::max('display_order') + 1;
        }

        // Handle checkbox value
        $validated['is_active'] = $request->has('is_active');

        $member = ExecutiveCouncilMember::create($validated);

        return redirect()
            ->route('admin.executive-council-members.index')
            ->with('success', 'Executive council member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExecutiveCouncilMember $executive_council_member)
    {
        return view('admin.executive-council-members.show', [
            'member' => $executive_council_member
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExecutiveCouncilMember $executive_council_member)
    {
        return view('admin.executive-council-members.edit', [
            'member' => $executive_council_member
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExecutiveCouncilMemberRequest $request, ExecutiveCouncilMember $executive_council_member)
    {
        $validated = $request->validated();

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Ensure unique slug (excluding current record)
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (ExecutiveCouncilMember::where('slug', $validated['slug'])
            ->where('id', '!=', $executive_council_member->id)
            ->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle checkbox value
        $validated['is_active'] = $request->has('is_active');

        $executive_council_member->update($validated);

        return redirect()
            ->route('admin.executive-council-members.show', $executive_council_member)
            ->with('success', 'Executive council member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExecutiveCouncilMember $executive_council_member)
    {
        $memberName = $executive_council_member->name;
        $executive_council_member->delete();

        return redirect()
            ->route('admin.executive-council-members.index')
            ->with('success', "Executive council member '{$memberName}' deleted successfully.");
    }
}
