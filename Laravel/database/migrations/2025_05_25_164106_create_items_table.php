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
       Schema::create('items', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('kategori');
    $table->integer('harga');
    $table->text('deskripsi');
    $table->string('gambar'); // nama file atau path relatif
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
        Schema::dropIfExists('items');
    }
};
