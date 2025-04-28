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
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'speciality_id' => 'required|exists:specialities,id',
            'certificate_number' => 'required|string|max:255',
            'expiration_date' => 'required|date',
        ]);
        
        $certificate = Certificate::create($request->all());
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
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'speciality_id' => 'required|exists:specialities,id',
            'certificate_number' => 'required|string|max:255',
            'expiration_date' => 'required|date',
        ]);
        
        $certificate->update($request->all());
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
