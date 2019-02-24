<?php

namespace App\Http\Controllers;

use App\Model\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Team::orderByDesc('updated_at')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $team = Team::create($request->all());
        return $team;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::find($id);
        if ($team) {
            return $team;
        } else {
            return response()->json(['error' => 'Team not found'], 401);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $team = Team::find($id);
        if ($team) {
            $team->update($request->all());
            return $team;
        } else {
            return response()->json(['error' => 'Team not found'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        if ($team) {
            $team->delete();
            return response()->json(['message' => 'Deleted']);
        } else {
            return response()->json(['error' => 'Team not found'], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function getWithPlayers($id)
    {

        $team = Team::find($id);
        if ($team) {
            $data = $team->toArray();
            $data['players'] = $team->players;
            return $data;
        } else {
            return response()->json(['error' => 'Team not found'], 401);
        }
    }
}
