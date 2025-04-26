<?php

namespace App\Livewire;

use App\Models\SystemSetting;
use Livewire\Component;

class AdminSystemSettings extends Component
{
    public $systemSettings;

    public $newParameterKey = '';
    public $newParameterValue = '';
    public $newParameterDescription = '';

    public function mount()
    {
        $this->systemSettings = SystemSetting::all();
    }

    public $systemSetting = [];

    protected $rules = [
        'newParameterKey' => 'required|string|max:255',
        'newParameterValue' => 'required|string|max:255',
        'newParameterDescription' => 'required|string|max:255',
    ];

    public function updated($systemSetting, $value)
    {
        $this->validateOnly($systemSetting);
    }

    public function deleteParameter($id)
    {
        $setting = SystemSetting::find($id);
        if ($setting) {
            $setting->delete();
            $this->systemSettings = SystemSetting::all();
            session()->flash('message', 'პარამეტრი წარმატებით წაიშალა');
        }
        $this->systemSettings = SystemSetting::all();
    }

    public function addParameter()
    {
        $this->validate([
            'newParameterKey' => 'required|string|max:255',
            'newParameterValue' => 'required|string|max:255',
            'newParameterDescription' => 'required|string|max:255',
        ]);

        SystemSetting::create([
            'key' => $this->newParameterKey,
            'value' => $this->newParameterValue,
            'description' => $this->newParameterDescription,
        ]);

        $this->systemSettings = SystemSetting::all();
        $this->newParameterKey = '';
        $this->newParameterValue = '';
        $this->newParameterDescription = '';
        
        session()->flash('message', 'პარამეტრი წარმატებით დაემატა');
    }

    public function render()
    {
        return view('livewire.admin-system-settings');
    }
}
