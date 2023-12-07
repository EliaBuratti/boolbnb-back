<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        //dd($user_id);
        //$apartments = Apartment::paginate(6);
        $apartments = Apartment::where('user_id', '=', $user_id)->get();
        $countries = config('countries');

        return view('host.apartments.index', compact(['apartments', 'countries']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = config('countries');

        return view('host.apartments.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($request->title, '-');

        if ($request->has('thumbnail')) {
            $complete_path = Storage::put('thumbnails', $request->thumbnail);
            $path = strstr($complete_path, '/');
            $val_data['thumbnail'] = $path;
        }

        $new_apartment = Apartment::create($val_data);

        return to_route('host.apartments.index')->with('message', 'apartment added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        $gallery = Image::where('apartment_id', '=', $apartment->id)->get();

        //dd($gallery);

        return view('host.apartments.show', compact(['apartment', 'gallery']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        $countries = config('countries');
        $user_id = auth()->user()->id;

        if ($apartment->user_id == $user_id) {
            return view('host.apartments.edit', compact(['apartment', 'countries']));
        } else {
            return to_route('host.apartments.index')->with('message', 'can\'t edit that apartment');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        if ($request->has('thumbnail')) {
            $complete_path = Storage::put('thumbnails', $request->thumbnail);
            $path = strstr($complete_path, '/');
            $val_data['thumbnail'] = $path;
        }

        if ($request->has('title')) {
            $val_data['title']  = $request->title;
            $val_data['slug'] = Str::slug($request->title . '-');
        }

        if ($request->has('nation')) {
            $val_data['nation']  = $request->nation;
        }

        if ($request->has('city')) {
            $val_data['city']  = $request->city;
        }

        if ($request->has('postal_code')) {
            $val_data['postal_code']  = $request->postal_code;
        }

        if ($request->has('address')) {
            $val_data['address']  = $request->address;
        }

        if ($request->has('rooms')) {
            $val_data['rooms']  = $request->rooms;
        }

        if ($request->has('bathrooms')) {
            $val_data['bathrooms']  = $request->bathrooms;
        }

        if ($request->has('beds')) {
            $val_data['beds']  = $request->beds;
        }

        if ($request->has('m_square')) {
            $val_data['m_square']  = $request->m_square;
        }

        if ($request->has('description')) {
            $val_data['description']  = $request->description;
        }

        $apartment->update($val_data);

        return to_route('host.apartments.show', compact('aparment'))->with('message', 'aparment updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return to_route('host.apartments.index')->with('message', 'aparment deleted');
    }

    public function trash_apartments()
    {
        $trash_apartments = Apartment::onlyTrashed()->orderByDesc('deleted_at')->get();

        dd($trash_apartments);

        /* aggiungere paginate */
        return to_route('host.apartments.trash', compact('trash_apartments'));
    }

    public function restore($id)
    {
        $apartment = Apartment::withTrashed()->find($id);
        $apartment->restore();

        return to_route('host.apartments.index')->with('message', 'Welldone! apartments restored successfully');
    }

    public function forceDelete($id)
    {
        $apartment = Apartment::withTrashed()->find($id);

        $thumb = $apartment->thumb;

        $relative_path = Str::after($thumb, 'storage/');

        if (!is_null($apartment->thumbnail)) {
            Storage::delete($relative_path);
        }


        // TO DO: ELIMINARE IMMAGINI IN LOCALE

        $images = Image::all()->where('apartment_id', '=', $apartment->id)->all();

        foreach ($images as $image) {

            $image->delete();
        }


        $apartment->forceDelete();

        return to_route('host.trash')->with('message', 'Well Done! apartments deleted successfully!');
    }
}
