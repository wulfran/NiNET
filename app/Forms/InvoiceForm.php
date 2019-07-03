<?php

namespace App\Forms;

use App\Company;
use App\Models\Invoice;
use Kris\LaravelFormBuilder\Form;

class InvoiceForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('number', 'text',[
                'label' => 'Numer',
                'attr' => ['disabled' => TRUE]
            ])
            ->add('seller_id', 'select',[
                'choices' => Company::all()->pluck('name', 'id')->toArray(),
                'label' => ' '
            ])
            ->add('buyer_id', 'select', [
                'choices' => Company::all()->pluck('name', 'id')->toArray(),
                'label' => ' '
            ])
            ->add('value_netto', 'number',[
                'label' => 'Wartość netto',
                'attr' => [
                    'disabled' => TRUE,
                    'step' => 0.01
                ]
            ])
            ->add('value_vat', 'number',[
                'label' => 'Wartość VAT',
                'attr' => [
                    'disabled' => TRUE,
                ]
            ])
            ->add('vat_percentage', 'number',[
                'label' => 'VAT %',
                'attr' => [
                    'disabled' => TRUE,
                ]
            ])
            ->add('value_brutto', 'number',[
                'label' => 'Wartość brutto',
                'attr' => [
                    'disabled' => TRUE,
                    'step' => 0.01
                ]
            ])
            ->add('is_paid', 'text', [
                'label' => 'Opłacona',
                'value' => ($this->getModel()->paid() ? 'TAK' : 'NIE'),
                'attr' => ['disabled' => TRUE]
            ])
            ->add('sold_at', 'text',[
                'label' => 'Data sprzedaży',
                'value' => ($this->getModel()->id ? $this->getModel()->sold_at->toDateString() : NULL)
            ])
            ->add('payment_date', 'text',[
                'label' => 'Płatne do',
                'value' => ($this->getModel()->id ? $this->getModel()->payment_date->toDateString() : NULL)
            ])
            ->add('bank_account', 'number',[
                'label' => 'Konto do płatności',
                'attr' => ['disabled' => TRUE]
            ])
            ->add('payment_method', 'select',[
                'label' => 'Forma płatności',
                'choices' => Invoice::PAYMENT_METHODS
            ])
            ->add('comments', 'textarea',[
                'label' => 'Dodatkowe informacje'
            ])
            ->add('issued_by', 'text', [
                'label' => 'Wystawiona przez'
            ])
            ->add('place', 'text', [
                'label' => 'Miejsce wystawienia'
            ])
        ;
    }
}
