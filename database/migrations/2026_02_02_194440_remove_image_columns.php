<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Suppression de la colonne image dans semis
        Schema::table('semis', function (Blueprint $table) {
            if (Schema::hasColumn('semis', 'image')) {
                $table->dropColumn('image');
            }
        });

        // Suppression de la colonne image dans produits_vendre
        Schema::table('produits_vendre', function (Blueprint $table) {
            if (Schema::hasColumn('produits_vendre', 'image')) {
                $table->dropColumn('image');
            }
        });
    }

    public function down()
    {
        // Restauration de la colonne image dans semis
        Schema::table('semis', function (Blueprint $table) {
            if (!Schema::hasColumn('semis', 'image')) {
                $table->string('image')->nullable();
            }
        });

        // Restauration de la colonne image dans produits_vendre
        Schema::table('produits_vendre', function (Blueprint $table) {
            if (!Schema::hasColumn('produits_vendre', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }
};

