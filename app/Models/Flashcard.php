<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flashcard extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
