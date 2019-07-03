<?php

namespace App\Forms;

use App\User;
use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Nazwa użytkownika',
            'Rules' => 'required'
        ])
        ->add('email', 'email',[
            'label' => 'e-mail',
            'rules' => 'required'
        ])
        ->add('first_name','text',[
            'label' => 'Imie',
            'rules' => 'required|min:3|max:25'
        ])
        ->add('last_name','text',[
            'label' => 'Nazwisko',
            'rules' => 'required|min:3|max:65'
        ])
        ->add('account_type','select',[
            'choices' => User::account_type,
            'label' => 'Typ konta',
            'rules' => 'required'
        ])
        ->add('phone', 'number',[
            'label' => 'Telefon'
        ])
        ->add('address', 'form', [
            'class' => 'App\Forms\AddressForm'
        ])
        ->add('submit', 'submit',[
            'label' => 'Zapisz'
        ]);
    }

}
