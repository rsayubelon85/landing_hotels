<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::ordered()->get();
        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.promotions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'subtitle' => 'required|string|max:200',
            'icon' => 'required|string|max:50',
            'icon_color' => 'required|string|max:50',
            'badge_text' => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:50',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        Promotion::create($validated);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promoción creada exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'subtitle' => 'required|string|max:200',
            'icon' => 'required|string|max:50',
            'icon_color' => 'required|string|max:50',
            'badge_text' => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:50',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $promotion->update($validated);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promoción actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promoción eliminada exitosamente');
    }
}
