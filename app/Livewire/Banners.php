<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Commercial;

class Banners extends Component
{
    public $commercials;

    public function mount()
    {
        $this->commercials = Commercial::query()
            ->whereNotNull('img_link')
            ->where(function ($query) {
                $query->whereNull('expiration_date')
                    ->orWhere('expiration_date', '>=', now());
            })
            ->oldest()
            ->get();
    }

    public function render()
    {
        return view('livewire.banners');
    }
}
