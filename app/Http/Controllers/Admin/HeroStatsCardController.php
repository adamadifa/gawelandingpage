<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroStatsCard;
use Illuminate\Http\Request;

class HeroStatsCardController extends Controller
{
    public function index()
    {
        $cards = HeroStatsCard::latest()->get();
        return view('admin.hero-stats-cards.index', compact('cards'));
    }

    public function create()
    {
        return view('admin.hero-stats-cards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'value' => 'required',
            'icon' => 'required',
            'color_theme' => 'required',
            'position_slot' => 'required',
        ]);

        HeroStatsCard::create($request->all());

        return redirect()->route('admin.hero-stats-cards.index')->with('success', 'Stats Card created successfully');
    }

    public function edit(HeroStatsCard $hero_stats_card)
    {
        return view('admin.hero-stats-cards.edit', compact('hero_stats_card'));
    }

    public function update(Request $request, HeroStatsCard $hero_stats_card)
    {
        $request->validate([
            'title' => 'required',
            'value' => 'required',
            'icon' => 'required',
            'color_theme' => 'required',
            'position_slot' => 'required',
        ]);

        $hero_stats_card->update($request->all());

        return redirect()->route('admin.hero-stats-cards.index')->with('success', 'Stats Card updated successfully');
    }

    public function destroy(HeroStatsCard $hero_stats_card)
    {
        $hero_stats_card->delete();
        return redirect()->route('admin.hero-stats-cards.index')->with('success', 'Stats Card deleted successfully');
    }
}
