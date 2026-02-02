<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('panier_produits', function (Blueprint $table) {
            $table->id();

            // clé étrangère vers la table "panier"
            $table->foreignId('panier_id')
                  ->constrained('paniers')
                  ->onDelete('cascade');

            // clé étrangère vers la table "produits_vendre"
            $table->foreignId('produit_id')
                  ->constrained('produits_vendre')
                  ->onDelete('cascade');

            $table->integer('quantite')->default(1);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('panier_produits');
    }
};

