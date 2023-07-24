<?php

namespace App\Http\Controllers;

use App\Tables\Permissions;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use Spatie\Permission\Models\Permission;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(){
        return view('admin.permissions.index',[
            'permissions'=>Permissions::class
        ]);
    }

    public function create(){


return view( 'admin.permissions.create', [
     'roles'=>Role::pluck('name','id')->toArray()
] );
    }


     public function store(CreatePermissionRequest $request)
    {
       $permission= Permission::create($request->validated());
       $permission->syncRoles( $request->roles );
        Splade::toast( "Permission Created Successfully" )->autoDismiss( 3 );
        return to_route( 'admin.permissions.index' );
    }


        public function edit(Permission $permission)
    {


return view( 'admin.permissions.edit', [
    'permission'=>$permission,
    'roles'=>Role::pluck('name','id')->toArray()
] );
    }


        public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());
        $permission->syncRoles( $request->roles );
        Splade::toast( "Permission Updated Successfully" )->autoDismiss( 3 );
        return to_route( 'admin.permissions.index' );
    }

    public function destroy(Permission $permission){
        $permission->delete();
        Splade::toast( "Permission Deleted Successfully" )->autoDismiss( 3 );
        return back();
    }

}
