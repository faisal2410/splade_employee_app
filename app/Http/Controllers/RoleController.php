<?php

namespace App\Http\Controllers;

use App\Tables\Roles;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Permission;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;

class RoleController extends Controller
{
    public function index(){
        return view('admin.roles.index',[
            'roles'=>Roles::class
        ]);
    }

    public function create(){

return view( 'admin.roles.create', [
    'permissions'=>Permission::pluck('name','id')->toArray()
] );
    }


     public function store(CreateRoleRequest $request)
    {
       $role= Role::create($request->validated());
        $role->syncPermissions($request->permissions );
        Splade::toast( "Role Created Successfully" )->autoDismiss( 3 );
        return to_route( 'admin.roles.index' );
    }


        public function edit(Role $role)
    {
        return view( 'admin.roles.edit', [
       'role' => $role,
       'permissions'=>Permission::pluck('name','id')->toArray()
] );
    }


        public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());
        $role->syncPermissions( $request->permissions );
        Splade::toast( "Role Updated Successfully" )->autoDismiss( 3 );
        return to_route( 'admin.roles.index' );
    }

    public function destroy(Role $role){
        $role->delete();
        Splade::toast( "Role Deleted Successfully" )->autoDismiss( 3 );
        return back();
    }

}
