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
            'expiration_date' => 'nullable|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        unset($data['image']);
        $data['name'] = 'თქვენი რეკლამა';
        $data['description'] = 'რეკლამის განსათავსებლად დაგვიკავშირდით';
        $data['weight'] = 1;
        $data['duration_weight'] = 1;

        $image = null;

        if ($request->hasFile('image')) {
            $image = SaveImageAction::execute($request->file('image'), 'commercials');
            $data['img_link'] = $image->path;
        }

        $commercial = Commercial::create($data);

        if ($image) {
            $commercial->image()->save($image);
        }

        return redirect()->route('admin.commercials')
            ->with('success', 'რეკლამა წარმატებით დაემატა.');
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
            'expiration_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        unset($data['image']);

        $image = null;

        if ($request->hasFile('image')) {
            $this->deleteStoredImage($commercial);
            $image = SaveImageAction::execute($request->file('image'), 'commercials');
            $data['img_link'] = $image->path;
        }

        $commercial->update($data);

        if ($image) {
            $commercial->image()->save($image);
        }

        return redirect()->route('admin.commercials')
            ->with('success', 'რეკლამა წარმატებით განახლდა.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commercial $commercial)
    {
        $this->deleteStoredImage($commercial);

        // Delete commercial
        $commercial->delete();

        return redirect()->route('admin.commercials')
            ->with('success', 'რეკლამა წარმატებით წაიშალა.');
    }

    private function deleteStoredImage(Commercial $commercial): void
    {
        $relatedImagePath = $commercial->image?->path;

        if ($commercial->image) {
            DeleteImageAction::execute($commercial->image);
        }

        if (
            $commercial->img_link
            && $commercial->img_link !== $relatedImagePath
            && $this->isLocalStoragePath($commercial->img_link)
            && Storage::disk('public')->exists($commercial->img_link)
        ) {
            Storage::disk('public')->delete($commercial->img_link);
        }
    }

    private function isLocalStoragePath(string $path): bool
    {
        return !str_starts_with($path, 'http://')
            && !str_starts_with($path, 'https://')
            && !str_starts_with($path, '/');
    }
}
