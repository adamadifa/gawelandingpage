<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroes = HeroSection::all();
        return view('admin.hero-sections.index', compact('heroes'));
    }

    public function edit(HeroSection $hero_section)
    {
        return view('admin.hero-sections.edit', compact('hero_section'));
    }

    public function update(Request $request, HeroSection $hero_section)
    {
        $request->validate([
            'headline' => 'required',
            'sub_headline' => 'required',
            'cta_text' => 'nullable',
            'cta_url' => 'nullable',
            'cta_secondary_text' => 'nullable',
            'cta_secondary_url' => 'nullable',
            'image_path' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($hero_section->image_path) {
                Storage::disk('public')->delete($hero_section->image_path);
            }
            // Store new image
            $path = $request->file('image_path')->store('heroes', 'public');
            $data['image_path'] = $path;
        }

        $hero_section->update($data);

        if ($request->has('is_active') && $request->is_active) {
            HeroSection::where('id', '!=', $hero_section->id)->update(['is_active' => false]);
        }

        return redirect()->route('admin.hero-sections.index')->with('success', 'Hero Section updated successfully');
    }
}
