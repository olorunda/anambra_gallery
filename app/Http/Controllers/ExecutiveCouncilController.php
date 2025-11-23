<?php

namespace App\Http\Controllers;

use App\Models\ExecutiveCouncilMember;
use Illuminate\Http\Request;

class ExecutiveCouncilController extends Controller
{
    public function index()
    {
        $members = ExecutiveCouncilMember::active()->ordered()->get();

        return view('executive-council', compact('members'));
    }

    public function members()
    {
        $members = ExecutiveCouncilMember::active()->ordered()->simplePaginate(10);

        return view('executive-council-members', compact('members'));
    }

    public function show(string $slug)
    {
        $member = ExecutiveCouncilMember::active()
            ->where('slug', $slug)
            ->firstOrFail();

        $totalMembers = ExecutiveCouncilMember::active()->count();
        $currentOrder = $member->id;

        // Get previous and next members for navigation
        $previousMember = ExecutiveCouncilMember::active()
            ->where('id', '<', $currentOrder)
            ->ordered()
            ->first();

        $nextMember = ExecutiveCouncilMember::active()
            ->where('id', '>', $currentOrder)
            ->ordered()
            ->first();
        return view('executive-council-member', compact(
            'member',
            'totalMembers',
            'previousMember',
            'nextMember'
        ));
    }
}
