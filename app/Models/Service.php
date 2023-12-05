<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function generateSlug($name){
        return Str::slug($name, '-');
    }

    public function apartments(): BelongsToMany
    {
        return $this->belongsToMany(Apartment::class);
    }
}
