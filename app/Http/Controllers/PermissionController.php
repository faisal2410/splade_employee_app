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

class PermissionController extends Controller
{
    public function index(){
        return view('admin.permissions.index',[
            'permissions'=>Permissions::class
        ]);
    }

    public function create(){
        $form = SpladeForm::make()
    ->action( route( 'admin.permissions.store' ) )
    ->fields( [
        Input::make( 'name' )->label( 'Name' ),
        Submit::make()->label( 'Save' ),

    ] )
    ->class( 'space-y-4 bg-white rounded p-4' );

return view( 'admin.permissions.create', [
    'form' => $form,
] );
    }


     public function store(CreatePermissionRequest $request)
    {
        Permission::create($request->validated());
        Splade::toast( "Permission Created Successfully" )->autoDismiss( 3 );
        return to_route( 'admin.permissions.index' );
    }


        public function edit(Permission $permission)
    {
        $form = SpladeForm::make()
        ->action( route( 'admin.permissions.update', $permission ) )
        ->fields( [
        Input::make( 'name' )->label( 'Name' ),
        Submit::make()->label( 'Save' ),

    ] )
    ->fill( $permission )
    ->method( 'PUT' )
    ->class( 'space-y-4 bg-white rounded p-4' );

return view( 'admin.permissions.edit', [
    'form' => $form,
] );
    }


        public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());
        Splade::toast( "Permission Updated Successfully" )->autoDismiss( 3 );
        return to_route( 'admin.permissions.index' );
    }

    public function destroy(Permission $permission){
        $permission->delete();
        Splade::toast( "Permission Deleted Successfully" )->autoDismiss( 3 );
        return back();
    }

}
