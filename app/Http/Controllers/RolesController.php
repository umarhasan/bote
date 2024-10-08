<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $roles = Role::all();
        return view("roles.index")->with('roles', $roles);
    }

    public function create()
    {
        return view("roles.create");
    }
    public function edit($id)
    {
        $permissions = Permission::where('role_id', $id)->pluck('routes')->toArray();
        $roles = Role::find($id);
        return view('roles.edit', compact(['permissions', 'roles', 'id']));

    }
    public function store(Request $request)
    {
        if(Role::where('role_name',$request->input('name'))->exists()){
            return redirect()->back()->withErrors('Role name already exist, please choose different role name.');   
        }

        $permission = $request->all();

        $roles = Role::create([
            'role_name' => $request->input('name'),
        ]);
        $roleId = $roles->id;

        foreach ($permission as $key => $data) {
            if (is_array($data)) {
                foreach ($data as $value) {
                    Permission::create([
                        'role_id' => $roleId,
                        'permission' => $key,
                        'routes' => $value
                    ]);
                }

            }
        }

        return redirect('role');
    }
    public function update(Request $request, $id)
    {
        $permission = $request->all();
        $roleHasPermissions = Permission::where('role_id', $id)->pluck('routes')->toArray();
        $chkPermissionArr = [];
        $roles = Role::find($id);
        if ($roles) {
            $roles->role_name = $request->input('name');
            $roles->save();
        }
        $roleId = $id;

        foreach ($permission as $key => $data) {
            if (is_array($data)) {
                foreach ($data as $value) {
                    array_push($chkPermissionArr, $value);
                    if (!in_array($value, $roleHasPermissions)) {
                        Permission::create([
                            'role_id' => $roleId,
                            'permission' => $key,
                            'routes' => $value
                        ]);
                    }
                }

            }
        }
        for ($i = 0; $i < count($roleHasPermissions); $i++) {
            if (!in_array($roleHasPermissions[$i], $chkPermissionArr)) {
                $permissionToDelete = Permission::where('routes', $roleHasPermissions[$i])->where('role_id', $roleId);
                if ($permissionToDelete) {
                    $permissionToDelete->delete();
                }
            }
        }

        return redirect('role');
    }

    public function delete($id)
    {
        $permissions = Permission::where('role_id', $id);
        if ($permissions) {
            $permissions->delete();
        }
        $id = json_decode($id);

        if (is_array($id)) {

            for ($i = 0; $i < count($id); $i++) {
                $roles = Role::find($id[$i]);
                $roles->delete();
            }

        } else {
            $roles = Role::find($id);
            $roles->delete();
        }

        return redirect()->back();
    }

}
