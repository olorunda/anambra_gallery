<?php

namespace App\Livewire;

use App\Models\ExecutiveCouncilMember;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ExecutiveCouncil extends Component
{
    #[Layout('components.layouts.public', ['header_title' => 'Executive Council', 'header_subtitle' => 'Meet the distinguished leaders and visionaries guiding Anambra State towards a prosperous future.'])]
    public function render()
    {
        $governor = ExecutiveCouncilMember::active()->where('position','Governor')->first();
        return view('livewire.executive-council', compact('governor'));
    }
}
