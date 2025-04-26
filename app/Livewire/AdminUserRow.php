<?php

namespace App\Livewire;

use App\Models\Subscription;
use Livewire\Component;

class AdminUserRow extends Component
{
    public $user;
    public $subscription;

    public function mount()
    {
        $this->subscription = $this->user->subscription;
    }

    public function deleteUser($userId)
    {
        
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $user = \App\Models\User::find($userId);
            if ($user) {
                // Delete the user's subscription if it exists
                if ($user->subscription)
                {
                    $user->subscription->delete();
                }
                
                // Delete the user
                $user->delete();
            }
            \Illuminate\Support\Facades\DB::commit();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            session()->flash('error', 'Error deleting user: ' . $e->getMessage());
        }
        return redirect()->route('admin.users');
    }

    public function render()
    {
        return view('livewire.admin-user-row');
    }
}
