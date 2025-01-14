<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Helper extends Model
{
    use HasFactory;

    /**
     * Get Template Table.
     * 
     * @return object
     */
    public static function getBase($table): object
    {
        return DB::connection('mysql2')->table($table)->get();
    }
}
