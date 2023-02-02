<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Member;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

class ResultController extends Controller
{
    /**
     * Display a listing of all results.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        $results = Result::with(['playerOne', 'playerTwo'])->orderByDesc('date')->limit(5)->get();

        return Inertia::render('Results/Index', [
            'results' => $results,
            'resultsCount' => count($results),
            'leaderboard' => Member::getLeaderboard(),
            'leaderboardCount' => count(Member::getLeaderboard()),
            'highestScore' => Result::highestScore(),
            'lowestScore' => Result::lowestScore(),
        ]);
    }

    /**
     * Display view to create a new member.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('Results/Create', [
            'members' => Member::all(),
        ]);
    }

    /**
     * Store a newly created member in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request): RedirectResponse | Redirector
    {
        $validated = $request->validate([
            'player_1_id' => 'required|integer',
            'player_2_id' => 'required|integer',
            'player_1_score' => 'required|integer',
            'player_2_score' => 'required|integer',
            'date' => 'required|date_format:Y-m-d',
        ]);

        if ($validated['player_1_score'] > $validated['player_2_score']) {
            $validated['winner'] = 'Player 1';
        } else {
            $validated['winner'] = 'Player 2';
        }

        Result::create($validated);

        return redirect(route('results.index'));
    }
}
