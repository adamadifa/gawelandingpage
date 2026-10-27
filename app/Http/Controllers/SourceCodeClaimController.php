<?php

namespace App\Http\Controllers;

use App\Models\SourceCodeClaim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SourceCodeClaimController extends Controller
{
    public function create()
    {
        // If logged in and already approved, direct to their source code hub
        if (Auth::check() && Auth::user()->hasApprovedSourceCode()) {
            return redirect()->route('member.source-code')
                ->with('info', 'Anda telah terdaftar dan terverifikasi sebagai pemilik lisensi Source Code!');
        }

        $user = Auth::user();
        return view('landing.claim-source-code', compact('user'));
    }

    public function store(Request $request)
    {
        $isGuest = Auth::guest();

        $rules = [
            'whatsapp_number'     => 'required|string|max:30',
            'platform'            => 'required|string|in:lynk_id,saweria,other,direct_transfer,mayar,codecanyon,fastwork,shopee,tokopedia',
            'platform_other'      => 'nullable|string|max:100',
            'order_id'            => 'nullable|string|max:100',
            'purchase_date'       => 'nullable|date',
            'price_paid'          => 'nullable|numeric|min:0',
            'proof_file'          => 'required|file|mimes:jpg,jpeg,png,webp,pdf|max:4096',
            'rating'              => 'required|integer|min:1|max:5',
            'position'            => 'nullable|string|max:255',
            'company'             => 'nullable|string|max:255',
            'testimonial_content' => 'required|string|min:10',
            'avatar'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'terms'               => 'accepted',
        ];

        if ($isGuest) {
            $rules['name']     = 'required|string|max:255';
            $rules['email']    = 'required|string|email|max:255';
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $request->validate($rules, [
            'proof_file.required'          => 'Bukti transaksi / bukti transfer wajib dilampirkan.',
            'testimonial_content.required' => 'Testimoni / ulasan pengalaman wajib diisi.',
            'terms.accepted'               => 'Anda harus menyetujui syarat & ketentuan validitas klaim.',
        ]);

        // Resolve or create User
        if ($isGuest) {
            $existingUser = User::where('email', $request->email)->first();

            if ($existingUser) {
                // If user exists, check credentials
                if (!Hash::check($request->password, $existingUser->password)) {
                    return back()->withInput()->withErrors([
                        'email' => 'Email ini telah terdaftar. Masukkan password akun Anda dengan benar untuk melanjutkan klaim.',
                    ]);
                }
                $user = $existingUser;
            } else {
                $user = User::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'password' => Hash::make($request->password),
                    'role'     => 'member',
                ]);
            }

            Auth::login($user);
        } else {
            $user = Auth::user();
        }

        // Upload Proof File
        $proofPath = $request->file('proof_file')->store('claims/proofs', 'public');

        // Upload Avatar if provided
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('claims/avatars', 'public');
        }

        // Generate a Draft License Key
        $licenseKey = 'SC-PREM-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4)) . '-' . strtoupper(Str::random(4));

        // Create Claim Record
        $claim = SourceCodeClaim::create([
            'user_id'             => $user->id,
            'name'                => $request->name ?: $user->name,
            'email'               => $request->email ?: $user->email,
            'whatsapp_number'     => $request->whatsapp_number,
            'platform'            => $request->platform,
            'platform_other'      => $request->platform_other,
            'order_id'            => $request->order_id,
            'purchase_date'       => $request->purchase_date,
            'price_paid'          => $request->price_paid,
            'proof_file'          => $proofPath,
            'rating'              => $request->rating,
            'position'            => $request->position,
            'company'             => $request->company,
            'testimonial_content' => $request->testimonial_content,
            'avatar'              => $avatarPath,
            'status'              => 'pending',
            'license_key'         => $licenseKey,
        ]);

        return redirect()->route('member.source-code')->with('success', 'Formulir klaim dan testimoni Anda berhasil dikirim! Admin akan segera memverifikasi data Anda (maks 1x24 jam).');
    }
}
