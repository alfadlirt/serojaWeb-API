<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\MatchList;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class EventAPIController extends Controller
{
    public function index()
    {
        //get data from table event
        $event = Event::all();
        //var_dump($event);
        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Event',
            'data'    => $event
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
        //find event by ID
        $event = Event::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Event',
            'data'    => $event
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
            'user_id'   => 'required',
            'event_name' => 'required',
            'number_of_team' => 'required',
            'elimination_type' => 'required',
            'team_list_json' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        //save to database
        
        $event = Event::create([
            'id' => IdGenerator::generate(['table' => 'event', 'length' => 10, 'prefix' => 'EVT']),
            'user_id' => $request->user_id,
            'event_name' => $request->event_name,
            'number_of_team' => $request->number_of_team,
            'elimination_type' => $request->elimination_type,
            'status' => 'ONGOING'
        ]);

        $teamlist = json_decode($request->team_list_json, TRUE);
        
        foreach($teamlist as $data){
            
            Team::create([
                'id' => IdGenerator::generate(['table' => 'team', 'length' => 10, 'prefix' => 'TMG']),
                'event_id' => $event['id'],
                'team_name' => $data['team_name'],
                'instance' => $data['instance']
            ]); 
            
        }

        
        //success save to database
        if ($event) {
            $this->staging($teamlist, $event['id']);
            return response()->json([
                'success' => true,
                'message' => 'Event Created',
                'data'    => count($teamlist)
            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Event Failed to Save',
        ], 409);
    }

 
    /**
     * store
     *
     * @param  mixed $request
     * @return void
    */
    public function staging($teamlist, $eventID){
        /*Populating Variable*/
        $team = count($teamlist);
        $roundup_team = $this->getRounded($team, true);
        $rounddown_team = $this->getRounded($team, false);
        $logged_roundup_team = log($roundup_team, 2);
        $stage = $logged_roundup_team;
        $bracket = 0;
        $bound=$roundup_team-$logged_roundup_team;
        if($team <= $bound){
            $bracket = $team+$bound;
        }
        else{
            $bracket = $roundup_team;
        }

        $stage_chopped = $stage-2;
        $unpair_el_stage = $rounddown_team/2;
        $addition_bracket = $team-$rounddown_team;

        /*Generating Bracket*/
        $bracket_ploted_array = [];
        $stage_counter = 1;
        //Final Bracket
        $final_bracket=[
            'id' => IdGenerator::generate(['table' => 'match_bracket', 'length' => 10, 'prefix' => 'BKT']),
            'event_id' => $eventID,
            'team_a' => NULL,
            'team_b' => NULL,
            'skor_a' => NULL,
            'skor_b' => NULL,
            'winner' => NULL,
            'next_branch' => NULL,
            'is_end' => 1,
            'is_wo' => NULL,
            'stage_number' => $stage_counter,
            'index_number' => 1,
            'stage_type' => 'FINAL',
            'status' => 'UNASSIGNED'
        ];
        $bracket_ploted_array[$stage_counter][1] = MatchList::create($final_bracket);
        $stage_counter++;

        //Mid Bracket
        $k = 2;
        for ($i=1; $i<=$stage_chopped; $i++) {
            $l = 1; //pair-pair counter
            $m = 1; //index counter

            $stage_type="";
            switch ($stage_counter) {
                case 2:
                  $stage_type="SEMI-FINAL";
                  break;
                case 3:
                  $stage_type="QUARTER-FINAL";
                  break;
                default:
                  $stage_type="ELIMINATION-FINAL";
                  break;
            }

            for ($j=1; $j<=$k; $j++) {
                $mid_bracket=[
                    'id' => IdGenerator::generate(['table' => 'match_bracket', 'length' => 10, 'prefix' => 'BKT']),
                    'event_id' => $eventID,
                    'team_a' => NULL,
                    'team_b' => NULL,
                    'skor_a' => NULL,
                    'skor_b' => NULL,
                    'winner' => NULL,
                    'next_branch' => $bracket_ploted_array[$stage_counter-1][$m]['id'],
                    'is_end' => 0,
                    'is_wo' => 0,
                    'stage_number' => $stage_counter,
                    'index_number' => $j,
                    'stage_type' => $stage_type,
                    'status' => 'UNASSIGNED'
                ];

                if($l==2){
                    $l=0;
                    $m++;
                }
                
                $l++;

                $bracket_ploted_array[$stage_counter][$j] = MatchList::create($mid_bracket);
            }
            $stage_counter++;
            $k*=2;
        }

        
        //Elimination Bracket
        $m = 1; //index counter
        $l = 1; //2Hoops Counter
        for ($i=1; $i<=$unpair_el_stage; $i++) {
            $el_bracket=[
                'id' => IdGenerator::generate(['table' => 'match_bracket', 'length' => 10, 'prefix' => 'BKT']),
                'event_id' => $eventID,
                'team_a' => NULL,
                'team_b' => NULL,
                'skor_a' => NULL,
                'skor_b' => NULL,
                'winner' => NULL,
                'next_branch' => $bracket_ploted_array[$stage_counter-1][$m]['id'],
                'is_end' => 0,
                'is_wo' => 0,
                'is_addition' => 0,
                'stage_number' => $stage_counter,
                'index_number' => $l,
                'stage_type' => 'ELIMINATION',
                'status' => 'UNASSIGNED'
            ];

            $bracket_ploted_array[$stage_counter][$l] = MatchList::create($el_bracket);
            $l+=2;
            $m++;
        }

        //Aditional Bracket
        $l = 2; //2Hoops counter
        $m = 1; //index counter
        $k = 1;
        for ($i=1; $i<=$addition_bracket; $i++) {
            $add_bracket=[
                'id' => IdGenerator::generate(['table' => 'match_bracket', 'length' => 10, 'prefix' => 'BKT']),
                'event_id' => $eventID,
                'team_a' => NULL,
                'team_b' => NULL,
                'skor_a' => NULL,
                'skor_b' => NULL,
                'winner' => NULL,
                'next_branch' => $bracket_ploted_array[$stage_counter-1][$m]['id'],
                'is_end' => 0,
                'is_wo' => 0,
                'is_addition' => 1,
                'stage_number' => $stage_counter,
                'index_number' => $l,
                'stage_type' => 'ELIMINATION',
                'status' => 'UNASSIGNED'
            ];
            $bracket_ploted_array[$stage_counter][$l] = MatchList::create($add_bracket);
            $l+=2;
            $m++;
        }

        //Fill In
        $condition = [
            'event_id' => $eventID,
            'stage_type' => 'ELIMINATION'
        ];
        $match_list = MatchList::where($condition)->orderBy('is_addition', 'ASC')->get()->toArray();
        $match_list_count = count($match_list);


        $condition = [
            'event_id' => $eventID
        ];
        $team_list_array = Team::where($condition)->get()->toArray();
        
        $randomized_team = $this->randomizeTeam($team_list_array);
        var_dump($match_list);
        //var_dump($randomized_team);
        $l = 0; //Team Index Counter
        for($i=0; $i<$match_list_count; $i++){
            if(isset($randomized_team[$l+1])){
                MatchList::where('id', $match_list[$i]['id'])
                    ->update(
                    [
                        'team_a'   => $randomized_team[$l]['id'],
                        'team_b'   => $randomized_team[$l+1]['id']
                    ]);
                $l++;
            }
            else{
                MatchList::where('id', $match_list[$i]['id'])
                    ->update(
                    [
                        'team_a'   => $randomized_team[$l]['id'],
                        'is_wo'   => 0
                    ]);
            }
            $l++;
            
        }

    }

    /** 
        * @return int
    */
    public function getRounded($number, $is_up){
        $candidates = [2,4,8,16,32];
        $candidates_reversed = array_reverse($candidates);
        $last = null;
        if($is_up){
            foreach ($candidates_reversed as $cand) {
                if ($cand > $number) {
                    $last = $cand;
                } else if ($cand == $number) {
                    return $number;
                }
            }
            return $last;
        }
        else{
            foreach ($candidates as $cand) {
                if ($cand < $number) {
                    $last = $cand;
                } else if ($cand == $number) {
                    return $number;
                }
            }
            return $last;
        }
    }

    public function randomizeTeam($teamarray){
        shuffle($teamarray);
        return $teamarray;
    }
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $event
     * @return void
     */
    public function update(Request $request, Event $event)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'event_name' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find event by ID
        $event = Event::findOrFail($event->id);

        if ($event) {

            //update event
            $event->update([
                'event_name' => $request->event_name
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Event Updated',
                'data'    => $event
            ], 200);
        }

        //data event not found
        return response()->json([
            'success' => false,
            'message' => 'Event Not Found',
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
        //find event by ID
        $event = Event::findOrfail($id);

        if ($event) {

            //delete event
            $event->delete();

            return response()->json([
                'success' => true,
                'message' => 'Event Deleted',
            ], 200);
        }

        //data event not found
        return response()->json([
            'success' => false,
            'message' => 'Event Not Found',
        ], 404);
    }
}
