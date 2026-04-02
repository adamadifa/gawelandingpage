<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about_sections = AboutSection::all();
        return view('admin.about-sections.index', compact('about_sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about-sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_badge' => 'required',
            'title_badge_icon' => 'required',
            'headline' => 'required',
            'description' => 'required',
            'main_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'floating_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'cta_text' => 'nullable',
            'cta_url' => 'nullable',
            'feature_items' => 'required|array|min:1',
        ]);

        $data = $request->all();

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('about', 'public');
        }

        if ($request->hasFile('floating_image')) {
            $data['floating_image'] = $request->file('floating_image')->store('about', 'public');
        }

        $about = AboutSection::create($data);

        if ($about->is_active) {
            AboutSection::where('id', '!=', $about->id)->update(['is_active' => false]);
        }

        return redirect()->route('admin.about-sections.index')->with('success', 'About Section created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutSection $about_section)
    {
        return view('admin.about-sections.edit', compact('about_section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutSection $about_section)
    {
        $request->validate([
            'title_badge' => 'required',
            'title_badge_icon' => 'required',
            'headline' => 'required',
            'description' => 'required',
            'main_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'floating_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'cta_text' => 'nullable',
            'cta_url' => 'nullable',
            'feature_items' => 'required|array|min:1',
        ]);

        $data = $request->all();

        if ($request->hasFile('main_image')) {
            if ($about_section->main_image && !str_starts_with($about_section->main_image, 'images/')) {
                Storage::disk('public')->delete($about_section->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('about', 'public');
        }

        if ($request->hasFile('floating_image')) {
            if ($about_section->floating_image && !str_starts_with($about_section->floating_image, 'images/')) {
                Storage::disk('public')->delete($about_section->floating_image);
            }
            $data['floating_image'] = $request->file('floating_image')->store('about', 'public');
        }

        $about_section->update($data);

        if ($request->has('is_active') && $request->is_active) {
            AboutSection::where('id', '!=', $about_section->id)->update(['is_active' => false]);
        }

        return redirect()->route('admin.about-sections.index')->with('success', 'About Section updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutSection $about_section)
    {
        if ($about_section->main_image && !str_starts_with($about_section->main_image, 'images/')) {
            Storage::disk('public')->delete($about_section->main_image);
        }
        if ($about_section->floating_image && !str_starts_with($about_section->floating_image, 'images/')) {
            Storage::disk('public')->delete($about_section->floating_image);
        }
        $about_section->delete();
        return redirect()->route('admin.about-sections.index')->with('success', 'About Section deleted successfully');
    }
}
