<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'user_role' )->delete();
        DB::table( 'roles' )->delete();

        // Definiraj ovlasti za svaku ulogu
        $admin_permissions = Permission::whereIn( 'group', array( 'users', 'roles', 'pages' ) )->get();
        $editor_permissions = Permission::whereIn( 'group', array( 'users', 'pages' ) )->get();
        $user_permissions = Permission::whereIn( 'group', array( 'pages' ) )->get();

        // Definiranje uloga
        $admin_role = Role::create( array(
            'name' => 'admin'
        ) );

        $editor_role = Role::create( array(
            'name' => 'editor'
        ) );

        $user_role = Role::create( array(
            'name' => 'user'
        ) );

        // Povezivanje uloga s ovlastima
        foreach ( $admin_permissions as $permission ) {
            $admin_role->permissions()->attach( $permission );
        }

        foreach ( $editor_permissions as $permission ) {
            $editor_role->permissions()->attach( $permission );
        }

        foreach ( $user_permissions as $permission ) {
            $user_role->permissions()->attach( $permission );
        }
    }
}
