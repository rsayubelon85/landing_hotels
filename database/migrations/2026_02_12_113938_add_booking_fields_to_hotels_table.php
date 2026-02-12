<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->string('property_number')->nullable()->comment('Número de propiedad para reserva');
            $table->string('refpoint')->nullable()->comment('Punto de referencia (ej: Varadero)');
            $table->string('iata_code')->nullable()->comment('Código IATA del aeropuerto (ej: VRA)');
            $table->string('booking_url')->nullable()->comment('URL base de reserva');
            $table->boolean('has_direct_booking')->default(false)->comment('¿Tiene reserva directa?');
        });
    }

    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn(['property_number', 'refpoint', 'iata_code', 'booking_url', 'has_direct_booking']);
        });
    }
};
