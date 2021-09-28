<?php

namespace App\Listeners;

use App\Events\UserSuccessfulLogin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserLoginSucessful
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct( Request $request )
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  UserSuccessfulLogin  $event
     * @return void
     */
    public function handle( UserSuccessfulLogin $event )
    {
        $current_time = Carbon::now()->timezone( 'Europe/Zagreb' )->toDateTimeString();

        $event->user->last_login_at = $current_time;
        $event->user->save();
    }
}
