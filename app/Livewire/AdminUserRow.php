<?php

namespace App\Livewire;

use App\Models\Subscription;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AdminUserRow extends Component
{
    public $user;
    public $subscription;
    public $showDeleteModal = false;
    public $deleteConfirmText = '';
    public $testCounter = 0; // Simple test property

    protected $listeners = [
        'update_user_row' => 'refresh',
    ];

    public function mount(): void
    {
        $this->subscription = $this->user->subscription()->first();
    }

    public function confirmDelete()
    {
        $this->showDeleteModal = true;
        $this->deleteConfirmText = '';
    }

    public function deleteUser()
    {
        // Validate confirmation text
        if ($this->deleteConfirmText !== $this->user->email) {
            $this->addError('deleteConfirmText', 'Please type the email address correctly to confirm deletion.');
            return;
        }

        try {
            Log::info('=== STARTING USER DELETION PROCESS ===');
            Log::info('User ID: ' . $this->user->id);
            Log::info('User Email: ' . $this->user->email);
            
            DB::beginTransaction();
            
            // First, let's try to see what relationships exist
            Log::info('Checking user relationships...');
            Log::info('Exam Requests: ' . $this->user->examRequests()->count());
            Log::info('Tokens: ' . $this->user->tokens()->count());
            Log::info('Employers: ' . $this->user->employers()->count());
            Log::info('Payments: ' . $this->user->payments()->count());
            Log::info('Employees: ' . $this->user->employees()->count());
            Log::info('Subscription exists: ' . ($this->user->subscription()->exists() ? 'Yes' : 'No'));
            Log::info('Image exists: ' . ($this->user->image ? 'Yes' : 'No'));
            
            // Try to delete related data step by step
            Log::info('Deleting exam requests...');
            $this->user->examRequests()->delete();
            
            Log::info('Deleting tokens...');
            $this->user->tokens()->delete();
            
            Log::info('Deleting employers...');
            $this->user->employers()->delete();
            
            Log::info('Deleting payments...');
            $this->user->payments()->delete();
            
            Log::info('Deleting employees...');
            $this->user->employees()->delete();
            
            // Delete profile image if exists
            if ($this->user->image) {
                Log::info('Deleting profile image...');
                $this->user->image->delete();
            }
            
            // Delete the user's subscription if it exists
            if ($this->user->subscription()->exists()) {
                Log::info('Deleting subscription...');
                $this->user->subscription()->delete();
            }
            
            // Now try to force delete the user
            Log::info('Attempting to force delete user...');
            $deleted = $this->user->forceDelete();
            
            if ($deleted) {
                Log::info('User force deleted successfully!');
                $this->dispatch('user-deleted', message: 'User deleted successfully!');
                $this->dispatch('refresh-users');
            } else {
                Log::error('forceDelete() returned false');
                $this->addError('delete', 'Failed to delete user. forceDelete() returned false.');
            }
            
            DB::commit();
            Log::info('=== USER DELETION PROCESS COMPLETED ===');
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('=== USER DELETION ERROR ===');
            Log::error('Error message: ' . $e->getMessage());
            Log::error('Error file: ' . $e->getFile());
            Log::error('Error line: ' . $e->getLine());
            Log::error('Error trace: ' . $e->getTraceAsString());
            Log::error('=== END ERROR ===');
            
            $this->addError('delete', 'Error deleting user: ' . $e->getMessage());
        }
        
        $this->showDeleteModal = false;
        $this->deleteConfirmText = '';
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->deleteConfirmText = '';
        $this->resetErrorBag();
    }

    public function testDelete()
    {
        // Simple debug - this should show immediately if the method is called
        session()->flash('test_message', 'Test method called for user: ' . $this->user->email);
        
        Log::info('=== TEST DELETE METHOD CALLED ===');
        Log::info('User ID: ' . $this->user->id);
        Log::info('User Email: ' . $this->user->email);
        
        try {
            // Try to get a fresh instance of the user
            $freshUser = \App\Models\User::find($this->user->id);
            if ($freshUser) {
                Log::info('Fresh user found: ' . $freshUser->email);
                
                // Try to check if user exists in database
                $exists = \App\Models\User::where('id', $this->user->id)->exists();
                Log::info('User exists in database: ' . ($exists ? 'Yes' : 'No'));
                
                // Try to check if user is soft deleted
                $trashed = \App\Models\User::withTrashed()->find($this->user->id);
                if ($trashed) {
                    Log::info('User with trashed: ' . $trashed->email . ', Deleted at: ' . ($trashed->deleted_at ?? 'Not deleted'));
                }
                
                // Try a simple delete first
                Log::info('Attempting simple delete...');
                $deleted = $freshUser->delete();
                Log::info('Simple delete result: ' . ($deleted ? 'true' : 'false'));
                
                if ($deleted) {
                    $this->dispatch('user-deleted', message: 'Test delete successful!');
                }
            } else {
                Log::info('Fresh user not found');
            }
        } catch (\Exception $e) {
            Log::error('Test delete error: ' . $e->getMessage());
            Log::error('Error trace: ' . $e->getTraceAsString());
        }
        
        Log::info('=== TEST DELETE METHOD COMPLETED ===');
    }

    public function incrementTest()
    {
        $this->testCounter++;
        Log::info('Test counter incremented to: ' . $this->testCounter);
    }

    public function simpleTest()
    {
        // This is the simplest possible test - just update a property
        $this->testCounter = $this->testCounter + 10;
        Log::info('Simple test called, counter now: ' . $this->testCounter);
        
        // Also try to show a session message
        session()->flash('simple_test', 'Simple test worked! Counter: ' . $this->testCounter);
    }

    public function render(): View
    {
        return view('livewire.admin-user-row');
    }
}
