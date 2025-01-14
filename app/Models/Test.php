<?php

namespace App\Models;

use App\Models\Traits\Cacheable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Test extends Model
{
    use HasFactory;
    use Cacheable;

    protected $guarded = [];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'test_question')->withPivot('answer')->withTimestamps();
    }

    /**
     * Get the exam request that owns the test.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examRequest(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ExamRequest::class);
    }
}
