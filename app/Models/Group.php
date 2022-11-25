<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    const TEACHERS_GROUP = 'teachers';
    const STUDENTS_GROUP = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'owner');
    }

    /**
     * @return BelongsToMany
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'users_memberships',
            'group_id',
            'user_id'
        );
    }


    /**
     * @return BelongsToMany
     */
    public function assigned(): BelongsToMany
    {
        return $this->belongsToMany(
            Group::class,
            'assigned_exercises',
            'group_id',
            'exercise_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function groupsSharing() : BelongsToMany
    {
        return $this->belongsToMany(
            Group::class,
            'shared_exercises',
            'group_id',
            'exercise_id'
        );
    }
}
