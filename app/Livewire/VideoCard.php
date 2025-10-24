<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class VideoCard extends Component
{
    public $video;
    public $weight;
    public $style = 'grid'; // 'grid' or 'list'

    public function mount($style = 'grid')
    {
        $this->weight = $this->video->weight;
        $this->style = $style;
    }

    public function getFormattedDuration()
    {
        if (!isset($this->video->duration)) {
            return '00:00:00';
        }
        
        $hours = floor($this->video->duration / 3600);
        $minutes = floor(($this->video->duration % 3600) / 60);
        $seconds = $this->video->duration % 60;
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function updateWeight()
    {
        if (!Auth::user()?->is_admin) {
            return;
        }

        $this->validate([
            'weight' => 'nullable|numeric|min:0'
        ]);

        $this->video->update([
            'weight' => $this->weight
        ]);

        $this->dispatch('weight-updated');
    }

    public function getIsLockedProperty(): bool
    {
        $user = Auth::user();
        if (!$user) {
            return true;
        }
        if ($user->hasActiveSubscription()) {
            return false;
        }
        return !$this->video->free;
    }

    public function render()
    {
        return view('livewire.video-card');
    }
}
