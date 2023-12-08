<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Support\Str;


class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();

        $user_id = auth()->user()->id;

        if ($user_id === 1) {
            return view('admin.services.index', compact('services'));
        } else {
            return to_route('dashboard')->with('message', 'You can\'t view this page');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $val_data = $request->validated();

        $val_data['slug'] = Str::slug($val_data['name'], '-');

        Service::create($val_data);

        return to_route('admin.services.index')->with('message', 'Service added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //dd($service);
        $user_id = auth()->user()->id;

        if ($user_id === 1) {
            return view('admin.services.edit', compact('service'));
        } else {
            return to_route('dashboard')->with('message', 'You can\'t view this page');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        //dd($request);

        if ($request->has('name')) {
            $val_data['name'] = $request->name;
        }

        $service->update($val_data);

        return to_route('admin.services.index')->with('message', 'service updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->apartments()->detach();

        $service->forceDelete();

        return to_route('admin.services.index')->with('message', 'service deleted');
    }
}
