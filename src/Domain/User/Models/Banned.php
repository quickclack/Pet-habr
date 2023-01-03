<?php

namespace Domain\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Banned extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'banned',
        'banned_start',
        'banned_end'
    ];

    protected $casts = [
        'banned' => 'boolean'
    ];

    protected $dates = [
        'banned_start',
        'banned_end'
    ];

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
