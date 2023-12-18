<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\View;
use App\Http\Requests\StoreViewRequest;
use App\Http\Requests\UpdateViewRequest;
use App\Models\Apartment;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;

        $apartments = Apartment::where('user_id', $user_id)->get();
        //dd($apartments);

        $views = [];

        $totalViews = 0;

        foreach ($apartments as $i => $apartment) {
            $apartmentID = $apartment['id'];
            //dd($apartment['title']);
            //dd($apartmentID);
            $stats = View::where('apartment_id', $apartmentID)->count();
            //dd($stats);
            array_push($views, [$apartment['title'], $stats]);

            $totalViews += $stats;
            /*  $views += [
                $apartment['title'] => $stats
            ]; */
        }

        //dd($totalViews);

        return view('host.analitycs.index', compact('views', 'totalViews'));
        //return response()->json($views);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreViewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(View $view)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(View $view)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateViewRequest $request, View $view)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(View $view)
    {
        //
    }
}
