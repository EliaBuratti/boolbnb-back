<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Http;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'slug', 'apartment_code', 'nation', 'address', 'latitude', 'longitude', 'rooms', 'bathrooms', 'beds', 'm_square', 'description', 'thumbnail', 'visible', 'user_id'];

    public function generateSlug($title)
    {
        return Str::slug($title, '-');
    }

    public static function getCoordinates($address)
    {
        $key_tomtom = env('TOMTOM_KEY');

        return Http::withoutVerifying()->get("https://api.tomtom.com/search/2/geocode/{$address}.json?storeResult=false&lat=37.337&lon=-121.89&view=Unified&key={$key_tomtom}");
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

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)->withPivot('apartment_id', 'service_id');
    }

    public function sponsorships(): BelongsToMany
    {
        return $this->belongsToMany(Sponsorship::class)->withPivot('end_sponsorship', 'created_at');
    }

    public function view(): HasMany
    {
        return $this->hasMany(View::class);
    }
}
