<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if ( Auth::check() ) {
            return view( 'home' );
        } else {
            return view( 'home.index' );
        }
    }

    public function exam()
    {
        return view( 'exam' );
    }
}
