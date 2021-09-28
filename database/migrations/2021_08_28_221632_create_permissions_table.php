<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'permissions', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'name' ); // Upravljanje korisnicima
            $table->string( 'slug' ); // user-management
            $table->string( 'group' ); // users, recipes, roles, ...
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'permissions' );
    }
}

