<?php

namespace App\Livewire;

use App\Models\ExecutiveCouncilMember;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class ExecutiveCouncilMembers extends Component
{
    use WithPagination;

    #[Layout('components.layouts.public', ['header_title' => 'Members of Executive Council', 'header_subtitle' => 'Meet the members driving the state\'s governance and development.'])]
    public function render()
    {
        $members = ExecutiveCouncilMember::active()->excludegov()->ordered()->simplePaginate(10);
        return view('livewire.executive-council-members', compact('members'));
    }
}
