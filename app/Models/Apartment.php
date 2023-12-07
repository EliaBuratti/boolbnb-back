<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'nation', 'city', 'postal_code', 'address', 'latitude', 'longitude', 'rooms', 'bathrooms', 'beds', 'm_square', 'description', 'thumbnail', 'visible', 'user_id'];

    public function generateSlug($title)
    {
        return Str::slug($title, '-');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function sponsorships(): HasMany
    {
        return $this->hasMany(Sponsorship::class);
    }

    public function view(): HasMany
    {
        return $this->hasMany(View::class);
    }
}
