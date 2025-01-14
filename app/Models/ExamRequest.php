<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status'
    ];


    /**
     * User's exam requests relationship.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the test associated with the exam request.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function test(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Test::class);
    }
}
