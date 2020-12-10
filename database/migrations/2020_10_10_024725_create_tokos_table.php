<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko');
            $table->longtext('deskripsi_toko');
            $table->boolean('verif');
            $table->integer('user_id');
            $table->boolean('jne')->default('0');
            $table->boolean('pos')->default('0');
            $table->boolean('tiki')->default('0');
            $table->boolean('wahana')->default('0');
            $table->boolean('jnt')->default('0');
            $table->boolean('sicepat')->default('0');
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
        Schema::dropIfExists('tokos');
    }
}
