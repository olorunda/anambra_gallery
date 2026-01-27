<?php

namespace App\Livewire;

use App\Models\Artifact as ArtifactModel;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Artifact extends Component
{
    public $slug;
    public $artifact;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->artifact = ArtifactModel::where('slug', $slug)->firstOrFail();
    }

    #[Layout('components.layouts.public', ['header_title' => 'History & Culture of Anambra', 'header_subtitle' => 'Discover the rich history and vibrant culture that define Anambra'])]
    public function render()
    {
        return view('livewire.artifact');
    }
}
