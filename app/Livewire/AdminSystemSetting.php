<?php

namespace App\Livewire;

use Livewire\Component;

class AdminSystemSetting extends Component
{
    public $systemSetting;
    public $key;
    public $value;

    public function mount($systemSetting)
    {
        $this->systemSetting = $systemSetting;
        $this->key = $systemSetting->key;
        $this->value = $systemSetting->value;
    }

    protected $rules = [
        'key' => 'required|string|max:255',
        'value' => 'required|string|max:255',
    ];

    public function updatedKey($key)
    {
        $this->validateOnly($key);
        $this->key = $key;
    }

    public function updatedValue($value)
    {
        $this->validateOnly($value);
        $this->value = $value;
    }

    public function saveParameter()
    {
        $this->validate();
        
        $this->systemSetting->key = $this->key;
        $this->systemSetting->value = $this->value;
        $this->systemSetting->save();
        
        session()->flash('message', 'პარამეტრი წარმატებით განახლდა');
    }

    public function deleteParameter()
    {
        $this->systemSetting->delete();
        $this->dispatch('systemSettingDeleted');
        session()->flash('message', 'პარამეტრი წარმატებით წაიშალა');
    }

    public function render()
    {
        return view('livewire.admin-system-setting');
    }
}
