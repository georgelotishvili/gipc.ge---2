<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the user has already commented or rated this certificate
        if ($request->input('commentable_type') === 'App\\Models\\Certificate') {
            $existingComment = Comment::where('user_id', Auth::id())
                ->where('commentable_id', $request->input('commentable_id'))
                ->where('commentable_type', 'App\\Models\\Certificate')
                ->exists();
                
            $existingRating = Rating::where('user_id', Auth::id())
                ->where('certificate_id', $request->input('commentable_id'))
                ->exists();
                
            if ($existingComment || $existingRating) {
                return redirect()->back()->with('error', 'You have already commented or rated this certificate.');
            }
        }
        $request->validate([
            'content' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = Auth::user()->id;
        $comment->commentable_id = $request->input('commentable_id');
        $comment->commentable_type = $request->input('commentable_type');
        $comment->save();

        // Create a rating if the commentable type is a certificate
        if ($request->input('commentable_type') === 'App\\Models\\Certificate') {
            $rating = new Rating();
            $rating->certificate_id = $request->input('commentable_id');
            $rating->user_id = Auth::user()->id;
            $rating->stars = $request->input('rating');
            $rating->save();

            // Calculate the average rating for the certificate
            $certificateId = $request->input('commentable_id');
            $this->calculateAverageRating($certificateId);
        }
        
        return redirect()->back()->with('success', 'Your comment and rating have been submitted successfully.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $certificateId = $comment->commentable_id;
        // Check if the comment was for a certificate and delete associated rating
        if ($comment->commentable_type === 'App\\Models\\Certificate') {
            // Find and delete the rating associated with this user and certificate
            $rating = Rating::where('certificate_id', $comment->commentable_id)
                  ->where('user_id', Auth::id())
                  ->first();
                  
            if ($rating) {
                $rating->delete();
            }
        }
        $comment->delete();
        $this->calculateAverageRating($certificateId);
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    /**
     * Calculate the average rating for a certificate.
     * 
     * @param int $certificateId
     * @return void
     */
    private function calculateAverageRating($certificateId)
    {
        $certificate = Certificate::find($certificateId);
        if ($certificate)
        {
            // Get all ratings for this certificate
            $averageRating = Rating::where('certificate_id', $certificateId)
                ->avg('stars');
                        
            // Update the stars count based on the new average rating
            $certificate->stars = round($averageRating);
            
            // Save the updated certificate
            $certificate->save();
        }
    }
}
