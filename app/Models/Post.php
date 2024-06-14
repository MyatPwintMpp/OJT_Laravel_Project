<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    /**
     * Laravel relationship: post belongs to user
     *
     * @return BelongsTo
     */
     public function user()
     {
         return $this->belongsTo(User::class);
     }

    /**
     * Get the comments for the post
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
