<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model representing the exercise.
 */
class Exercise extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'topic',
        'visibility',
    ];

    /**
     * The author of the exercise.
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The flashcards in the exercise.
     *
     * @return HasMany
     */
    public function flashcards(): HasMany
    {
        return $this->hasMany(Flashcard::class);
    }

    /**
     * The attempts of the exercise.
     *
     * @return HasMany
     */
    public function attempts(): HasMany
    {
        return $this->hasMany(Attempt::class);
    }

    /**
     * The sharings of the exercise.
     *
     * @return BelongsToMany
     */
    public function groupsSharing() : BelongsToMany
    {
        return $this->belongsToMany(
            Exercise::class,
            'shared_exercises',
            'exercise_id',
            'group_id'
        );
    }
}
