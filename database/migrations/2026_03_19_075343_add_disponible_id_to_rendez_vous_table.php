<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('rendez_vous', function (Blueprint $table) {
        $table->foreignId('rendez_vous_disponible_id')
              ->nullable()
              ->constrained('rendez_vous_disponibles')
              ->onDelete('set null');
    });
}

public function down()
{
    Schema::table('rendez_vous', function (Blueprint $table) {
        $table->dropForeign(['rendez_vous_disponible_id']);
        $table->dropColumn('rendez_vous_disponible_id');
    });
}

};
