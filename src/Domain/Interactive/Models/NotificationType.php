<?php

namespace Domain\Interactive\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}
