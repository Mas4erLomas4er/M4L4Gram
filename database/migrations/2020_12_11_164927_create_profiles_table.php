<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('bio')->nullable();
            $table->string('site')->nullable();
            $table->string('image')->default('https://www.labom.com/files/images/mitarbeiter/kein-bild-vorhanden.png');
            $table->unsignedBigInteger('user_id');

            $table->index('user_id');
        });
        Schema::table('profiles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
