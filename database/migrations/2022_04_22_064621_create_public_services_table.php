<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_services', function (Blueprint $table) {
            $table->string('service_no', 20)->primary();
            $table->unsignedInteger('requestor');
            $table->unsignedInteger('apv_by')->nullable();
            $table->date('created_date');
            $table->date('apv_date')->nullable();
            $table->string('service_code', 10);
            $table->tinyInteger('sts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public_services');
    }
}
