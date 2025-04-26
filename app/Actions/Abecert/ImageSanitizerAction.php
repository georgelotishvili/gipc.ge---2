<?php

namespace App\Actions\Abecert;

use App\Models\Image;
use App\Models\Question;

class ImageSanitizerAction
{
    public static function execute(): void 
    {
        $directory = storage_path('app/public/images');
        
        // Check if directory exists
        if (!file_exists($directory))
        {
            return;
        }
        
        // Get all image files in the directory
        $files = scandir($directory);
        
        foreach ($files as $file)
        {
            // Skip . and .. directories
            if ($file === '.' || $file === '..') {
                continue;
            }
            $image = Image::where('name', $file)->first();
            if (!$image)
            {
                // Delete the file if it doesn't exist in the database
                $filePath = $directory . '/' . $file;
                if (file_exists($filePath))
                {
                    unlink($filePath);
                }
            }
        }

    }
}
