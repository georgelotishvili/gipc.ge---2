<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = Certificate::all();
        return view('certificated-specialists', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $specialities = Speciality::all();
        return view('certificated-specialists.create', compact('users', 'specialities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $attributes = $request->validate([
           'user_id' => 'required|exists:users,id',
            'speciality_id' => 'required|exists:specialities,id',
            'certificate_number' => 'required|string|max:255',
            'release_date' => 'required|date',
            'lifetime_years' => 'required|integer|min:1',
            'status' => 'required|in:active,suspended,terminated,expired',
            'location' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'social' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'score' => 'nullable|numeric|min:0|max:100',
            'rate' => 'nullable|numeric|min:0|max:100',
            'jury_count' => 'nullable|integer|min:0',
            'stars' => 'nullable|integer|min:0|max:5',
        ]);
        
        $certificate = Certificate::create($attributes);
        return redirect()->route('certificated-specialists')->with('success', 'Certificate created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        return view('certificated-specialists.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Certificate $certificate)
    {
        $users = User::all();
        $specialities = Speciality::all();
        return view('certificated-specialists.edit', compact('certificate', 'users', 'specialities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        $attributes = $request->validate([
            'user_id' => 'required|exists:users,id',
            'speciality_id' => 'required|exists:specialities,id',
            'certificate_number' => 'required|string|max:255',
            'release_date' => 'required|date',
            'lifetime_years' => 'required|integer|min:1',
            'status' => 'required|in:active,suspended,terminated,expired',
            'location' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'social' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'score' => 'nullable|numeric|min:0|max:100',
            'rate' => 'nullable|numeric|min:0|max:100',
            'jury_count' => 'nullable|integer|min:0',
            'stars' => 'nullable|integer|min:0|max:5',
        ]);
        
        $certificate->update($attributes);
        return redirect()->route('certificated-specialists')->with('success', 'Certificate updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return redirect()->route('certificated-specialists')->with('success', 'Certificate deleted successfully');
    }
}
