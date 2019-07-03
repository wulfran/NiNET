<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class TimerForm extends Form
{
    public function buildForm()
    {
        $this->add('start', 'text', [
            'label' => 'Czas od',
        ])->add('end', 'text', [
            'label' => 'Czas do'
        ])->add('notes', 'textarea',[
            'label' => 'Notatki'
        ])->add('submit', 'submit',[
            'label' => 'Zapisz'
        ]);
    }
}
