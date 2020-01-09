<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $user = JWTAuth::parseToken()->authenticate();
        // if (!$this->role = $user->hasRole('admin')) {
        //     abort(403, "only admin allow");
        // }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        if (count($permissions) == 0) {
            $permissions = "no permission add yet";
        }
        return response()->json([
            'permissions' => $permissions,
            'response' => 'success',

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
        $permission = Permission::create(['name' => $name]);
        return response()->json([
            'permission' => $name,
            'response' => 'success',

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
        $permission = Permission::find($id) ?? "no permission found";
        return response()->json([
            'permission' => $permission,
            'response' => 'success',

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
            'id' => 'bail|required|exists:permissions',
        ]);
        $permission = Permission::where('id', $request->id)->update($request->all());
        return response()->json([
            'permission' => $permission,
            'response' => 'success',

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
            'id' => 'bail|required|exists:permissions',
        ]);

        $permission = Permission::find($request->id);
        $permission->delete();
        return response()->json([
            'role' => $permission,
            'response' => 'success',

        ], 200);
    }

    public function assignPermissionToRole(Request $request)
    {

        $request->validate([
            'role_id' => "bail|required|exists:roles,id",
            'permssion_id' => "bail|required|exists:permissions,id",
        ]);

        $roleId = $request->role_id;
        $permissionId = $request->permssion_id;
        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);

        if ($role != null && $permission != null) {
            //add permission to role
            $message = $role->givePermissionTo($permission);
            //add role to permission
            //$message = $permission->assignRole($role);
            $message = "Permission : '" . $permission->name . "' asign permission to  Role : '" . $role->name . "'";
        }

        return response()->json([

            'response' => $message,

        ], 200);

    }

    public function assignMultiplePermissionToRole(Request $request)
    {

        $request->validate([
            'role_id' => "bail|required|exists:roles,id",
            'permssion_id' => "bail|required|exists:permissions,id",
        ]);

        $roleId = $request->role_id;
        $permissionId = $request->permssion_id;

        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);

        $message = "";
        if ($role != null && $permission != null) {
            //add multiple permission to role
            $message = $role->syncPermissions($permission);
            //add multiple roles to permission
            //$message = $permission->syncRoles($roles);
            $text = "";
            foreach ($permission as $perm) {
                $text .= $perm->name . " , ";
            }
            $message = "Permission : '" . $text . "' asign permission to  Role : '" . $role->name . "'";
        }

        return response()->json([
            'response' => $message,
        ], 200);

    }

    public function revokePermissionToRole(Request $request)
    {
        $request->validate([
            'role_id' => "bail|required|exists:roles,id",
            'permssion_id' => "bail|required|exists:permissions,id",
        ]);

        $roleId = $request->role_id;
        $permissionId = $request->permssion_id;
        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);

        $message = "";
         if ($role != null && $permission != null) {
            //add permission to role
            $message = $permission->removeRole($role);
            //add role to permission
            //$message =   $role->revokePermissionTo($permission);;
            $message = "Permission : '" . $permission->name . "' remove permission to  Role : '" . $role->name . "'";
        }

        return response()->json([

            'response' => $message,

        ], 200);

    }

    public function revokeMultiplePermissionToRole(Request $request)
    {
        $request->validate([
            'role_id' => "bail|required|exists:roles,id",
            'permssion_id' => "bail|required|exists:permissions,id",
        ]);
        $roleId = $request->role_id;
        $permissionId = $request->permssion_id;

        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);

        $message = "";
        if ($role != null && $permission != null) {
            //remove multiple permission to role
            $message = $role->revokePermissionTo($permission);
            //remove multiple roles to permission
            //$message = $permission->removeRole($role);
            $text = "";
            foreach ($permission as $perm) {
                $text .= $perm->name . " , ";
            }
            $message = "Permission : '" . $text . "' revoke permission to  Role : '" . $role->name . "'";
        }

        return response()->json([

            'response' => $message,

        ], 200);

    }
}
