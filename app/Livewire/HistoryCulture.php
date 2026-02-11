<?php

namespace App\Livewire;

use App\Models\Artifact;
use Livewire\Component;
use Livewire\Attributes\Layout;

class HistoryCulture extends Component
{
    #[Layout('components.layouts.public', ['header_title' => 'History & Culture of Anambra', 'header_subtitle' => 'Discover the rich history and vibrant culture that define Anambra'])]
    public function render()
    {
        $artifacts = Artifact::latest()->get(); 
        
        return view('livewire.history-culture', compact('artifacts'));
    }
}
