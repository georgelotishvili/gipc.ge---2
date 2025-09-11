<?php

namespace App\Http\Controllers;

use App\Actions\Abecert\CreateTestAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function start(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Check subscription status
        if (!$user->hasActiveSubscription()) {
            return redirect()->route('pricing')->with('error', 'You need an active subscription to start an exam');
        }

        // Check if user already has an active exam request
        $existingRequest = $user->examRequests()->where('closed', false)->first();
        
        if ($existingRequest) {
            if ($existingRequest->approved) {
                return redirect()->route('exam', $existingRequest);
            } else {
                return redirect()->route('workspace')->with('error', 'You already have a pending exam request');
            }
        }

        // Create new exam request
        $examRequest = $user->examRequests()->create([
            'approved' => true,
            'closed' => false,
        ]);
        
        CreateTestAction::execute($examRequest);
        
        return redirect()->route('exam', $examRequest);
    }
}
