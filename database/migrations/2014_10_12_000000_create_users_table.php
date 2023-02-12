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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('role')->nullable();
            $table->unsignedBigInteger('user_group_level')->default(1);
            $table->unsignedBigInteger('referer_id')->nullable();
            $table->unsignedBigInteger('points')->default(0);
            $table->unsignedBigInteger('total_points')->default(0);
            $table->unsignedBigInteger('level_points')->default(0);
            $table->unsignedBigInteger('pending_points')->default(0);
            $table->unsignedBigInteger('redeemed_points')->default(0);
            $table->integer('notifications_count')->default(0);
            $table->string('status')->nullable();
            $table->string('refer_code')->nullable();
            $table->dateTime('last_visit')->nullable();
            $table->bigInteger('refering_count')->default(0);
            $table->string('user_code')->nullable();
            $table->text('device_token')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->dateTime('checking_review_date')->nullable();
            $table->dateTime('facebook_review_date')->nullable();
            $table->string('checkin_review_status')->nullable();
            $table->string('google_review_status')->nullable();
            $table->string('facebook_review_status')->nullable();
            $table->string('google_status')->nullable();
            $table->dateTime('google_review_date')->nullable();
            $table->string('facebook_status')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
