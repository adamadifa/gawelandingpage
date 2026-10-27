<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Auth;

class SourceCodeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $claim = $user->sourceCodeClaims()->latest()->first();

        $version   = SiteSetting::where('key', 'source_code_version')->value('value') ?? 'v2.4.0 (Latest Release)';
        $updateUrl = SiteSetting::where('key', 'source_code_update_url')->value('value') ?? '#';
        $changelog = SiteSetting::where('key', 'source_code_changelog')->value('value') ?? 'Pembaruan fitur sistem, optimasi database, dan peningkatan performa.';
        $groupUrl  = SiteSetting::where('key', 'source_code_group_url')->value('value');

        return view('member.source-code', compact('user', 'claim', 'version', 'updateUrl', 'changelog', 'groupUrl'));
    }
}
