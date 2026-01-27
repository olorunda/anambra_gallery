<?php

namespace App\Livewire;

use App\Models\Achievement as AchievementModel;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Achievement extends Component
{
    public $slug;
    public $achievement;
    public $relatedAchievements;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->achievement = AchievementModel::where('slug', $slug)->firstOrFail();
        
        // Fetch related achievements (logic from current view/controller)
        $this->relatedAchievements = AchievementModel::where('id', '!=', $this->achievement->id)
            ->where('category', $this->achievement->category)
            ->take(3)
            ->get();
    }

    #[Layout('components.layouts.public', ['header_title' => 'Achievements', 'header_subtitle' => 'Showcasing major infrastructure projects from the governor\'s tenure.'])]
    public function render()
    {
        return view('livewire.achievement');
    }
}
