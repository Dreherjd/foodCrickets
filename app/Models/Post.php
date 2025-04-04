<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\User;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasUuids;

    protected $guarded = [
        'id',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags(): BelongsToMany{
        return $this->belongstoMany(Tag::class);
    }
}
