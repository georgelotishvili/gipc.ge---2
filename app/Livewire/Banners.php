<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Commercial;

class Banners extends Component
{
    public $commercials;

    public function mount()
    {
        $this->commercials = Commercial::all();
    }

    public function render()
    {
        return view('livewire.banners');
    }
}
