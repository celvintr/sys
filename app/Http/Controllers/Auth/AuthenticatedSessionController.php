<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Stevebauman\Location\Facades\Location;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if ($position = Location::get()) {
            // Successfully retrieved position.
            if ($position->countryCode != 'US') abort(404);
        } else {
            // Failed retrieving position.
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // $request->authenticate();

        $user = User::where('dni_usuario', $request->dni_usuario)->first();

        $checkPass = false;
        $active = false;
        if (!empty($user->dni_usuario)) {
            $checkPass = Hash::check($request->pass_usuario, $user->pass_usuario);
            $active = ($user->estado_usuario == 1 ? true : false);
        }

        if (empty($user->dni_usuario) || !$checkPass || !$active) {
            throw ValidationException::withMessages([
                'dni_usuario' => __('auth.failed'),
            ]);
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
