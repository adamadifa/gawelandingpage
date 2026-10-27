<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SourceCodeClaim;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class SourceCodeClaimController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');
        $q      = $request->get('q');

        $query = SourceCodeClaim::with(['user', 'testimonial'])->latest();

        if ($status && in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $status);
        }

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('whatsapp_number', 'like', "%{$q}%")
                    ->orWhere('order_id', 'like', "%{$q}%")
                    ->orWhere('platform', 'like', "%{$q}%")
                    ->orWhere('company', 'like', "%{$q}%");
            });
        }

        $claims = $query->paginate(15)->withQueryString();

        $stats = [
            'total'    => SourceCodeClaim::count(),
            'pending'  => SourceCodeClaim::where('status', 'pending')->count(),
            'approved' => SourceCodeClaim::where('status', 'approved')->count(),
            'rejected' => SourceCodeClaim::where('status', 'rejected')->count(),
        ];

        // SC Global Distribution Settings
        $scSettings = [
            'version'    => SiteSetting::where('key', 'source_code_version')->value('value') ?? 'v2.4.0 (Latest Release)',
            'update_url' => SiteSetting::where('key', 'source_code_update_url')->value('value') ?? '',
            'changelog'  => SiteSetting::where('key', 'source_code_changelog')->value('value') ?? '',
            'group_url'  => SiteSetting::where('key', 'source_code_group_url')->value('value') ?? '',
        ];

        return view('admin.source-code-claims.index', compact('claims', 'stats', 'scSettings', 'status', 'q'));
    }

    public function show(SourceCodeClaim $source_code_claim)
    {
        $claim = $source_code_claim->load(['user', 'testimonial']);
        return response()->json($claim);
    }

    public function approve(Request $request, SourceCodeClaim $source_code_claim)
    {
        $claim = $source_code_claim;

        // Optionally publish testimonial
        if ($request->boolean('publish_testimonial', true) && !$claim->testimonial_id) {
            $testimonial = Testimonial::create([
                'name'      => $claim->name,
                'position'  => $claim->position ?: 'Pembeli Source Code',
                'company'   => $claim->company ?: $claim->getPlatformLabel(),
                'content'   => $claim->testimonial_content,
                'avatar'    => $claim->avatar,
                'rating'    => $claim->rating ?: 5,
                'is_active' => true,
            ]);

            $claim->testimonial_id = $testimonial->id;
        }

        $claim->status      = 'approved';
        $claim->admin_note  = $request->admin_note ?: 'Bukti transaksi telah diverifikasi dan valid.';
        $claim->verified_at = now();
        $claim->save();

        return redirect()->back()->with('success', "Klaim untuk {$claim->name} berhasil disetujui! Akses source code telah aktif.");
    }

    public function reject(Request $request, SourceCodeClaim $source_code_claim)
    {
        $request->validate([
            'admin_note' => 'required|string|max:1000',
        ], [
            'admin_note.required' => 'Wajib menyertakan catatan alasan penolakan agar pembeli memahami kendala berkas.',
        ]);

        $claim = $source_code_claim;

        // If previously published testimonial, deactivate it
        if ($claim->testimonial) {
            $claim->testimonial->update(['is_active' => false]);
        }

        $claim->status      = 'rejected';
        $claim->admin_note  = $request->admin_note;
        $claim->verified_at = now();
        $claim->save();

        return redirect()->back()->with('success', "Klaim untuk {$claim->name} telah ditolak dengan catatan.");
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'source_code_version'    => 'required|string|max:100',
            'source_code_update_url' => 'required|url|max:500',
            'source_code_changelog'  => 'nullable|string',
            'source_code_group_url'  => 'nullable|url|max:500',
        ]);

        SiteSetting::updateOrCreate(
            ['key' => 'source_code_version'],
            ['value' => $request->source_code_version, 'type' => 'text']
        );

        SiteSetting::updateOrCreate(
            ['key' => 'source_code_update_url'],
            ['value' => $request->source_code_update_url, 'type' => 'text']
        );

        SiteSetting::updateOrCreate(
            ['key' => 'source_code_changelog'],
            ['value' => $request->source_code_changelog, 'type' => 'textarea']
        );

        SiteSetting::updateOrCreate(
            ['key' => 'source_code_group_url'],
            ['value' => $request->source_code_group_url, 'type' => 'text']
        );

        return redirect()->back()->with('success', 'Pengaturan versi & tautan unduhan Source Code berhasil diperbarui!');
    }
}
