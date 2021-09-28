<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'pages', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'title' );
            $table->string( 'url' )->unique();
            $table->text( 'content' );
            $table->unsignedBigInteger( 'user_id' );
            NestedSet::columns( $table );
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onUpdate( 'cascade' )->onDelete( 'restrict' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists( 'pages' );
    }
}
