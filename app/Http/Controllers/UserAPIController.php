<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class UserAPIController extends Controller
{

    public function index()
    {
        //get data from table user
        $user = User::all();


        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data User',
            'data'    => $user
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
        //find user by ID
        $user = User::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data User',
            'data'    => $user
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
            'name'   => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        //save to database
        $user = User::create([
            'id'     => IdGenerator::generate(['table' => 'user', 'length' => 10, 'prefix' => 'USR']),
            'name'   => $request->name,
            'username'   => $request->username,
            'password'   => password_hash($request->password, PASSWORD_DEFAULT),
            'status'   => 'A',
        ]);

        //success save to database
        if ($user) {

            return response()->json([
                'success' => true,
                'message' => 'User Created',
                'data'    => $user
            ], 201);
        }

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'User Failed to Save',
        ], 409);
    }

    /**
     * user login auth
     *
     * @param  mixed $request
     * @return void
     */
    public function authentication(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $condition = [
            'username' => $request->username,
            'status' => 'A'
        ];
        $check = User::where($condition)->first();
        if ($check) {
            if (password_verify($request->password, $check['password'])) {
                $session_data = [
                    'id' => $check['id'],
                    'name' => $check['name'],
                    'username' => $check['username'],
                    'logged_in' => true
                ];
                return response()->json([
                    'success' => true,
                    'message' => 'User Authenticated',
                    'data'    => $session_data
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Username/Password Not Match'
                ], 200);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Username Not Found'
            ], 200);
        }

    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    public function update(Request $request, User $user)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'username' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find user by ID
        $user = User::findOrFail($user->id);

        if ($user) {

            //update user
            $user->update([
                'name'   => $request->name,
                'username'   => $request->username
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User Updated',
                'data'    => $user
            ], 200);
        }

        //data user not found
        return response()->json([
            'success' => false,
            'message' => 'User Not Found',
        ], 404);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    public function updatepassword(Request $request, User $user)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'newpassword' => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        //find user by ID
        $user = User::findOrFail($user->id);

        if ($user) {
            if (!password_verify($request->oldpassword, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Old Password Not Match'
                ], 200);
            }


            //update user
            $user->update([
                'password' => password_hash($request->newpassword, PASSWORD_DEFAULT),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User Updated',
                'data'    => $user
            ], 200);
        }

        //data user not found
        return response()->json([
            'success' => false,
            'message' => 'User Not Found',
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
        //find user by ID
        $user = User::findOrfail($id);

        if ($user) {

            //delete user
            //$user->delete();
            $user->update([
                'status'   => 'D'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User Deleted',
            ], 200);
        }

        //data user not found
        return response()->json([
            'success' => false,
            'message' => 'User Not Found',
        ], 404);
    }
}
