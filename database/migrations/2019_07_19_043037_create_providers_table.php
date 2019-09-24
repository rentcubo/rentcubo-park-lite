<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('token')->default('');
            $table->string('password');
            $table->string('description')->default("");
            $table->string('mobile')->default("");
            $table->string('picture')->default(env('APP_URL')."/placeholder.jpg");
            $table->string('token_expiry')->default('');
            $table->string('work')->default("");
            $table->string('school')->default("");
            $table->text('languages')->nullable();
            $table->string('device_token')->default('');
            $table->enum('device_type',array('web','android','ios'));
            $table->enum('register_type',array('web','android','ios'));
            $table->enum('login_by',array('manual','facebook','google','twitter' , 'linkedin'));
            $table->string('social_unique_id')->default('');
            $table->enum('gender',array('male','female','others'));
            $table->double('latitude',15,8)->default();
            $table->double('longitude',15,8)->default();
            $table->text('full_address')->nullable();
            $table->string('payment_mode')->default('cod');
            $table->string('timezone')->default('America/Los_Angeles');
            $table->tinyInteger('status')->default(0);
            $table->string('provider_type')->default("");
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            // $table->boolean('admin')->default(false);
            // $table->timestamp('approved_at')->nullable();
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
        Schema::dropIfExists('providers');
    }
}
