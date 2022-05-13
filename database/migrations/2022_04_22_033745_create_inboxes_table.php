<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inboxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('nomor', 50);
            $table->string('pengirim', 200);
            $table->string('penerima', 200);
            $table->text('ringkasan');
            $table->date('tgl_surat');
            $table->date('tgl_diterima');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('inboxes');
    }
}
