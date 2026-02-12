<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image_path', 'price',
        'rating', 'location', 'amenities', 'is_active',
        'property_number', 'refpoint', 'iata_code', 'booking_url', 'has_direct_booking'
    ];

    protected $casts = [
        'amenities' => 'array',
        'is_active' => 'boolean',
        'has_direct_booking' => 'boolean',
        'price' => 'decimal:2',
        'rating' => 'decimal:2'
    ];

    protected $appends = ['image_url', 'booking_link'];

    /**
     * Mutator para obtener la URL completa de la imagen
     */
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return asset('images/default-hotel.jpg');
    }

    public function getBookingLinkAttribute()
    {
        // 1. Si hay URL personalizada → usarla
        if ($this->booking_url) {
            return $this->booking_url; // ✅ Devuelve lo guardado en BD
        }

        // 2. Si no hay URL personalizada → generarla automáticamente
        if ($this->has_direct_booking && $this->property_number) {
            $params = [
                'propertyNumber' => urlencode(str_replace(' ', '+', $this->property_number)),
                'refpoint' => urlencode($this->refpoint ?? $this->location),
                'iata' => urlencode($this->iata_code ?? 'VRA'),
                'checkIn' => date('Ymd', strtotime('+7 days')),
                'checkOut' => date('Ymd', strtotime('+8 days')),
                'rooms' => 1,
                'adults' => 2,
                'children' => 0,
                'ages' => 0,
                'currency' => 'USD',
                'tab' => 'tari'
            ];

            return 'https://www.cuba.travel/Hotel/Detail?' . http_build_query($params);
        }

        return null; // ❌ Sin reserva directa
    }
}
