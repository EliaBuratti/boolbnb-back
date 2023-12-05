<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sponsorship extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'duration'];

    public function apartments(): BelongsToMany
    {
        return $this->belongsToMany(Apartment::class);
    }
}
