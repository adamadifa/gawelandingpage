<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FaqSectionController extends Controller
{
    public function index()
    {
        $faq_sections = FaqSection::all();
        return view('admin.faq-sections.index', compact('faq_sections'));
    }

    public function create()
    {
        return view('admin.faq-sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_badge' => 'required',
            'title_badge_icon' => 'required',
            'headline' => 'required',
            'description' => 'nullable',
            'primary_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'secondary_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('primary_image')) {
            $data['primary_image'] = $request->file('primary_image')->store('faq', 'public');
        }

        if ($request->hasFile('secondary_image')) {
            $data['secondary_image'] = $request->file('secondary_image')->store('faq', 'public');
        }

        $section = FaqSection::create($data);

        if ($section->is_active) {
            FaqSection::where('id', '!=', $section->id)->update(['is_active' => false]);
        }

        return redirect()->route('admin.faq-sections.index')->with('success', 'FAQ Section created successfully');
    }

    public function edit(FaqSection $faq_section)
    {
        return view('admin.faq-sections.edit', compact('faq_section'));
    }

    public function update(Request $request, FaqSection $faq_section)
    {
        $request->validate([
            'title_badge' => 'required',
            'title_badge_icon' => 'required',
            'headline' => 'required',
            'description' => 'nullable',
            'primary_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'secondary_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('primary_image')) {
            if ($faq_section->primary_image && !str_starts_with($faq_section->primary_image, 'images/')) {
                Storage::disk('public')->delete($faq_section->primary_image);
            }
            $data['primary_image'] = $request->file('primary_image')->store('faq', 'public');
        }

        if ($request->hasFile('secondary_image')) {
            if ($faq_section->secondary_image && !str_starts_with($faq_section->secondary_image, 'images/')) {
                Storage::disk('public')->delete($faq_section->secondary_image);
            }
            $data['secondary_image'] = $request->file('secondary_image')->store('faq', 'public');
        }

        $faq_section->update($data);

        if ($request->has('is_active') && $request->is_active) {
            FaqSection::where('id', '!=', $faq_section->id)->update(['is_active' => false]);
        }

        return redirect()->route('admin.faq-sections.index')->with('success', 'FAQ Section updated successfully');
    }

    public function destroy(FaqSection $faq_section)
    {
        if ($faq_section->primary_image && !str_starts_with($faq_section->primary_image, 'images/')) {
            Storage::disk('public')->delete($faq_section->primary_image);
        }
        if ($faq_section->secondary_image && !str_starts_with($faq_section->secondary_image, 'images/')) {
            Storage::disk('public')->delete($faq_section->secondary_image);
        }
        $faq_section->delete();
        return redirect()->route('admin.faq-sections.index')->with('success', 'FAQ Section deleted successfully');
    }
}
