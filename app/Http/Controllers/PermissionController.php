<?php

namespace App\Http\Controllers;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //
    public function index()
{
    return view('admin.permissions.index',[
        'permissions'=>Permission::all()
    ]);
}
public function store()
{
Request()->validate([
    'name'=>['required']
]);
    Permission::create([
        'name'=> (request('name')),
        'slug'=>(request('name'))
       
    ]);
    
    session()->flash('permission-created-message', 'Permission with name was created ');

    return back();
}


public function edit(permission $permission){
    return view('admin.permissions.edit', ['permission'=> $permission,
    'permissions'=>Permission::all()
    ]);
}

public function update(Permission $permission)
{
    $permission->name=request('name');
    $permission->slug=request('name');
    if ($permission->isDirty('name')) {
        session()->flash('permission-updated', 'permission  updated'.request($permission->name));
        $permission->save();

    } 
    else
     {
 session()->flash('Permission-updated', 'Nothing to  updated'.request($permission->name));
}
    return back();
}


public function attach_permission(Permission $permission)
{
    $permission->permissions()->attach(request('permission'));
    return back();
}
public function destroy(Permission $permission)
{

    $permission->delete();

    session()->flash('permission-deleted', 'Permission Deleted'.$permission->name);

    return back();
}


}
