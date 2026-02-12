<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        // 🔵 CASO 1: Hotel con URL PERSONALIZADA (se almacena booking_url)
        Hotel::create([
            'name' => 'Iberostar Selection Varadero',
            'description' => 'Resort todo incluido de lujo en Varadero con spa y casino.',
            'price' => 220.00,
            'rating' => 4.8,
            'location' => 'Varadero, Cuba',
            'amenities' => ['Todo Incluido', 'Piscina Infinita', 'Spa', 'Casino', 'Playa Privada'],
            'property_number' => 'HT 52896', // Para generar URL si booking_url está vacío
            'refpoint' => 'Varadero',
            'iata_code' => 'VRA',
            'booking_url' => 'https://www.cuba.travel/Hotel/Detail?propertyNumber=HT+52896&refpoint=Varadero&iata=VRA&checkIn=20260219&checkOut=20260220&rooms=1&adults=2&children=0&ages=0&currency=USD&tab=tari',
            'has_direct_booking' => true,
            'is_active' => true,
        ]);

        // 🟢 CASO 2: Hotel SIN URL PERSONALIZADA (se genera booking_link dinámicamente)
        Hotel::create([
            'name' => 'Hotel Nacional de Cuba',
            'description' => 'Hotel histórico de 5 estrellas en el Malecón de La Habana.',
            'price' => 180.00,
            'rating' => 4.6,
            'location' => 'La Habana, Cuba',
            'amenities' => ['Piscina', 'WiFi Gratuito', 'Restaurante', 'Bar', 'Vista al Mar'],
            'property_number' => 'HT 10001', // Solo esto es necesario para generar URL
            'refpoint' => 'Habana',
            'iata_code' => 'HAV',
            'booking_url' => null, // ❌ Vacío → se generará dinámicamente
            'has_direct_booking' => true,
            'is_active' => true,
        ]);

        // ⚪ CASO 3: Hotel SIN reserva directa
        Hotel::create([
            'name' => 'Hostal La Habana',
            'description' => 'Acogedor hostal familiar en el centro de La Habana.',
            'price' => 45.00,
            'rating' => 4.3,
            'location' => 'La Habana, Cuba',
            'amenities' => ['Desayuno', 'WiFi', 'Aire Acondicionado'],
            'property_number' => null, // ❌ No tiene reserva
            'booking_url' => null, // ❌ No tiene URL
            'has_direct_booking' => false, // ❌ Desactivado
            'is_active' => true,
        ]);

        $this->command->info('✅ 3 hoteles creados con diferentes configuraciones de reserva');
    }
}
