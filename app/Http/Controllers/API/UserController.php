<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function index()
    {
        $users = User::with('role')->get();
        return response()->json([
            'users' => $users,
        ]);
    }

    public function user()
    {
        return response()->json([
            'user' =>  Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
            'role_id' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);
 
        return response()->json([
            'users' => $user,
            'message' => 'Created Sucessfully'
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|unique:users,email,'.$id,
            'email' => 'required|unique:users,email,'.$id,
            'password' => 'required|min:8|confirmed',
            'role_id' => 'required'
        ]);

        $user = User::find($id);

        if($user){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id
            ]);
            return response()->json([
                'users' => $user,
                'message' => 'Updated Sucessfully'
            ]);
        }
        return "User not Found!.";

    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
            return "Deleted Successfully";
        }
        return "User not found";
    }   


}
