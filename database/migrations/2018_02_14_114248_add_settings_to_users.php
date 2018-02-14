<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSettingsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * Adding some nice user settings
         * to jazz up the user profile a bit!
         */

        Schema::table('users', function(Blueprint $table) {
            $table->string('phone_number', '40')->nullable();
            $table->string('github_url', '250')->nullable();
            $table->string('linkedin_url', '250')->nullable();
            $table->string('profile_picture_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*
         * Reverse that ish!
         */
        Schema::table('users', function(Blueprint $table) {
           $table->dropColumn('phone_number');
           $table->dropColumn('github_url');
           $table->dropColumn('linkedin_url');
           $table->dropColumn('profile_picture_path');
        });
    }
}
