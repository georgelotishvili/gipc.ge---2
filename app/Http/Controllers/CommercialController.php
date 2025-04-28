<?php

namespace App\Http\Controllers;

use App\Actions\Abecert\DeleteImageAction;
use App\Actions\Abecert\SaveImageAction;
use App\Models\Commercial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CommercialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commercials = Commercial::latest()->paginate(10);
        return view('admin.commercials.index', compact('commercials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.commercials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'expiration_date' => 'nullable|date',
            'weight' => 'nullable|numeric',
            'duration_weight' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = SaveImageAction::execute($request->file('image'), 'commercials');
            $data['image_link'] = $image->path;
        }

        Commercial::create($data);

        return redirect()->route('admin.commercials')
            ->with('success', 'Commercial created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Commercial $commercial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commercial $commercial)
    {
        return view('admin.commercials.edit', compact('commercial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commercial $commercial)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'expiration_date' => 'nullable|date',
            'weight' => 'nullable|numeric',
            'duration_weight' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($commercial->image_link && Storage::disk('public')->exists($commercial->image_link)) {
                Storage::disk('public')->delete($commercial->image_link);
            }

            $image = SaveImageAction::execute($request->file('image'), 'commercials');
            $data['image_link'] = $image->path;
        }

        $commercial->update($data);

        return redirect()->route('admin.commercials')
            ->with('success', 'Commercial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commercial $commercial)
    {
        // Delete image if exists
        if ($commercial->image_link && Storage::disk('public')->exists($commercial->image_link)) {
            Storage::disk('public')->delete($commercial->image_link);
        }

        // Delete image if exists
        if ($commercial->image)
        {
            DeleteImageAction::execute($commercial->image);
        }

        // Delete commercial
        $commercial->delete();

        return redirect()->route('admin.commercials')
            ->with('success', 'Commercial deleted successfully.');
    }
}
