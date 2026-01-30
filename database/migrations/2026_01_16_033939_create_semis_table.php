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
    Schema::create('semis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('produit_id')->constrained('produits_cultiver')->onDelete('cascade');
        $table->date('date_semis');
        $table->integer('quantite')->default(0);
        $table->string('image')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('semis');
}

};
