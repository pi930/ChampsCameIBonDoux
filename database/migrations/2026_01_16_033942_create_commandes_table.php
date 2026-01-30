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
    Schema::create('commandes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('panier_id')->constrained('panier')->onDelete('cascade');
        $table->string('telephone')->nullable();
        $table->string('statut')->default('en_attente');
        $table->decimal('total', 10, 2)->default(0);
        $table->foreignId('rendez_vous_disponible_id')
      ->nullable()
      ->constrained('rendez_vous_disponibles')
      ->nullOnDelete();
        $table->timestamps();

    });
}

public function down()
{
    Schema::dropIfExists('commandes');
}

};
