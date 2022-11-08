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
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('title', 60);
            $table->text('message');
            $table->foreignId('idUser');
            $table->foreignId('idCategory');
            $table->timestamps();
            
            $table->foreign('idUser')->references('id')->on('user')->onDelete('restrict');
            $table->foreign('idCategory')->references('id')->on('category')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
};
