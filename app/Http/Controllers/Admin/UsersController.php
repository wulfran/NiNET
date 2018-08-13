<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\Forms\UserForm;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    use FormBuilderTrait;

    private function getForm($model){
        $url = $model->id ? route("admin.users.update", $model) : route('admin.users.create');
//        return $form = $this->plain([
//            'url'       => $url,
//            'method'    => 'POST',
//            'model'     => $model
//        ]);
          $form = $this->form(UserForm::class,[
              'url' => $url,
              'method' => 'POST',
              'model' => $model
          ]);
          return $form;
    }

    public function getIndex(){
        $users = User::query()->select('id', 'name', 'email', 'account_type')->get();
        return view()->first(['admin.users.list', 'admin.default.list'], compact([
            'users'
        ]));
    }

    public function getAdd(){
        return $this->getEdit(new User);
    }

    public function getEdit(User $user){

        $title = ($user->id ? 'Edycja' : 'Dodawanie') . ' użytkownika';

        $form = $this->getForm($user);
        return view('admin.users.edit', compact([
            'title', 'form'
        ]));
    }

    public function postSave(User $user){
        $form = $this->getForm($user);

        if(!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $form->redirectIfNotValid();

        if(request()->address['city'] && request()->address['street_name']) {
            if(!$user->address){
                $address = new Address;
            } else {
                $address = $user->address;
            }
            $address->fill($form->address->getFieldValues(TRUE));
            $address->save();
            $user->address_id = $address->id;
        } else {
            $user->address_id = NULL;
        }

        $user->fill($form->getFieldValues(TRUE));
        $user->save();

        return redirect()->route('admin.users.list');
    }
}
