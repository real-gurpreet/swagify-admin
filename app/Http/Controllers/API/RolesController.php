<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use JWTAuth;


class RolesController extends BaseController
{
   /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $user = JWTAuth::parseToken()->authenticate();
        // if(!$this->role =  $user->hasRole('admin')){
        //       abort(403, "only admin allow");
        //     }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json([
            'role' => $roles,
            'response' => 'success'

        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'bail|required|string|max:255',
        ]);
       $name = $request->name;
        Role::create(['name' => $name]);
        return response()->json([
            'role' => $name,
            'response' => 'success'

        ], 201);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::find($id)??"no role found";
        return response()->json([
            'role' => $roles,
            'response' => 'success'

        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'name' => 'bail|required|string',
            'id'=> 'bail|required|exists:roles'
        ]);
        $roles = Role::find($request->id);
        $roles->name = $request->name;
        $roles->save();
        return response()->json([
            'role' => $roles,
            'response' => 'success'

        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id'=> 'bail|required|exists:roles'
        ]);
        $roles = Role::find($request->id);
        $roles->delete();
        return response()->json([
            'role' => $roles,
            'response' => 'deleted'

        ], 200);
    }
}
