<?php

namespace App\Livewire;

use App\Models\Artifact;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class HistoryCulture extends Component
{
    use WithPagination;

    #[Layout('components.layouts.public', ['header_title' => 'History & Culture of Anambra', 'header_subtitle' => 'Discover the rich history and vibrant culture that define Anambra'])]
    public function render()
    {
        $artifacts = Artifact::latest()->paginate(6000); // Assuming matching the controller logic
        $total_count = Artifact::count();
        
        return view('livewire.history-culture', compact('artifacts', 'total_count'));
    }
}
