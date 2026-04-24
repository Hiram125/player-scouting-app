<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Report;

class ReportsController extends Controller
{
    // 📊 Reports dashboard (grouped by players + search)
    public function index(Request $request)
    {
        $search = $request->input('search');

        $players = Player::with(['reports' => function ($query) use ($search) {
            if ($search) {
                $query->where('scout_name', 'like', "%{$search}%")
                      ->orWhere('match_context', 'like', "%{$search}%")
                      ->orWhere('comments', 'like', "%{$search}%")
                      ->orWhere('strengths', 'like', "%{$search}%")
                      ->orWhere('weaknesses', 'like', "%{$search}%");
            }
        }])
        ->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhereHas('reports', function ($q) use ($search) {
                      $q->where('scout_name', 'like', "%{$search}%")
                        ->orWhere('match_context', 'like', "%{$search}%")
                        ->orWhere('comments', 'like', "%{$search}%")
                        ->orWhere('strengths', 'like', "%{$search}%")
                        ->orWhere('weaknesses', 'like', "%{$search}%");
                  });
        })
        ->get();

        return view('reports.index', compact('players', 'search'));
    }

    // 📝 Create report form
    public function create(Request $request)
    {
        $players = Player::all();
        $selectedPlayer = $request->player_id ?? null;

        return view('reports.create', compact('players', 'selectedPlayer'));
    }

    // 💾 Store report (FULL FIXED VERSION)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'player_id' => 'required|exists:players,id',
            'scout_name' => 'required|string|max:255',
            'match_context' => 'required|string|max:500',
            'report_date' => 'required|date',

            // ⚽ Performance ratings
            'technical_rating' => 'nullable|integer|min:0|max:100',
            'physical_rating' => 'nullable|integer|min:0|max:100',
            'passing' => 'nullable|integer|min:0|max:100',
            'dribbling' => 'nullable|integer|min:0|max:100',
            'strength' => 'nullable|integer|min:0|max:100',

            // 📝 Qualitative analysis
            'strengths' => 'nullable|string',
            'weaknesses' => 'nullable|string',
            'comments' => 'nullable|string',
            'recommendation' => 'nullable|string',
        ]);

        Report::create($validated);

        return redirect()
            ->route('reports.index')
            ->with('success', 'Report created successfully!');
    }

    // 📄 Single report view
    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    // 👤 Player reports view
    public function showByPlayer(Player $player)
    {
        $reports = $player->reports()->latest()->get();

        return view('reports.player', compact('player', 'reports'));
    }

    // 🗑 DELETE REPORT
    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()
            ->route('reports.index')
            ->with('success', 'Report deleted successfully!');
    }
}