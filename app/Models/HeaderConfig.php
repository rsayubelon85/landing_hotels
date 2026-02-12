<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'background_image',
        'button_text',
        'button_url',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $appends = ['background_image_url'];

    /**
     * Mutator para obtener la URL completa de la imagen de fondo
     */
    public function getBackgroundImageUrlAttribute()
    {
        if ($this->background_image) {
            return asset('storage/' . $this->background_image);
        }
        return asset('images/default-header.jpg');
    }
}
