<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Song;

class Queue extends Component
{
    public $songs;

    public function mount()
    {
        $this->songs = Song::all();
    }

    public function render()
    {
        return view('livewire.queue');
    }
}
