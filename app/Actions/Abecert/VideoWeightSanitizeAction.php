<?php

namespace App\Actions\Abecert;

use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VideoWeightSanitizeAction
{
    public static function execute(): bool
    {
        try {
            // Get all videos
            if(Auth::user()?->hasActiveSubscription()) 
            {
                $videos = Video::orderBy('weight', 'asc')->get();
            } 
            else 
            {
                $videos = Video::orderByDesc('free')->orderBy('weight', 'asc')->get();
            }
            
            if ($videos->isEmpty()) {
                return true;
            }
            
            // Extract all weights and remove duplicates
            $weights = $videos->pluck('weight')->unique()->values()->toArray();
            
            // Create a mapping from old weights to new integer weights
            $weightMap = [];
            foreach ($weights as $index => $weight) {
                $weightMap[$weight] = $index + 1; // Start from 1
            }
            
            // Update all videos with new weights
            DB::beginTransaction();
            try {
                foreach ($videos as $video) {
                    $video->weight = $weightMap[$video->weight];
                    $video->save();
                }
                DB::commit();
                return true;
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } catch (\Exception $e) {
            Log::error('Failed to sanitize video weights: ' . $e->getMessage());
            return false;
        }
    }
}
