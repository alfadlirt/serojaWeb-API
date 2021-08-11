<?php

namespace App\Http\Controllers;

use App\Models\MatchList;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatchBracketAPIController extends Controller
{
    public function index()
    {
        //get data from table matchlist
        $matchlist = MatchList::all();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data MatchList',
            'data'    => $matchlist
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
        //find matchlist by ID
        $matchlist = MatchList::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data MatchList',
            'data'    => $matchlist
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
        $matchlist = MatchList::create([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        //success save to database
        if ($matchlist) {

            return response()->json([
                'success' => true,
                'message' => 'MatchList Created',
                'data'    => $matchlist
            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'MatchList Failed to Save',
        ], 409);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $matchlist
     * @return void
     */
    public function update(Request $request, MatchList $matchlist)
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

        //find matchlist by ID
        $matchlist = MatchList::findOrFail($matchlist->id);

        if ($matchlist) {

            //update matchlist
            $matchlist->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);

            return response()->json([
                'success' => true,
                'message' => 'MatchList Updated',
                'data'    => $matchlist
            ], 200);
        }

        //data matchlist not found
        return response()->json([
            'success' => false,
            'message' => 'MatchList Not Found',
        ], 404);
    }


    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function updateSkor(Request $request, $id)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'skor_a'   => 'required',
            'skor_b' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        //find matchlist by ID
        $bracket = MatchList::findOrFail($id);

        if ($bracket) {
            if($request->skor_a>$request->skor_b){
                $bracket->update([
                    'skor_a'     => $request->skor_a,
                    'skor_b'   => $request->skor_b,
                    'winner'   => $bracket['team_a'],
                    'status'   => 'FINISHED'
                ]);
            }
            else{
                $bracket->update([
                    'skor_a'     => $request->skor_a,
                    'skor_b'   => $request->skor_b,
                    'winner'   => $bracket['team_b'],
                    'status'   => 'FINISHED'
                ]);
            }
            //update matchlist
            
            $this->moveToNextBracket($bracket['id']);

            return response()->json([
                'success' => true,
                'message' => 'MatchList Updated',
                'data'    => $bracket
            ], 200);
        }

        //data matchlist not found
        return response()->json([
            'success' => false,
            'message' => 'MatchList Not Found',
        ], 404);
    }

    public function moveToNextBracket($originID){

        $originBracket = MatchList::findOrFail($originID)->toArray();
        
        $condition = [
            'id' => $originBracket['next_branch']
        ];
        $next_bracket = MatchList::where($condition)->get()->toArray();
        //var_dump($next_bracket);
        $condition = [
            'next_branch' => $next_bracket[0]['id']
        ];
        $child_bracket = MatchList::where($condition)->orderBy('id','ASC')->get()->toArray();

        if(count($child_bracket)==1){
            MatchList::where('id', $next_bracket[0]['id'])
            ->update(
            [
                'is_wo'   => 1,
                'is_wo_moved'   => 0
            ]);
        }

        if($child_bracket[0]['id']==$originBracket['id']){
            MatchList::where('id', $next_bracket[0]['id'])
            ->update(
            [
                'team_a'   => $originBracket['winner']
            ]);
        }
        else{
            MatchList::where('id', $next_bracket[0]['id'])
            ->update(
            [
                'team_b'   => $originBracket['winner']
            ]);
        }
        
        
        $condition = [
            'id' => $originBracket['next_branch']
        ];
        $next_bracket = MatchList::where($condition)->get()->toArray();
        if($next_bracket[0]['team_a']!=NULL && $next_bracket[0]['team_a']!=NULL){
            MatchList::where('id', $next_bracket[0]['id'])
            ->update(
            [
                'status'   => "ONGOING"
            ]);      
        }

        $event = Event::findOrFail($originBracket['event_id'])->toArray(); 
        $team = $event['number_of_team'];
        $roundup_team = EventAPIController::getRounded($team, true);
        $logged_roundup_team = log($roundup_team, 2);
        $stage = $logged_roundup_team;
        EventAPIController::moveWOToNextBracket($originBracket['event_id'], $stage);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find matchlist by ID
        $matchlist = MatchList::findOrfail($id);

        if ($matchlist) {

            //delete matchlist
            $matchlist->delete();

            return response()->json([
                'success' => true,
                'message' => 'MatchList Deleted',
            ], 200);
        }

        //data matchlist not found
        return response()->json([
            'success' => false,
            'message' => 'MatchList Not Found',
        ], 404);
    }
}
