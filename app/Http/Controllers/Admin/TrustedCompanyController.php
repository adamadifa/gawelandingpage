<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrustedCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrustedCompanyController extends Controller
{
    public function index()
    {
        $companies = TrustedCompany::orderBy('sort_order')->get();
        return view('admin.trusted-companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.trusted-companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        TrustedCompany::create($data);

        return redirect()->route('admin.trusted-companies.index')->with('success', 'Partner berhasil ditambahkan!');
    }

    public function edit(TrustedCompany $trusted_company)
    {
        return view('admin.trusted-companies.edit', compact('trusted_company'));
    }

    public function update(Request $request, TrustedCompany $trusted_company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($trusted_company->logo) {
                Storage::disk('public')->delete($trusted_company->logo);
            }
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $trusted_company->update($data);

        return redirect()->route('admin.trusted-companies.index')->with('success', 'Partner berhasil diperbarui!');
    }

    public function destroy(TrustedCompany $trusted_company)
    {
        if ($trusted_company->logo) {
            Storage::disk('public')->delete($trusted_company->logo);
        }
        $trusted_company->delete();
        
        return redirect()->route('admin.trusted-companies.index')->with('success', 'Partner berhasil dihapus!');
    }
}
