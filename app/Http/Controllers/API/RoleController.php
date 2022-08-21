<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return response()->json([
            'roles' => $roles
        ], 200);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|unique:roles',
            'description' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return response()->json([
            'role' => $role
        ], 200);

    }

    public function edit($id)
    {
        $role = Role::find($id);
        return response()->json([
            'role' => $role,
        ], 200);
    }

    public function update(Request $request, $id){

        $role = Role::find($id);
        
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id,
            'description' => 'required'
        ]);

        if($role){
            $role->update([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return response()->json([
                'role' => $role
            ], 200);
        }
        return "Role not Found!.";
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if($role){
            $role->delete();
            return "Role Deleted Successfully.";
        }
        return "Role Not Found!.";
    }
}
