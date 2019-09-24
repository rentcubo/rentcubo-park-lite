<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id');
            $table->integer('provider_id');
            $table->string('host_name');
            $table->string('host_type');
            $table->text('description');
            $table->string('picture');
            $table->integer('service_location_id');
            $table->integer('total_spaces');
            $table->text('full_address')->nullable();
            $table->float('per_hour')->default(0.00);
            $table->float('overall_ratings')->default(0);
            $table->integer('total_ratings')->default(0);
            $table->tinyInteger('is_admin_verified')->default(0);
            $table->tinyInteger('admin_status')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('uploaded_by')->default(PROVIDER);
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
        Schema::dropIfExists('hosts');
    }
}
