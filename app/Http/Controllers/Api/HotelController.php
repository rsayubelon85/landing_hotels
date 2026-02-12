<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $location = $request->get('location', '');
        $minPrice = $request->get('min_price');
        $maxPrice = $request->get('max_price');
        $amenities = $request->get('amenities', []);
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        $query = Hotel::where('is_active', true);

        // Búsqueda general
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filtro por ubicación
        if ($location) {
            $query->where('location', 'like', "%{$location}%");
        }

        // Filtro por precio
        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }

        // Filtro por amenities
        if (!empty($amenities)) {
            foreach ($amenities as $amenity) {
                $query->whereJsonContains('amenities', $amenity);
            }
        }

        // Ordenamiento
        $query->orderBy($sortBy, $sortOrder);

        $hotels = $query->get()
            ->map(function ($hotel) {
                $hotel->image_path = $hotel->image_path;
                return $hotel;
            });

        return response()->json($hotels);
    }

    public function autocomplete(Request $request)
    {
        $term = $request->get('term', '');

        if (strlen($term) < 2) {
            return response()->json([]);
        }

        $hotels = Hotel::where('is_active', true)
            ->where(function($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                    ->orWhere('location', 'like', "%{$term}%");
            })
            ->limit(10)
            ->get(['id', 'name', 'location', 'price', 'rating'])
            ->map(function($hotel) {
                return [
                    'id' => $hotel->id,
                    'value' => $hotel->name,
                    'label' => "{$hotel->name} - {$hotel->location}",
                    'price' => number_format($hotel->price, 2),
                    'rating' => number_format($hotel->rating, 1)
                ];
            });

        return response()->json($hotels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'location' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $hotel = new Hotel($validated);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('hotels', 'public');
            $hotel->image_path = $path;
        }

        $hotel->save();

        return response()->json([
            'success' => true,
            'message' => 'Hotel creado exitosamente',
            'data' => $hotel
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        $hotel->image_url = $hotel->image_url;
        return response()->json($hotel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'location' => 'nullable|string|max:255',
            'amenities' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $hotel->update($validated);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($hotel->image_path) {
                \Storage::disk('public')->delete($hotel->image_path);
            }

            $path = $request->file('image')->store('hotels', 'public');
            $hotel->image_path = $path;
        }

        $hotel->image_url = $hotel->image_url;

        return response()->json([
            'success' => true,
            'message' => 'Hotel actualizado exitosamente',
            'data' => $hotel
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        // Eliminar imagen si existe
        if ($hotel->image_path) {
            \Storage::disk('public')->delete($hotel->image_path);
        }

        $hotel->delete();

        return response()->json([
            'success' => true,
            'message' => 'Hotel eliminado exitosamente'
        ]);
    }
}
