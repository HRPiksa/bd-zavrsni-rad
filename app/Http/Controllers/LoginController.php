<?php

namespace App\Http\Controllers;

use App\Events\UserSuccessfulLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view( 'login' );
    }

    public function login( Request $request )
    {
        $request->validate(
            array(
                'email'    => 'required|email',
                'password' => 'required'
            )
        );

        $remember = $request->has( 'remember' ) ? true : false;

        $credentials = $request->only( 'email', 'password' );

        if ( Auth::attempt( $credentials, $remember ) ) {
            $request->session()->regenerate();

            Auth::login( Auth::user() );

            event( new UserSuccessfulLogin( Auth::user() ) );

            return redirect()->route( 'home' );
        } else {
            return back()->withErrors( array(
                'msg' => 'Email i lozinka nisu valjani.'
            ) );
        }
    }

    public function logout( Request $request )
    {
        return redirect( '/' )->with( Auth::logout() );
    }
}
