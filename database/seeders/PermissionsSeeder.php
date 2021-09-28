<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'permission_role' )->delete();
        DB::table( 'permissions' )->delete();

        // Za korisnike
        Permission::create( array(
            'name'  => 'Pregled korisnika',
            'slug'  => 'manage-users',
            'group' => 'users'
        ) );

        Permission::create( array(
            'name'  => 'Kreiranje korisnika',
            'slug'  => 'create-users',
            'group' => 'users'
        ) );

        Permission::create( array(
            'name'  => 'Ažuriranje korisnika',
            'slug'  => 'edit-users',
            'group' => 'users'
        ) );

        Permission::create( array(
            'name'  => 'Brisanje korisnika',
            'slug'  => 'delete-users',
            'group' => 'users'
        ) );

        // Za uloge
        Permission::create( array(
            'name'  => 'Pregled uloga',
            'slug'  => 'manage-roles',
            'group' => 'roles'
        ) );

        Permission::create( array(
            'name'  => 'Kreiranje uloga',
            'slug'  => 'create-roles',
            'group' => 'roles'
        ) );

        Permission::create( array(
            'name'  => 'Ažuriranje uloga',
            'slug'  => 'edit-roles',
            'group' => 'roles'
        ) );

        Permission::create( array(
            'name'  => 'Brisanje uloga',
            'slug'  => 'delete-roles',
            'group' => 'roles'
        ) );

        // Za stranice
        Permission::create( array(
            'name'  => 'Pregled stranica',
            'slug'  => 'manage-pages',
            'group' => 'pages'
        ) );

        Permission::create( array(
            'name'  => 'Kreiranje stranica',
            'slug'  => 'create-pages',
            'group' => 'pages'
        ) );

        Permission::create( array(
            'name'  => 'Ažuriranje stranica',
            'slug'  => 'edit-pages',
            'group' => 'pages'
        ) );

        Permission::create( array(
            'name'  => 'Brisanje stranica',
            'slug'  => 'delete-pages',
            'group' => 'pages'
        ) );
    }
}
