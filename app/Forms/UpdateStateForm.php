<?php

namespace App\Forms;

use App\Models\Country;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\FormBuilder\Text;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;

class UpdateStateForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form->method('PUT')
            ->class('space-y-4 p-4 bg-white rounded');

    }

    public function fields(): array
    {
        return [
            Text::make('name')
                ->label('Name')
                ->rules(['required','max:100','min:3']),

            Select::make( 'country_id' )
                 ->label( 'Choose a country' )
                 ->rules(['required'])
                 ->options( Country::pluck('name','id')->toArray() ),

            Submit::make()
                ->label(__('Update')),
        ];
    }
}
