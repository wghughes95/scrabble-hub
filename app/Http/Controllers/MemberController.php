<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

class MemberController extends Controller
{
    /**
     * Display a listing of all members.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        $members = Member::all();

        return Inertia::render('Members/Index', [
            'members' => $members,
            'membersCount' => count($members),
        ]);
    }

    /**
     * Display view to create a new member.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('Members/Create', [
            //
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile_no' => 'nullable|string|max:15|min:7',
        ]);

        $validated['joined'] = date('Y-m-d');

        Member::create($validated);

        return redirect(route('members.index'));
    }

    /**
     * Display view to edit a selected member.
     *
     * @return \Inertia\Response
     */
    public function edit(Member $member): Response
    {
        return Inertia::render('Members/Edit', [
            'member' => $member,
        ]);
    }

    /**
     * Store updated details for selected member.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Member $member, Request $request): RedirectResponse | Redirector
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'mobile_no' => 'nullable|string|max:15|min:7',
        ]);

        $member->update($validated);

        return redirect(route('members.index'));
    }

    /**
     * Display details for a selected member.
     *
     * @return \Inertia\Response
     */
    public function show(Member $member): Response
    {
        return Inertia::render('Members/Show', [
            'member' => $member,
            'wins' => $member->wins(),
            'losses' => $member->losses(),
            'totalWins' => $member->totalWins(),
            'totalLosses' => $member->totalLosses(),
            'averageScore' => $member->averageScore(),
            'bestResult' => $member->bestResult(),
        ]);
    }
}
