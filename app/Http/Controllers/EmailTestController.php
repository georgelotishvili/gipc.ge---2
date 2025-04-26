<?php

namespace App\Http\Controllers;

use App\Services\MailgunService;
use Illuminate\Http\Request;

class EmailTestController extends Controller
{
    protected $mailgun;

    public function __construct(MailgunService $mailgun)
    {
        $this->mailgun = $mailgun;
    }

    public function sendTestEmail()
    {
        $to = 'jimshitashvilinika742@gmail.com';
        $result = $this->mailgun->sendTestEmail($to);

        if ($result['success']) {
            return view('emails.success', [
                'message' => 'Test email sent successfully to ' . $to
            ]);
        } else {
            return view('emails.error', [
                'error' => $result['message'],
                'to' => $to
            ]);
        }
    }

    public function sendCustomEmail(Request $request)
    {
        // Validate request
        $request->validate([
            'to' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $result = $this->mailgun->send(
            $request->input('to'),
            $request->input('subject'),
            $request->input('message'),
            $request->input('html')
        );

        if ($result['success']) {
            return view('emails.success', [
                'message' => 'Email sent successfully to ' . $request->input('to')
            ]);
        } else {
            return view('emails.error', [
                'error' => $result['message'],
                'to' => $request->input('to')
            ]);
        }
    }
} 