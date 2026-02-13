<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Título de la promoción (ej: 20% OFF)');
            $table->string('subtitle')->comment('Subtítulo/descripción (ej: Reserva con anticipación)');
            $table->string('icon')->default('fas fa-percent')->comment('Icono Font Awesome');
            $table->string('icon_color')->default('text-primary')->comment('Color del icono (text-primary, text-success, etc.)');
            $table->string('badge_text')->nullable()->comment('Texto del badge (ej: AHORRA AHORA)');
            $table->string('badge_color')->default('bg-primary')->comment('Color del badge');
            $table->string('button_text')->nullable()->comment('Texto del botón');
            $table->string('button_url')->nullable()->comment('URL del botón');
            $table->integer('order')->default(0)->comment('Orden de visualización');
            $table->boolean('is_active')->default(true)->comment('¿Está activa?');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
