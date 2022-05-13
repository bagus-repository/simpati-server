<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classifies_id');
            $table->unsignedBigInteger('inboxes_id');
            $table->text('ringkasan');
            $table->text('keterangan')->nullable();
            $table->date('batas_waktu');
            $table->tinyInteger('sts')->default(1);
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
        Schema::dropIfExists('disposes');
    }
}
