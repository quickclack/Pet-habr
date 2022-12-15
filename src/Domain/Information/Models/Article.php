<?php

namespace Domain\Information\Models;

use Domain\Information\Facades\Sorter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;
use Support\Enums\ArticleStatus;
use Domain\User\Models\Comment;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Support\Traits\DateConversion;

class Article extends Model
{
    use HasFactory, DateConversion;

    protected $fillable = [
        'title',
        'description',
        'image',
        'views',
        'user_id',
        'category_id',
        'status'
    ];

    protected $casts = [
        'status' => ArticleStatus::class,
        'created_at' => 'date:Y-m-d'
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)
            ->withTimestamps();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter(Builder $query): mixed
    {
        return app(Pipeline::class)
            ->send($query)
            ->through(filters())
            ->thenReturn();
    }

    public function scopeSorted(Builder $query): void
    {
        Sorter::run($query);
    }

    public function scopeSearch(Builder $query): void
    {
        $query->with('user')
            ->when(request('search'), function (Builder $builder) {
                $builder->whereFullText(['title', 'description'], request('search'));
            })->get();
    }
}
