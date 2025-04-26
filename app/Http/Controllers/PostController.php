<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Actions\Abecert\SaveImageAction;
use App\Actions\Abecert\DeleteImageAction;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.posts', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }


    public function create()
    {
        return view('admin.posts.create');
    }


    public function store(StorePostRequest $request)
    {
        $validatedData = $request->validated(); 
        $validatedData['slug'] = Str::slug($validatedData['title']);
        $post = Post::create($validatedData);
        $post->image()->save(SaveImageAction::execute($request->file('thumbnail'), 'posts'));
        return redirect()->route('posts.show', $post);
    }


    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }


    public function update(StorePostRequest $request, Post $post)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::slug($validatedData['title']);
        $post->update($validatedData);
        
        // Only update the image if a new one is provided
        if ($request->hasFile('thumbnail')) {
            // Delete the old image if it exists
            if ($post->image) {
                // Delete the file from storage
                if (file_exists(storage_path('app/public/' . $post->image->path))) {
                    unlink(storage_path('app/public/' . $post->image->path));
                }
                // Delete the image record
                $post->image->delete();
            }
            
            // Save the new image
            $post->image()->save(SaveImageAction::execute($request->file('thumbnail'), 'posts'));
        }
        
        return redirect()->route('posts.show', $post);
    }


    public function destroy(Post $post, DeleteImageAction $deleteImageAction)
    {   
        if ($post->image) {
            $deleteImageAction->execute($post->image);
        }   
        
        $post->delete();
        return redirect()->route('posts.index');
    }

}

