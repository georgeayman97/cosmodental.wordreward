<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('facebook_displayName')->nullable();
            $table->string('facebook_profilePhoto')->nullable();
            $table->string('google_displayName')->nullable();
            $table->string('google_profilePhoto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('facebook_displayName');
            $table->dropColumn('facebook_profilePhoto');
            $table->dropColumn('google_displayName');
            $table->dropColumn('google_profilePhoto');
        });
    }
};
