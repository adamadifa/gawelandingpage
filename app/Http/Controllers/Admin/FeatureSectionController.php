<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeatureSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeatureSectionController extends Controller
{
    public function index()
    {
        $feature_sections = FeatureSection::all();
        return view('admin.feature-sections.index', compact('feature_sections'));
    }

    public function create()
    {
        return view('admin.feature-sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_badge' => 'required',
            'title_badge_icon' => 'required',
            'headline' => 'required',
            'image_path' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('features', 'public');
        }

        $section = FeatureSection::create($data);

        if ($section->is_active) {
            FeatureSection::where('id', '!=', $section->id)->update(['is_active' => false]);
        }

        return redirect()->route('admin.feature-sections.index')->with('success', 'Feature Section created successfully');
    }

    public function edit(FeatureSection $feature_section)
    {
        return view('admin.feature-sections.edit', compact('feature_section'));
    }

    public function update(Request $request, FeatureSection $feature_section)
    {
        $request->validate([
            'title_badge' => 'required',
            'title_badge_icon' => 'required',
            'headline' => 'required',
            'image_path' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_path')) {
            if ($feature_section->image_path && !str_starts_with($feature_section->image_path, 'images/')) {
                Storage::disk('public')->delete($feature_section->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('features', 'public');
        }

        $feature_section->update($data);

        if ($request->has('is_active') && $request->is_active) {
            FeatureSection::where('id', '!=', $feature_section->id)->update(['is_active' => false]);
        }

        return redirect()->route('admin.feature-sections.index')->with('success', 'Feature Section updated successfully');
    }

    public function destroy(FeatureSection $feature_section)
    {
        if ($feature_section->image_path && !str_starts_with($feature_section->image_path, 'images/')) {
            Storage::disk('public')->delete($feature_section->image_path);
        }
        $feature_section->delete();
        return redirect()->route('admin.feature-sections.index')->with('success', 'Feature Section deleted successfully');
    }
}
