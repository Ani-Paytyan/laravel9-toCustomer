<?php

namespace App\Http\Controllers;

use App\Http\Requests\Team\TeamStoreRequest;
use App\Models\Team;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::orderByDesc('created_at')->paginate(20);

        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(TeamStoreRequest $request)
    {

    }

    public function edit($id)
    {
        $team = Team::where('id',$id)->firstOrFail();

        return view('teams.edit', compact('team'));
    }



}
