<?php

namespace App\Http\Controllers;

use App\Actions\Abecert\SaveImageAction;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the employees.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created employee profile in storage.
     *
     * @param  \App\Http\Requests\EmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        // The request is already validated
        $validated = $request->validated();
        
        // Create employee
        $user = Auth::user();
        $employee = $user->employees()->create($validated);

        if ($request->hasFile('image')) {
            $image = SaveImageAction::execute($request->file('image'));
            
            $employee->image()->save($image);
        }
        
        return redirect()->route('employees')
            ->with('success', 'თანამშრომელი წარმატებით დაემატა');
    }

    /**
     * Display the specified employee profile.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee profile.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        // Check if the current user is the owner of this profile
        if (Auth::user()->id !== $employee->user_id) {
            return redirect()->route('employees')->with('error', 'Unauthorized action.');
        }

        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee profile in storage.
     *
     * @param  \App\Http\Requests\EmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        // The request is already validated
        $validated = $request->validated();
        
        // Update employee
        $employee->update($validated);
        
        // Handle image upload if present
        if ($request->hasFile('image')) {
            $image = SaveImageAction::execute($request->file('image'));
            
            $employee->image()->save($image);
        }
        
        return redirect()->route('employees')
            ->with('success', 'თანამშრომელი წარმატებით განახლდა');
    }

    /**
     * Remove the specified employee profile from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        // Check if the current user is the owner of this profile
        if (Auth::user()->id !== $employee->user_id) {
            return redirect()->route('employees')->with('error', 'Unauthorized action.');
        }

        // Delete image if exists
        if ($employee->image) {
            Storage::delete('public/' . $employee->image);
        }

        $employee->delete();
        return redirect()->route('employees')->with('success', 'Employee profile deleted successfully!');
    }
}
