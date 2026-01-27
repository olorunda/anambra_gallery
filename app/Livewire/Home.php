<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;
use Livewire\Attributes\Layout;

class Home extends Component
{
    #[Layout('components.layouts.home')]
    public function render()
    {
        $page = Page::where('slug', 'welcome')->where('is_active', true)->first();
        return view('livewire.home', compact('page'));
    }
}
