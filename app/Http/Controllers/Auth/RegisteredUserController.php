<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        //dd($request);

        $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:40'],
            //'city' => ['required', 'string', 'max:30'],
            //'postal_code' => ['required', 'string', 'max:10'],
            //'address' => ['required', 'string', 'max:100'],
            'date_of_birth' => ['required', 'date'],
            //'phone' => ['required', 'string', 'max:15'],
            //'host' => ['required', 'boolean'],
            //'thumb' => ['required', 'image', 'max:1000', 'mimes:png,jpg'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        //dd($validator);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            //'city' => $request->city,
            //'postal_code' => $request->postal_code,
            //'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            //'phone' => $request->phone,
            //'host' => $request->host,
            //'thumb' => $request->thumb,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
