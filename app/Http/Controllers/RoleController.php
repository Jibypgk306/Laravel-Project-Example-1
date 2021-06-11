<?php

namespace App\Http\Controllers;
use App\Role;
Use App\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //

public function index()
{
    return view('admin.roles.index',[
        'roles'=>Role::all()
    ]);
}
public function store()
{
Request()->validate([
    'name'=>['required']
]);
    Role::create([
        'name'=> request('name'),
        'slug'=>(request('name'))
       
    ]);
    
    session()->flash('role-created-message', 'Role with name was created ');

    return back();
}
public function edit(Role $role){
    return view('admin.roles.edit', ['role'=> $role,
    'permissions'=>Permission::all()
    ]);
}


public function update(Role $role)
{
    $role->name=request('name');
    $role->slug=request('name');
    if ($role->isDirty('name')) {
        session()->flash('role-updated', 'Role  updated'.request($role->name));
        $role->save();

    } 
    else
     {
 session()->flash('role-updated', 'Nothing to  updated'.request($role->name));
}
    return back();
}


public function attach_permission(Role $role)
{
    $role->permissions()->attach(request('permission'));
    return back();
}
public function detach_permission(Role $role)
{
    $role->permissions()->detach(request('permission'));
    return back();
}




public function destroy(Role $role)
{

    $role->delete();

    session()->flash('role-deleted', 'Role Deleted'.$role->name);

    return back();
}






}
