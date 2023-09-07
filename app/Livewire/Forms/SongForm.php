<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use App\Models\Song;
use Livewire\Form;

class SongForm extends Form
{
    #[Rule('required')]
    public $request = '';

    #[Rule('required')]
    public $requester = '';

    #[Rule('required')]
    public $extra_life = '';

    #[Rule('required')]
    public $donation = '';

    public function store()
    {
        Song::create($this->all());

        $this->reset();
        $this->extra_life = false;
    }
}
