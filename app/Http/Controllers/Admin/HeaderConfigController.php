<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeaderConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderConfigController extends Controller
{

    public function edit()
    {
        $config = HeaderConfig::where('is_active', true)->first();
        if (!$config) {
            $config = new HeaderConfig(['is_active' => true]);
        }
        return view('admin.header.edit', compact('config'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $config = HeaderConfig::where('is_active', true)->first();

        if (!$config) {
            $config = new HeaderConfig(['is_active' => true]);
        }

        $config->fill($validated);

        if ($request->hasFile('background_image')) {
            if ($config->background_image) {
                Storage::disk('public')->delete($config->background_image);
            }

            $path = $request->file('background_image')->store('headers', 'public');
            $config->background_image = $path;
        }

        $config->save();

        return redirect()->route('admin.header.edit')
            ->with('success', 'Configuración actualizada exitosamente');
    }
}
