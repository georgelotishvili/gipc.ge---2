<?php

namespace App\Livewire;

use App\Models\SystemSetting;
use Livewire\Component;
use Livewire\Attributes\Rule;

class AdminSystemSettings extends Component
{
    #[Rule('required|min:3|max:255')]
    public $newParameterKey = '';

    #[Rule('required|min:1|max:255')]
    public $newParameterValue = '';

    #[Rule('nullable|max:255')]
    public $newParameterDescription = '';

    public $systemSettings = [];

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $this->systemSettings = SystemSetting::all()->toArray();
    }

    public function addParameter()
    {
        $this->validate();

        SystemSetting::create([
            'key' => $this->newParameterKey,
            'value' => $this->newParameterValue,
            'description' => $this->newParameterDescription,
        ]);

        $this->reset(['newParameterKey', 'newParameterValue', 'newParameterDescription']);
        $this->loadSettings();
        
        session()->flash('message', 'პარამეტრი წარმატებით დაემატა.');
    }

    public function saveParameter($id)
    {
        $setting = SystemSetting::find($id);
        if (!$setting) {
            return;
        }

        $index = collect($this->systemSettings)->search(function($item) use ($id) {
            return $item['id'] == $id;
        });

        if ($index === false) {
            return;
        }

        $setting->update([
            'key' => $this->systemSettings[$index]['key'],
            'value' => $this->systemSettings[$index]['value'],
            'description' => $this->systemSettings[$index]['description'],
        ]);

        $this->loadSettings();
        session()->flash('message', 'პარამეტრი წარმატებით განახლდა.');
    }

    public function deleteParameter($id)
    {
        $setting = SystemSetting::find($id);
        if ($setting) {
            $setting->delete();
            $this->loadSettings();
            session()->flash('message', 'პარამეტრი წარმატებით წაიშალა.');
        }
    }

    public function render()
    {
        return view('livewire.admin-system-settings');
    }
}
