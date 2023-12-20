<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Image;
use App\Models\Message;
use App\Models\Service;
use App\Models\Sponsorship;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $apartments = Apartment::where('user_id', '=', $user_id)->paginate(9);


        //Da controllare se funziona dopo che la sponsorizzazione è scaduta
        //⤵
        $sponsoredApartmentsIds = [];
        $actualDate = date("Y-m-d H:i:s");
        foreach ($apartments as $apartment) {

            $lastSponsor = $apartment->sponsorships()->orderBy('end_sponsorship', 'desc')->first();

            foreach ($apartment->sponsorships as $sponsorship) {

                if ($actualDate < $lastSponsor['pivot']['end_sponsorship']) {

                    array_unshift($sponsoredApartmentsIds, $sponsorship['pivot']['apartment_id']);
                }
            }
        }
        $sponsoredApartmentsIds = array_unique($sponsoredApartmentsIds);
        //⤴

        $countries = config('countries');

        return view('host.apartments.index', compact(['apartments', 'countries', 'sponsoredApartmentsIds']));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = config('countries');
        $services = Service::orderBy('name')->get();

        return view('host.apartments.create', compact('countries', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {

        $val_data = $request->validated();

        if ($val_data['visible'] == 1) {

            $val_data['visible'] = true;
        } else {
            $val_data['visible'] = false;
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
            $complete_path = Storage::put('apartments/apartment-' . $last_apartment->apartment_code + 1, $request->thumbnail);
            //$path = 'apartments' . strstr($complete_path, '/');
            $relative_path = $complete_path;

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
                $complete_path = Storage::put('apartments/apartment-' . $last_apartment->apartment_code + 1, $image);
                //$path = 'apartments' . strstr($complete_path, '/');
                //dd($complete_path);
                $relative_path = $complete_path;
                $new_image = new Image();
                $new_image->apartment_id = $apartment->id;
                $new_image->img = $relative_path;
                $new_image->save();
            }
        }


        //dd($request);
        return to_route('host.apartments.index')->with('message', 'Apartment added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        $gallery = Image::where('apartment_id', '=', $apartment->id)->get();

        $views = View::where('apartment_id', '=', $apartment->id)->get();

        $sponsored = '';

        $actualDate = date("Y-m-d H:i:s"); //actual date
        $dateFormatIt = strtotime($actualDate . '+ 1 hours');

        $sponsorship = DB::table('apartment_sponsorship')
            ->where('apartment_id', $apartment->id)
            ->where('end_sponsorship', '>=', $dateFormatIt)
            ->get()->last();

        //if result not empty
        if (!empty($sponsorship)) {

            //setup end date to add new time

            $sponsored = str_replace(' ', 'T', $sponsorship->end_sponsorship);
            //dd($sponsored, $sponsorship->end_sponsorship);
        }

        //dd($gallery);

        return view('host.apartments.show', compact(['apartment', 'gallery', 'views', 'sponsored']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {

        $countries = config('countries');
        $user_id = auth()->user()->id;
        $services = Service::orderBy('name')->get();

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

        if ($val_data['visible'] == 1) {

            $val_data['visible'] = true;
        } else {
            $val_data['visible'] = false;
        }
        //dd($val_data['visible']);

        if ($request->has('thumbnail')) {

            $path = $apartment->thumbnail;

            Storage::delete('public/' . $path);
            //dd('public/' . $path);
            $new_img = Storage::put('apartments/apartment-' . $apartment->apartment_code, $request->thumbnail);

            $relative_path = $new_img;

            $val_data['thumbnail'] = $relative_path;
        }
        //dd($val_data);

        if ($request->has('title')) {
            $val_data['title']  = $request->title;
            $val_data['slug'] = Str::slug($request->title . '-');
        }

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

        return to_route('host.apartments.index')->with('message', 'Welldone! apartment trashed successfully.');
    }

    public function trash_apartments()
    {

        $user_id = auth()->user()->id;

        $trash_apartments = Apartment::onlyTrashed()->where('user_id', '=', $user_id)->orderByDesc('deleted_at')->paginate(10);

        /* aggiungere paginate */
        return view('host.apartments.trash', compact('trash_apartments'));
    }

    public function restore($id)
    {
        $apartment = Apartment::withTrashed()->find($id);
        $apartment->restore();

        return to_route('host.apartments.index')->with('message', 'Welldone! apartments restored successfully.');
    }

    public function forceDelete($id)
    {
        //Appartamento preso tramite id con servivi e sponsorizzazioni
        $apartment = Apartment::with(['services', 'sponsorships'])->withTrashed()->find($id);

        //Messaggi associati all'appartamento preso tramite id
        $messages = Message::where('apartment_id', '=', $id)->get();

        //NON SO SE FUNZIONA
        $thumb = $apartment->thumb;
        $relative_path = Str::after($thumb, 'storage/');
        if (!is_null($apartment->thumbnail)) {
            Storage::delete($relative_path);
        }

        //Immagini relative all'appartamento preso tramite id
        $images = Image::where('apartment_id', '=', $apartment->id)->get();


        $views = View::where('apartment_id', '=', $apartment->id)->get();

        //Ogni immagine viene dissociata dall'appartamento e viene eliminata dal db
        foreach ($images as $image) {

            if (!is_null($image)) {

                $image->apartment()->dissociate();

                $image->delete();
            }
        }

        //Ogni messaggio viene dissociato dall'appartamento e viene eliminato dal db
        foreach ($messages as $message) {
            $message->apartment()->dissociate();

            $message->delete();
        }

        foreach ($views as $view) {
            $view->apartment()->dissociate();

            $view->delete();
        }


        if ($apartment->services) {
            $apartment->services()->detach();
        }

        if ($apartment->sponsorships) {
            $apartment->sponsorships()->detach();
        }

        Storage::deleteDirectory('apartments/apartment-' . $apartment->apartment_code);

        $apartment->forceDelete();

        return to_route('host.trash')->with('message', 'Well Done! apartments deleted successfully.');
    }

    public function sponsorship($slug)
    {
        $apartment = Apartment::where('slug', '=', $slug)->get();
        //dd($apartment);
        $sponsorships = Sponsorship::all();
        //dd($sponsorships);
        return view('host.apartments.sponsorship', compact('apartment', 'sponsorships'));
    }
}
