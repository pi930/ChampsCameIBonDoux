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
    Schema::table('produits_vendre', function (Blueprint $table) {
        if (!Schema::hasColumn('produits_vendre', 'semi_id')) {
            $table->unsignedBigInteger('semi_id')->nullable();
        }

        if (!Schema::hasColumn('produits_vendre', 'actif')) {
            $table->boolean('actif')->default(false);
        }
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produits_vendre', function (Blueprint $table) {
            //
        });
    }
};
