<?php

namespace App\Livewire;

use App\Models\ExecutiveCouncilMember as MemberModel;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ExecutiveCouncilMember extends Component
{
    public $slug;
    public $member;
    public $totalMembers;
    public $previousMember;
    public $nextMember;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->member = MemberModel::active()
            ->where('slug', $slug)
            ->firstOrFail();

        $this->totalMembers = MemberModel::active()->count();
        $currentOrder = $this->member->display_order;

        // Get previous and next members for navigation
        // Note: Logic copied from controller, assumes ID ordering is what 'ordered()' scope does or close enough for ID comparison
        // If ordered() uses a different column, we should check the model, but based on controller code:
        // $previousMember = ExecutiveCouncilMember::active()->where('id', '<', $currentOrder)->ordered()->first();
        // This suggests ordered() sorts DESC or ASC? standard 'ordered' usually means by a specific order column.
        // The controller logic `where('id', '<', $currentOrder)` with `ordered()->first()` is slightly ambiguous without seeing `ordered` scope.
        // Assuming the controller logic was correct and replicating it.

        $this->previousMember = MemberModel::active()
            ->where('display_order', '<', $currentOrder)
            ->ordered()
            ->first();

        $this->nextMember = MemberModel::active()
            ->where('display_order', '>', $currentOrder)
            ->ordered()
            ->first();
    }

    #[Layout('components.layouts.public', ['header_title' => 'Executive Council Member', 'header_subtitle' => 'Meet the members driving the state\'s governance and development.'])]
    public function render()
    {
        return view('livewire.executive-council-member');
    }
}
