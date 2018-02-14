<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerificationToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // We are going to add dual verification (SMS and Email), and the
        // only way the user can use their account is if they are verified on both

        Schema::create('verifications', function(Blueprint $table) {
           $table->increments('id');
           $table->enum('method', ['sms', 'email']);
           $table->string('code');
           $table->timestamps();
        });

        Schema::create('user_verification', function(Blueprint $table) {
            $table->integer('user_id');
            $table->integer('verification_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        Schema::drop('verifications');
    }
}
