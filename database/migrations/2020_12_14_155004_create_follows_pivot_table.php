<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateFollowsPivotTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('follows', function (Blueprint $table) {
                $table->unsignedBigInteger('follower_id');
                $table->unsignedBigInteger('followee_id');

                $table->primary(['follower_id', 'followee_id']);
                $table->unique(['follower_id', 'followee_id']);
            });
            Schema::table('follows', function (Blueprint $table) {
                $table->foreign('follower_id')->references('id')
                    ->on('users')
                    ->onDelete('cascade');
                $table->foreign('followee_id')->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down ()
        {
            Schema::dropIfExists('followsofile_user');
        }
    }
