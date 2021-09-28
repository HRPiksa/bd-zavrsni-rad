<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view( 'register' );
    }

    public function register( Request $request )
    {
        $request->validate(
            array(
                'firstname' => 'required',
                'lastname'  => 'required',
                'email'     => 'required|email|unique:users,email',
                'username'  => 'required|unique:users,username',
                'password'  => 'required'
            )
        );

        $user = User::create(
            array(
                'firstname' => trim( $request->input( 'firstname' ) ),
                'lastname'  => trim( $request->input( 'lastname' ) ),
                'username'  => trim( $request->input( 'username' ) ),
                'email'     => strtolower( trim( $request->input( 'email' ) ) ),
                'password'  => bcrypt( $request->input( 'password' ) )
            )
        );

        if ( isset( $user ) ) {
            $user_role = Role::where( 'name', 'user' )->first();

            $user->roles()->attach( $user_role );

            return redirect()->route( 'login' );
        } else {
            return redirect()->back()->withErrors( array( 'msg' => 'Greška kod registracije' ) );
        }
    }
}
