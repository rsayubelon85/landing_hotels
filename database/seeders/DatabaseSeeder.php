<?php

namespace Database\Seeders;

use App\Models\HeaderConfig;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Ejecutar seeder de usuario
        $this->call(UserSeeder::class);

        // Configuración del header
        HeaderConfig::create([
            'title' => 'Descubre los Mejores Hoteles en Cuba',
            'subtitle' => 'Alojamiento de lujo en los destinos más hermosos de la isla',
            'button_text' => 'Explorar Hoteles',
            'button_url' => '#hotels',
            'is_active' => true,
        ]);

        // Hoteles de ejemplo
        Hotel::factory()->count(15)->create();

        // Ejecutar seeder de hoteles
        $this->call(HotelSeeder::class);

        // Ejecutar seeder de promociones
        $this->call(PromotionSeeder::class);
    }
}
