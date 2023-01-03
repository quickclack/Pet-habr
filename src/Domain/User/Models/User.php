<?php

namespace Domain\User\Models;

use Domain\Information\Models\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nickName',
        'firstName',
        'lastName',
        'email',
        'description',
        'sex',
        'avatar',
        'password',
        'email_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)
            ->withTimestamps();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'bookmarks')
            ->withTimestamps();
    }

    public function banned(): HasOne
    {
        return $this->hasOne(Banned::class);
    }

    public function getRole(): ?string
    {
        foreach ($this->roles as $role) {
            $roles = $role;
        }

        return $roles->name ?? null;
    }
}
