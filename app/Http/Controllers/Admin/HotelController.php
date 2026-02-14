<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Nette\Utils\Image;


class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Cambiado a simplePaginate

        return view('admin.hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hotels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'rating' => 'nullable|numeric|min:0|max:5',
            'location' => 'nullable|string|max:255',
            'amenities' => 'required|array|min:1',
            'amenities.*' => 'required|string|max:255|distinct',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
            'has_direct_booking' => 'boolean',
        ], [
            'amenities.required' => 'Debes agregar al menos un servicio.',
            'amenities.min' => 'Debes agregar al menos un servicio.',
            'amenities.*.required' => 'El servicio no puede estar vacío.',
            'amenities.*.distinct' => 'No puedes agregar servicios duplicados.',
            'property_number.required_if' => 'El número de propiedad es obligatorio para reservas directas.',
            'name.required' => 'El nombre del hotel es obligatorio.',
            'price.required' => 'El precio es obligatorio.',
            'price.min' => 'El precio no puede ser negativo.',
            'image.max' => 'La imagen no debe superar los 2MB.',
            'image.image' => 'El archivo debe ser una imagen válida.'
        ]);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->has_direct_booking) {
            $validator['property_number'] = 'required|string|max:50';
            $validator['refpoint'] = 'nullable|string|max:100';
            $validator['iata_code'] = 'nullable|string|max:3';
            $validator['booking_url'] = 'nullable|url';
        }

        try {
            $hotel = new Hotel();
            $hotel->name = $request->name;
            $hotel->description = $request->description;
            $hotel->price = $request->price;
            $hotel->rating = $request->rating ?? 0;
            $hotel->location = $request->location;
            $hotel->amenities = $request->amenities;
            $hotel->is_active = $request->has('is_active');
            $hotel->has_direct_booking = $request->has('has_direct_booking');
            $hotel->property_number = $request->property_number;
            $hotel->refpoint = $request->refpoint;
            $hotel->iata_code = $request->iata_code;
            $hotel->booking_url = $request->booking_url;


            if ($request->hasFile('image_path')) {
                $path = $request->file('image_path')->store('hotels', 'public');
                $hotel->image_path = $path;
            }

            $hotel->save();

            return redirect()->route('admin.hotels.index')
                ->with('success', '¡Hotel creado exitosamente!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear el hotel: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        // Validación personalizada
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'rating' => 'nullable|numeric|min:0|max:5',
            'location' => 'nullable|string|max:255',
            'amenities' => 'required|array|min:1',
            'amenities.*' => 'required|string|max:255|distinct',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'boolean',
            'has_direct_booking' => 'boolean',

        ], [
            'amenities.required' => 'Debes agregar al menos un servicio.',
            'amenities.min' => 'Debes agregar al menos un servicio.',
            'amenities.*.required' => 'El servicio no puede estar vacío.',
            'amenities.*.distinct' => 'No puedes agregar servicios duplicados.',
            'name.required' => 'El nombre del hotel es obligatorio.',
            'price.required' => 'El precio es obligatorio.',
            'price.min' => 'El precio no puede ser negativo.',
            'image.max' => 'La imagen no debe superar los 2MB.',
            'image.image' => 'El archivo debe ser una imagen válida.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->has_direct_booking) {
            $validator['property_number'] = 'required|string|max:50';
            $validator['refpoint'] = 'nullable|string|max:100';
            $validator['iata_code'] = 'nullable|string|max:3';
            $validator['booking_url'] = 'nullable|url';
        }

        try {
            $hotel->name = $request->name;
            $hotel->description = $request->description;
            $hotel->price = $request->price;
            $hotel->rating = $request->rating ?? $hotel->rating;
            $hotel->location = $request->location;
            $hotel->amenities = $request->amenities;
            $hotel->is_active = $request->has('is_active');
            $hotel->has_direct_booking = $request->has('has_direct_booking');
            $hotel->property_number = $request->property_number;
            $hotel->refpoint = $request->refpoint;
            $hotel->iata_code = $request->iata_code;
            $hotel->booking_url = $request->booking_url;

            // Actualizar imagen si se proporciona una nueva
            if ($request->hasFile('image')) {
                // Eliminar imagen anterior si existe
                if ($hotel->image_path) {
                    Storage::disk('public')->delete($hotel->image_path);
                }

                $path = $request->file('image')->store('hotels', 'public');
                $hotel->image_path = $path;
            }

            $hotel->save();

            return redirect()->route('admin.hotels.index')
                ->with('success', '¡Hotel actualizado exitosamente!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el hotel: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        try {
            // Eliminar imagen si existe
            if ($hotel->image_path) {
                Storage::disk('public')->delete($hotel->image_path);
            }

            $hotel->delete();

            return redirect()->route('admin.hotels.index')
                ->with('success', '¡Hotel eliminado exitosamente!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el hotel: ' . $e->getMessage());
        }
    }
}
