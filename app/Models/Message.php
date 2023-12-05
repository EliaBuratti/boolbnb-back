<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'name', 'last_name', 'subject', 'body'];

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}
