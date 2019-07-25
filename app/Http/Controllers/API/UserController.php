<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{

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
        return User::latest()->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
        //return ['message' => 'I have your data'];
        // return User::create([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'type' => $request['type'],
        //     'bio' => $request['bio'],
        //     'photo' => $request['photo'],
        //     'password' => Hash::make($request['password']),
        // ]);


        $data = $request->except(['_token','password_confirmation']);
        $data['password'] = Hash::make($request['password']);

        $newUser = User::forceCreate($data);
        return $newUser->toJson();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function profile()
    {
        return auth('api')->user()->toJson();
    }


    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();
       // return $request->photo;

        if($request->photo){

            $name = time(). '.' . explode('/', explode(':', substr($request->photo,0,strpos
            ($request->photo, ';'))) [1] ) [1];

        \Image::make($request->photo)->save(public_path('img/profile/').$name);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $user1 = User::findOrFail($id);
        $this->validate($request,[
            'name' => 'required',
            'password' => 'string|min:6|confirmed',
            //'type' => 'required',
            'bio' => 'required|string|max:191',
            'email' => 'string|email|max:191|unique:users,email,'.$user1->id,
        ]);
            $user = User::findOrfail($id);
            $user->name = $request->name;
            $user->password = Hash::make($request->password);

            $user->type = $request->type;
            $user->bio = $request->bio;
            $user->email = $request->email;
            $user->save();
        return response()->json(['message','Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return ['message' => 'User Deleted'];
    }
}


// 'email' =$collection = collect(['John Doe', 'Jane Doe']);
//             $collection->dd();
