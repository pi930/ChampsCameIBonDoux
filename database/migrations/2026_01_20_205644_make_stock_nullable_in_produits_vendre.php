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
        $table->integer('stock')->nullable()->change();
    });
}

public function down()
{
    Schema::table('produits_vendre', function (Blueprint $table) {
        $table->integer('stock')->default(0)->change();
    });
}

};
