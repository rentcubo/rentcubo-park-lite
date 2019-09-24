<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * The picture place \Config::get('app.url') is used to get the .env APP_URL
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('token');
            $table->string('password');
            $table->string('dob')->default("");
            $table->string('description')->default("");
            $table->string('mobile')->default("");
            $table->enum('gender',['male','female','others'])->default('male');
            $table->string('picture')->default(env('APP_URL')."/placeholder.jpg");
            $table->string('payment_mode')->default('cod');
            $table->string('token_expiry');
            $table->tinyInteger('user_type')->default(0);
            $table->string('device_token')->default('');
            $table->enum('device_type',['web','android','ios']);
            $table->enum('register_type',['web','android','ios']);
            $table->enum('login_by',['manual','facebook','google','twitter' , 'linkedin']);
            $table->string('timezone')->default('America/Los_Angeles');
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->default(0);
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
}
