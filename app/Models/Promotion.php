<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'icon',
        'icon_color',
        'badge_text',
        'badge_color',
        'button_text',
        'button_url',
        'order',
        'is_active'
    ];

    /**
     * Scope para obtener solo promociones activas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para ordenar por el campo order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
