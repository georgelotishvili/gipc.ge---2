<?php

namespace App\Actions\Abecert;

use App\Models\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SaveImageAction
{
    public static function execute(UploadedFile $image, string $path = 'images', int $maxWidth = 1920, int $maxHeight = 1080): Image 
    {
        try {
            // Create a new ImageManager instance with GD driver
            $manager = new ImageManager(new Driver());
            
            // Read the image
            $img = $manager->read($image->getRealPath());
            
            // Get dimensions
            $width = $img->width();
            $height = $img->height();

            // Calculate new dimensions while maintaining aspect ratio
            if ($width > $maxWidth || $height > $maxHeight) {
                $ratio = min($maxWidth / $width, $maxHeight / $height);
                $newWidth = round($width * $ratio);
                $newHeight = round($height * $ratio);
                $img->resize($newWidth, $newHeight);
            }
            
            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $fullPath = $path . '/' . $filename;
            
            // Start transaction
            DB::beginTransaction();

            // Store the resized image in public storage
            if (!Storage::disk('public')->put($fullPath, $img->encode()->toString())) {
                throw new \Exception('Failed to store image file');
            }
            
            // Create image record
            $imageRecord = Image::create([
                'name' => $filename,
                'path' => $fullPath
            ]);
            
            DB::commit();
            return $imageRecord;

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Clean up stored file if it exists
            if (isset($fullPath) && Storage::disk('public')->exists($fullPath)) {
                Storage::disk('public')->delete($fullPath);
            }
            
            // Re-throw the exception with more context
            throw new \Exception('Failed to process image: ' . $e->getMessage(), 0, $e);
        }
    }
}
