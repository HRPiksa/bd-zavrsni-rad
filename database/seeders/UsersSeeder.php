<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'pages' )->delete();
        DB::table( 'users' )->delete();

        // Korak 1 - dohvati role i pohrani ih u varijablu
        $admin_role = Role::where( 'name', 'admin' )->first();
        $editor_role = Role::where( 'name', 'editor' )->first();
        $user_role = Role::where( 'name', 'user' )->first();

        // Korak 2 - kreirajte testne korisnike
        $admin = User::create( array(
            'firstname' => 'Željko',
            'lastname'  => 'Frketić',
            'email'     => 'seminar.admin@email.com',
            'username'  => 'admin',
            'password'  => Hash::make( '1234' )
        ) );

        $editor = User::create( array(
            'firstname' => 'Ana',
            'lastname'  => 'Anić',
            'email'     => 'ana.anic@email.com',
            'username'  => 'editor',
            'password'  => Hash::make( '1234' )
        ) );

        $user = User::create( array(
            'firstname' => 'Milo',
            'lastname'  => 'Dragić',
            'email'     => 'milo.drago@email.com',
            'username'  => 'user',
            'password'  => Hash::make( '1234' )
        ) );

        $user_2 = User::create( array(
            'firstname' => 'Pero',
            'lastname'  => 'Perić',
            'email'     => 'petar.crni@gmail.com',
            'username'  => 'Perica',
            'password'  => Hash::make( '1234' )
        ) );

        $user_3 = User::create( array(
            'firstname' => 'Ivo',
            'lastname'  => 'Ivić',
            'email'     => 'ivica1234@gmail.com',
            'username'  => 'Ivica',
            'password'  => Hash::make( '1234' )
        ) );

        // Korak 3 - spajanje korisnika s ulogom
        $admin->roles()->attach( $admin_role );
        $editor->roles()->attach( $editor_role );
        $user->roles()->attach( $user_role );
        $user_2->roles()->attach( $user_role );
        $user_3->roles()->attach( $user_role );
    }
}
