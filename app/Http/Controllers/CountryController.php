<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Tables\Countries;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.countries.index',[

            'countries'=>Countries::class
        ]
            );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        Country::create($request->validated());
        Splade::toast( "Country Created Successfully" )->autoDismiss( 3 );
        return to_route( 'admin.countries.index' );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $form = SpladeForm::make()
    ->action( route( 'admin.countries.update',$country ) )
      ->fill($country)
     ->class('space-y-4 bg-white rounded p-4')
      ->method('PUT')
    ->fields( [
        Input::make( 'name' )->label( 'Country Name' ),
        Input::make( 'country_code' )->label( 'Country Code' ),
        Submit::make()->label( 'Update' ),
    ] );

    return view('admin.countries.edit',[
            'form' => $form,
            'country=>$country'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update($request->validated());
        Splade::toast( "Country Updated Successfully" )->autoDismiss( 3 );
        return to_route( 'admin.countries.index' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        Splade::toast( "Country Deleted Successfully" )->autoDismiss( 3 );
        return back();
    }
}
