<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        Promotion::create([
            'title' => '20% OFF',
            'subtitle' => 'Reserva con anticipación',
            'icon' => 'fas fa-percent',
            'icon_color' => 'text-primary',
            'badge_text' => 'AHORRA AHORA',
            'badge_color' => 'bg-primary',
            'order' => 1,
            'is_active' => true
        ]);

        Promotion::create([
            'title' => 'Todo Incluido',
            'subtitle' => 'Desayuno, almuerzo y cena',
            'icon' => 'fas fa-utensils',
            'icon_color' => 'text-success',
            'badge_text' => 'GOURMET',
            'badge_color' => 'bg-success',
            'order' => 2,
            'is_active' => true
        ]);

        Promotion::create([
            'title' => '1 Noche Gratis',
            'subtitle' => 'Al reservar 5 noches',
            'icon' => 'fas fa-gift',
            'icon_color' => 'text-warning',
            'badge_text' => 'OFERTA ESPECIAL',
            'badge_color' => 'bg-warning',
            'order' => 3,
            'is_active' => true
        ]);
    }
}
