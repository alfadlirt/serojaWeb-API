<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamAPIController extends Controller
{
    public function index()
    {
        //get data from table team
        $team = Team::all();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Team',
            'data'    => $team
        ], 200);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find team by ID
        $team = Team::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Team',
            'data'    => $team
        ], 200);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $team = Team::create([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        //success save to database
        if ($team) {

            return response()->json([
                'success' => true,
                'message' => 'Team Created',
                'data'    => $team
            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Team Failed to Save',
        ], 409);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $team
     * @return void
     */
    public function update(Request $request, Team $team)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'title'   => 'required',
            'content' => 'required',
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find team by ID
        $team = Team::findOrFail($team->id);

        if ($team) {

            //update team
            $team->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Team Updated',
                'data'    => $team
            ], 200);
        }

        //data team not found
        return response()->json([
            'success' => false,
            'message' => 'Team Not Found',
        ], 404);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find team by ID
        $team = Team::findOrfail($id);

        if ($team) {

            //delete team
            $team->delete();

            return response()->json([
                'success' => true,
                'message' => 'Team Deleted',
            ], 200);
        }

        //data team not found
        return response()->json([
            'success' => false,
            'message' => 'Team Not Found',
        ], 404);
    }
}
