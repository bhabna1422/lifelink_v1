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
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id (Primary)
            $table->string('name'); // name
            $table->string('email')->index(); // email
            $table->string('password')->nullable(); // password
            $table->string('phone')->nullable(); // phone
            $table->timestamp('dob')->nullable(); // dob
            $table->char('gender', 255)->nullable(); // gender
            $table->string('blood_group')->nullable(); // blood_group
            $table->boolean('is_donor')->default(0); // is_donor
            $table->boolean('is_ambulance_provider')->default(0); // is_ambulance_provider
            $table->timestamp('createdAt')->useCurrent(); // createdAt
            $table->string('reset_password_token')->nullable(); // reset_password_token
            $table->string('reset_password_expiry')->nullable(); // reset_password_expiry
            $table->timestamp('updatedAt')->useCurrent()->useCurrentOnUpdate(); // updatedAt
            $table->integer('provider')->default(0); // provider
            $table->text('avatar')->nullable()->default('https://lifelinkapi.s3.us-east-2.amazonaws.com/2020-02-11T09%3A25%3A02.531Z-avatar_placeholder.png'); // avatar
            $table->string('location')->nullable(); // location
            $table->point('coordinate')->nullable(); // coordinate (POINT)
            $table->boolean('is_deleting')->default(0); // is_deleting
            $table->string('delete_status')->nullable(); // delete_status
            $table->string('admin_message')->nullable(); // admin_message
            $table->string('button_id')->nullable()->default('false'); // button_id
            $table->boolean('is_milk_donor')->default(0); // is_milk_donor
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
