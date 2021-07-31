<?php

namespace App\Http\Controllers;

use App\Models\MatchList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatchListAPIController extends Controller
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
