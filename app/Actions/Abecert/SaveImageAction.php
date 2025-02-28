<?php

namespace App\Actions\Abecert;

use App\Models\Image;
use Intervention\Image\ImageManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SaveImageAction
{
    public function execute(UploadedFile $image, string $path = 'images', int $maxWidth = 1920, int $maxHeight = 1080): Image 
    {
        try {
            $manager = ImageManager::gd();
            $img = $manager->read($image);
            
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
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $fullPath = $path . '/' . $filename;
            
            // Start transaction
            DB::beginTransaction();

            // Store the resized image in public storage
            if (!Storage::disk('public')->put($fullPath, (string) $img->encode())) {
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
            
            throw $e;
        }
    }
}
