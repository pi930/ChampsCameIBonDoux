<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('produits_vendre', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->integer('stock')->default(0);
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('produits_vendre');
}

};
