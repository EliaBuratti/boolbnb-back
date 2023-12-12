<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Image;
use App\Models\Service;
use Illuminate\Http\Request;
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
        $services = Service::all();

        return view('host.apartments.create', compact('countries', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {

        $val_data = $request->validated();

        if ($val_data['visible'] === true) {

            $val_data['visible'] = 1;
        } else {
            $val_data['visible'] = 0;
        }

        $last_apartment = Apartment::all()->last();
        $val_data['apartment_code'] = $last_apartment->apartment_code + 1;

        //dd($request->thumbnail);
        $val_data['slug'] = Str::slug($request->title, '-');

        $val_data['user_id'] = auth()->user()->id;

        /* calcolare latitude e longitude */
        $response = Apartment::getCoordinates($val_data['address']);

        if ($response->successful()) {
            $val_data['latitude']  = $response->json()['results'][0]['position']['lat'];
            $val_data['longitude'] = $response->json()['results'][0]['position']['lon'];

            /* $val_data['city'] = $response->json()['results'][0]['address']['municipality'] . ', ' . $response->json()['results'][0]['address']['countrySubdivisionName'];
            $val_data['postal_code'] = $response->json()['results'][0]['address']['postalCode']; */
        }
        //dd($val_data);

        if ($request->has('thumbnail')) {
            $complete_path = Storage::put('public/apartments/apartment-' . $last_apartment->apartment_code + 1, $request->thumbnail);
            //$path = 'apartments' . strstr($complete_path, '/');
            $relative_path = Str::after($complete_path, 'public/');

            //dd($relative_path);
            $val_data['thumbnail'] = $relative_path;
            //dd($val_data);
        }



        $apartment = Apartment::create($val_data);
        $apartment->services()->attach($request->services);
        //dd($apartment);

        if ($request->has('gallery')) {

            $gallery = $request['gallery'];

            foreach ($gallery as $image) {
                $complete_path = Storage::put('public/apartments/apartment-' . $last_apartment->apartment_code + 1, $image);
                //$path = 'apartments' . strstr($complete_path, '/');
                //dd($complete_path);
                $relative_path = Str::after($complete_path, 'public/');
                $new_image = new Image();
                $new_image->apartment_id = $apartment->id;
                $new_image->img = $relative_path;
                $new_image->save();
            }
        }


        //dd($request);
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
        $services = Service::all();

        if ($apartment->user_id == $user_id) {
            return view('host.apartments.edit', compact(['apartment', 'countries', 'services']));
        } else {
            return to_route('host.apartments.index')->with('message', 'can\'t edit that apartment');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $val_data = $request->validated();

        if ($val_data['visible'] === true) {

            $val_data['visible'] = 1;
        } else {
            $val_data['visible'] = 0;
        }

        if ($request->has('thumbnail')) {

            $path = $apartment->thumbnail;
            //dd($path);
            Storage::delete($path);
            $new_img = Storage::put('public/apartments/apartment-' . $apartment->apartment_code, $request->thumbnail);

            $relative_path = Str::after($new_img, 'public/');

            $val_data['thumbnail'] = $relative_path;
        }
        //dd($val_data);

        if ($request->has('title')) {
            $val_data['title']  = $request->title;
            $val_data['slug'] = Str::slug($request->title . '-');
        }

        /* if ($request->has('nation')) {
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
        } */

        //dd($apartment);

        $apartment->update($val_data);

        //dd($val_data['services']);
        if ($request->has('services')) {
            # Aggiorniamo le technologies
            $apartment->services()->sync($val_data['services']);
        }

        return to_route('host.apartments.show', compact('apartment'))->with('message', 'aparment updated');
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

        $user_id = auth()->user()->id;

        $trash_apartments = Apartment::onlyTrashed()->where('user_id', '=', $user_id)->orderByDesc('deleted_at')->get();

        /* aggiungere paginate */
        return view('host.apartments.trash', compact('trash_apartments'));
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

            if (!is_null($image)) {
            }

            $image->delete();
        }

        Storage::deleteDirectory('public/apartments/' . $apartment->slug);

        $apartment->forceDelete();

        return to_route('host.trash')->with('message', 'Well Done! apartments deleted successfully!');
    }
}
