<?php

namespace App\Livewire\Admin;

use GuzzleHttp\Client;
use Livewire\Component;

class VideoCard extends Component
{
    public $video;
    public $course;
    public $chapter;
    public $videoData;
    public $weight;

    public function mount()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://video.bunnycdn.com/library/382670/videos/'.$this->video->video_id, [
            'headers' => [
                'AccessKey' => config('video.api_key'),
                'accept' => 'application/json',
            ],
        ]);

        $this->videoData = json_decode($response->getBody(), true);
        $this->weight = $this->video->weight;
    }

    public function updateWeight()
    {
        $this->validate([
            'weight' => 'nullable|numeric|min:0'
        ]);

        $this->video->update([
            'weight' => $this->weight
        ]);

        $this->dispatch('weight-updated');
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

    public function render()
    {
        return view('livewire.admin.video-card');
    }
}
