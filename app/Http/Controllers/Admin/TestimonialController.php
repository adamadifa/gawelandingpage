<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $data = $request->except('avatar');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial berhasil ditambahkan!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $data = $request->except('avatar');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('avatar')) {
            if ($testimonial->avatar && !str_starts_with($testimonial->avatar, 'http') && !str_starts_with($testimonial->avatar, 'images/')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($testimonial->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial berhasil diperbarui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->avatar && !str_starts_with($testimonial->avatar, 'http') && !str_starts_with($testimonial->avatar, 'images/')) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($testimonial->avatar);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial berhasil dihapus!');
    }
}
