<?php

namespace App\Http\Controllers;

use App\Tables\Roles;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\CreateRoleRequest;
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
        $form = SpladeForm::make()
    ->action( route( 'admin.roles.store' ) )
    ->fields( [
        Input::make( 'name' )->label( 'Name' ),
        Submit::make()->label( 'Save' ),

    ] )
    ->class( 'space-y-4 bg-white rounded p-4' );

return view( 'admin.roles.create', [
    'form' => $form,
] );
    }


     public function store(CreateRoleRequest $request)
    {
        Role::create($request->validated());
        Splade::toast( "Role Created Successfully" )->autoDismiss( 3 );
        return to_route( 'admin.roles.index' );
    }

}
