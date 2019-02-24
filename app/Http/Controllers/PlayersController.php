<?php

namespace App\Http\Controllers;

use App\Model\Player;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teamId)
    {
        return Player::where('team_id', $teamId)->orderBy('updated_at', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $teamId)
    {
        $data = $request->all();
        $data['team_id'] = $teamId;
        $player = Player::create($data);
        return $player;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($teamId, $id)
    {
        $player = Player::find($id);
        if ($player) {
            return $player;
        } else {
            return response()->json(['error' => 'Player not found'], 401);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $teamId, $id)
    {
        $player = Player::find($id);
        if ($player) {
            $player->update($request->all());
            return $player;
        } else {
            return response()->json(['error' => 'Player not found'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($teamId, $id)
    {
        $player = Player::find($id);
        if ($player) {
            $player->delete();
            return response()->json(['message' => 'Deleted']);
        } else {
            return response()->json(['error' => 'Player not found'], 401);
        }
    }
}
