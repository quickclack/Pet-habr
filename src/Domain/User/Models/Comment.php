<?php

namespace Domain\User\Models;

use Domain\Information\Models\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Traits\HasDateConversion;

class Comment extends Model
{
    use HasFactory, HasDateConversion;

    protected $fillable = [
        'comment',
        'user_id',
        'article_id',
        'parent_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes');
    }
}
