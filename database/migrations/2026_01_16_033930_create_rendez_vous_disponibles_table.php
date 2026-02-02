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
    Schema::create('rendez_vous_disponibles', function (Blueprint $table) {
        $table->id();
        $table->date('date');
        $table->time('heure');
        $table->string('telephone')->nullable();
        $table->boolean('est_disponible')->default(true);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('rendez_vous_disponibles');
}

};
