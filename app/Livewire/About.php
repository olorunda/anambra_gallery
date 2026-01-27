<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Page;
use Livewire\Attributes\Layout;

class About extends Component
{
    #[Layout('components.layouts.public', ['header_title' => 'About Anambra', 'header_subtitle' => 'The Light of the Nation'])]
    public function render()
    {
        $page = Page::where('slug', 'about')->where('is_active', true)->first();
        return view('livewire.about', compact('page'));
    }
}
