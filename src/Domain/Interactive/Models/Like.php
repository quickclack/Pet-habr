<?php

namespace Domain\Interactive\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
    ];

    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }
}
