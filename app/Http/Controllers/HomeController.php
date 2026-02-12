<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HeaderConfig;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $header = HeaderConfig::where('is_active', true)->first();

        // Obtener término de búsqueda
        $search = $request->get('search', '');

        // Query base
        $query = Hotel::where('is_active', true);

        // Aplicar búsqueda si existe
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Ordenar por fecha de creación (más recientes primero)
        $query->orderBy('created_at', 'desc');

        // Paginar resultados
        $hotels = $query->paginate(10);

        // Mantener el parámetro de búsqueda en la paginación
        $hotels->appends(['search' => $search]);

        return view('welcome', compact('header', 'hotels'));
    }

    /**
     * Búsqueda en tiempo real (API)
     */
    public function search(Request $request)
    {
        $search = $request->get('q', '');
        $limit = $request->get('limit', 10);

        if (strlen($search) < 2) {
            return response()->json([]);
        }

        $hotels = Hotel::where('is_active', true)
            ->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->limit($limit)
            ->get(['id', 'name', 'location', 'price', 'rating', 'image_path'])
            ->map(function($hotel) {
                return [
                    'id' => $hotel->id,
                    'name' => $hotel->name,
                    'location' => $hotel->location,
                    'price' => number_format($hotel->price, 2),
                    'rating' => number_format($hotel->rating, 1),
                    'image_url' => $hotel->image_url,
                    'url' => route('hotel.show', $hotel->id)
                ];
            });

        return response()->json($hotels);
    }
}

