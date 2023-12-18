<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Apartment;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreImageRequest $request)
    {
        //dd($request, $user_id = auth()->user()->id);
        $new_img = Storage::put('apartments/apartment-' . $request->apartment_code, $request->img);
        $relative_path = $new_img;

        $data['apartment_id'] = $request->apartment_id;
        $data['img'] = $relative_path;
        $image = Image::create($data);

        return redirect()->back()->with('success', 'Welldone! Image added successfully.');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        Storage::delete($image->img);
        $image->delete();
        return redirect()->back()->with('message', 'Welldone! Image deleted sucessfully.');
    }
}
