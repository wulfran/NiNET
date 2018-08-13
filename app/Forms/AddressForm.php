<?php

namespace App\Forms;

use App\Address;
use Kris\LaravelFormBuilder\Form;

class AddressForm extends Form
{
    public function buildForm()
    {
        $this->add('street_name', 'text',[
            'label' => 'Nazwa ulicy',
        ])
        ->add('street_number', 'text',[
            'label' => 'Numer budynku'
        ])
        ->add('post_code', 'text',[
            'label' => 'Kod pocztowy'
        ])
        ->add('city', 'text',[
            'label' => 'Miasto',
        ])
        ->add('region', 'select', [
            'choices' => Address::regions,
            'label' => 'Województwo'
        ]);
    }
}
