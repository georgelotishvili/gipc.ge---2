<?php

namespace App\Http\Controllers;

use App\Actions\Abecert\SaveImageAction;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
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
     * Show the form for creating a new employee job listing.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobs.create-employee');
    }

    /**
     * Store a newly created employee job listing in storage.
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
        // Check if the user already has 5 or more employees
        if ($user->employees()->count() >= 5) {
            return redirect()->route('jobs', ['tab' => 'seeking'])
                ->with('error', 'თქვენ უკვე გაქვთ 5 ან მეტი რეზიუმე. გთხოვთ წაშალოთ ძველი რეზიუმე ახლის დამატებამდე.');
        }
        $employee = $user->employees()->create($validated);

        if ($request->hasFile('image')) {
            $image = SaveImageAction::execute($request->file('image'));
            
            $employee->image()->save($image);
        }
        
        return redirect()->route('jobs', ['tab' => 'seeking'])
            ->with('success', 'რეზიუმე წარმატებით დაემატა');
    }

    /**
     * Display the specified employee job listing.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('jobs.show-employee', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee job listing.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        if (!$this->canManageListing($employee->user_id)) {
            return redirect()->route('jobs')->with('error', 'Unauthorized action.');
        }

        return view('jobs.edit-employee', compact('employee'));
    }

    /**
     * Update the specified employee job listing in storage.
     *
     * @param  \App\Http\Requests\EmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        if (!$this->canManageListing($employee->user_id)) {
            return redirect()->route('jobs')->with('error', 'Unauthorized action.');
        }

        // The request is already validated
        $validated = $request->validated();
        
        // Update employee
        $employee->update($validated);
        
        // Handle image upload if present
        if ($request->hasFile('image')) {
            $employee->deleteImages();
            $image = SaveImageAction::execute($request->file('image'));
            
            $employee->image()->save($image);
        }
        
        return redirect()->route('jobs', ['tab' => 'seeking'])
            ->with('success', 'რეზიუმე წარმატებით განახლდა');
    }

    /**
     * Remove the specified employee job listing from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if (!$this->canManageListing($employee->user_id)) {
            return redirect()->route('jobs')->with('error', 'Unauthorized action.');
        }

        $employee->delete();
        return redirect()->route('jobs', ['tab' => 'seeking'])->with('success', 'რეზიუმე წარმატებით წაიშალა');
    }

    private function canManageListing(int $ownerId): bool
    {
        $user = Auth::user();

        return $user && ($user->id === $ownerId || (bool) $user->is_admin);
    }
}
