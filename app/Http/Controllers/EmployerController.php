<?php

namespace App\Http\Controllers;

use App\Actions\Abecert\SaveImageAction;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EmployerRequest;
use App\Models\Employee;

class EmployerController extends Controller
{
    /**
     * Display a listing of the employers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employers = Employer::all();
        $employees = Employee::all();
        return view('jobs', compact('employers', 'employees'));
    }

    /**
     * Show the form for creating a new employer job listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create-employer');
    }

    /**
     * Store a newly created employer job listing in storage.
     *
     * @param  \App\Http\Requests\EmployerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployerRequest $request)
    {
        // The request is already validated
        $validated = $request->validated();
        
        // Create employer
        $user = Auth::user();
        // Check if the user already has 5 or more employers
        if ($user->employers()->count() >= 5) {
            return redirect()->route('jobs')
                ->with('error', 'თქვენ უკვე გაქვთ 5 ან მეტი ვაკანსია. გთხოვთ წაშალოთ ძველი ვაკანსია ახლის დამატებამდე.');
        }
        $employer = $user->employers()->create($validated);

        if ($request->hasFile('image')) {
            $image = SaveImageAction::execute($request->file('image'));
            
            $employer->image()->save($image);
        }
        
        return redirect()->route('jobs')
            ->with('success', 'დამსაქმებელი წარმატებით დაემატა');
    }

    /**
     * Display the specified employer job listing.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show(Employer $employer)
    {
        return view('jobs.show-employer', compact('employer'));
    }

    /**
     * Show the form for editing the specified employer job listing.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit(Employer $employer)
    {
        // Check if the current user is the owner of this job listing
        if (Auth::user()->id !== $employer->user_id) {
            return redirect()->route('jobs')->with('error', 'Unauthorized action.');
        }

        return view('jobs.edit-employer', compact('employer'));
    }

    /**
     * Update the specified employer job listing in storage.
     *
     * @param  \App\Http\Requests\EmployerRequest  $request
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(EmployerRequest $request, Employer $employer)
    {
        // The request is already validated
        $validated = $request->validated();
        
        // Update employer
        $employer->update($validated);
        
        // Handle logo upload if present
        if ($request->hasFile('image')) {
            $image = SaveImageAction::execute($request->file('image'));
            
            $employer->image()->save($image);
        }
        
        return redirect()->route('jobs')
            ->with('success', 'დამსაქმებელი წარმატებით განახლდა');
    }

    /**
     * Remove the specified employer job listing from storage.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employer $employer)
    {
        // Check if the current user is the owner of this job listing
        if (Auth::user()->id !== $employer->user_id) {
            return redirect()->route('jobs')->with('error', 'Unauthorized action.');
        }

        // Delete image if exists
        if ($employer->image) {
            Storage::delete('public/' . $employer->image);
        }

        $employer->delete();
        return redirect()->route('jobs')->with('success', 'Job listing deleted successfully!');
    }
}
