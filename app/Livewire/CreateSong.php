<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Song;
use App\Livewire\Forms\SongForm;

class CreateSong extends Component
{
    public SongForm $form;

    public function save()
    {
        $this->form->store();
    }

    public function render()
    {
        return view('livewire.create-song');
    }
}
