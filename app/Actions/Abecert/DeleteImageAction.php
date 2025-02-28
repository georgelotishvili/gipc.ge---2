<?php

namespace App\Actions\Abecert;

use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeleteImageAction
{
    public function execute(Image $image): void
    {
        try {
            DB::beginTransaction();

            // Delete the physical file from storage
            if (Storage::disk('public')->exists($image->path))
            {
                Storage::disk('public')->delete($image->path);
            }

            // Delete the image record from database
            $image->delete();

            DB::commit();
        } catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }
    }
}
