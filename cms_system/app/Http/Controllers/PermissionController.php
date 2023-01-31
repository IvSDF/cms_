<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index(){

        $permissions = Permission::all();
        return view('admin.permissions.index', ['permissions' => $permissions]);
    }

    public function edit(Permission $permission){
        return view('admin.permissions.edit', ['permission'=>$permission]);
    }

    public function update(Permission $permission){

        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('_');

        if($permission->isDirty('name')){
            session()->flash('permission-update', 'Permission Update: '. request('name'));
            $permission->save();
        } else {
            session()->flash('permission-update', 'Nothing has been updated');
        }

        return back();

    }

    public function store(){

        request()->validate([
            'name'=>['required']
        ]);

        Permission::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('_'),
        ]);

        return back();
    }

    public function destroy(Permission $permission){

        $permission->delete();
        session()->flash('permission-deleted', 'Permission was Deleted' );
        return back();
    }
}
