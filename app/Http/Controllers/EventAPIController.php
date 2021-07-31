<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class EventAPIController extends Controller
{
    public function index()
    {
        //get data from table event
        $event = Event::all();

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
            'elimination_type' => 'required'
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

        //success save to database
        if ($event) {

            return response()->json([
                'success' => true,
                'message' => 'Event Created',
                'data'    => $event
            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Event Failed to Save',
        ], 409);
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
