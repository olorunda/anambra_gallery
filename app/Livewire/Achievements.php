<?php

namespace App\Livewire;

use App\Models\Achievement;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Achievements extends Component
{
    #[Layout('components.layouts.public', ['header_title' => 'Our Achievements', 'header_subtitle' => 'Celebrating the milestones and progress of Anambra State.'])]
    public function render()
    {
        $achievements = Achievement::latest()->get(); // Verify if pagination is needed based on original file
        return view('livewire.achievements', compact('achievements'));
    }
}
