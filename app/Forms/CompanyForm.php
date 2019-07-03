<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;


class CompanyForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text',[
            'label' => 'Nazwa firmy',
            'rules' => 'required| max:255'
        ])
        ->add('short_name', 'text',[
            'label' => 'Nazwa skrócona',
            'rules' => 'max:100'
        ])
        ->add('nip', 'text',[
            'label' => 'NIP',
            'rules' => 'required'
        ])
        ->add('regon', 'text',[
            'label' => 'REGON'
        ])
        ->add('email', 'email', [
            'label' => 'E-mail'
        ])
        ->add('phone', 'tel',[
            'label' => 'Główny telefon'
        ])
        ->add('phone_2', 'tel',[
            'label' => 'Dodatkowy telefon'
        ])
        ->add('description', 'textarea', [
            'label' => 'Opis'
        ])
        ->add('address', 'form',[
            'class' => 'App\Forms\AddressForm',
            'value' => $this->getModel()->getMainAddress()
        ])
        ->add('submit', 'submit', [
            'label' => 'Zapisz'
        ]);
    }
}
