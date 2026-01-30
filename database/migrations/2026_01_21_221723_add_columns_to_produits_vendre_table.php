<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('produits_vendre', function (Blueprint $table) {
        $table->string('nom')->default('')->after('id');
        $table->decimal('prix', 8, 2)->default(0)->after('nom');
        $table->string('categorie')->nullable()->after('prix');
        $table->string('unite')->nullable()->after('categorie');
    });
}

public function down(): void
{
    Schema::table('produits_vendre', function (Blueprint $table) {
        $table->dropColumn(['nom', 'prix', 'categorie', 'unite']);
    });
}


};