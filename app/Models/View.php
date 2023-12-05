<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class View extends Model
{
    use HasFactory;

    protected $fillable = ['ip_address', 'time'];

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
}
