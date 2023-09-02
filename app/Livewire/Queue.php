<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Song;

class Queue extends Component
{
    public $songs;

    public function mount()
    {
        $this->songs();
    }

    private function songs()
    {
        $this->songs = Song::orderby("extra_life", "desc")->orderby("created_at")->get();
    }

    public function delete($id)
    {
        $song = Song::findOrFail($id);
        $song->delete();
        $this->songs();
    }

    public function render()
    {
        return view('livewire.queue');
    }
}
