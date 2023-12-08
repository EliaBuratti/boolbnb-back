<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use App\Http\Requests\StoreSponsorshipRequest;
use App\Http\Requests\UpdateSponsorshipRequest;
use Termwind\Components\Dd;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sponsorships = Sponsorship::all();

        $user_id = auth()->user()->id;

        if ($user_id === 1) {
            return view('admin.sponsorships.index', compact('sponsorships'));
        } else {
            return to_route('dashboard')->with('message', 'You can\'t view this page');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sponsorships.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSponsorshipRequest $request)
    {
        $val_data = $request->validated();

        Sponsorship::create($val_data);

        return to_route('admin.sponsorships.index')->with('message', 'Sponsorship added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsorship $sponsorship)
    {
        $user_id = auth()->user()->id;

        if ($user_id === 1) {
            return view('admin.sponsorships.edit', compact('sponsorship'));
        } else {
            return to_route('dashboard')->with('message', 'You can\'t view this page');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSponsorshipRequest $request, Sponsorship $sponsorship)
    {
        if ($request->has('name')) {
            $val_data['name'] = $request->name;
        }
        if ($request->has('price')) {
            $val_data['price'] = $request->price;
        }
        if ($request->has('duration')) {
            $val_data['duration'] = $request->duration;
        }

        $sponsorship->update($val_data);

        return to_route('admin.sponsorships.index')->with('message', 'Sponsorship updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsorship $sponsorship)
    {
        $sponsorship->forceDelete();

        return to_route('admin.sponsorships.index')->with('message', 'Sponsorship deleted');
    }
}
