<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

class HotelFactory extends Factory
{
    protected $model = Hotel::class;

    public function definition(): array
    {
        $this->faker->addProvider(new FakerPicsumImagesProvider($this->faker));

        return [
            'name' => $this->faker->company() . ' Hotel',
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'rating' => $this->faker->randomFloat(1, 3, 5),
            'location' => $this->faker->city() . ', Cuba',
            'image_path' => $this->faker->imageUrl(640, 480, false, 'hotels'),
            'amenities' => [
                'Piscina',
                'WiFi Gratis',
                'Restaurante',
                'Aire Acondicionado',
                'Estacionamiento'
            ],
            'is_active' => true,
        ];
    }
}
