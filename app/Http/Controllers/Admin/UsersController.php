<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\Company;
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
        $form = $this->form(UserForm::class,[
          'url' => $url,
          'method' => 'POST',
          'model' => $model
        ]);
        return $form;
    }

    protected function buildActions($model){
        $edit = '<a href="' . route('admin.users.edit', $model) . '" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i></a>';
        $delete = '<a href="' . route('admin.users.delete', $model) . '" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-remove"></i></a>';
        return $edit . $delete;
    }

    protected function buildTable($data){
        $html = '<thead><th>ID</th><th>Login</th><th>E-mail</th><th>Typ</th><th>Akcja</th></thead><tbody>';
        if($data){
            foreach($data as $row){
                $actions = $this->buildActions($row);
                $html = $html . "<tr><td>$row->id</td><td>$row->name</td><td>$row->email</td><td>$row->account_type</td><td>$actions</td></tr>";
                unset($actions);
            }
        }
        $html = $html . '</tbody>';
        return $html;
    }

    public function getIndex(){
        $users = User::query()->select('id', 'name', 'email', 'account_type')->get();

        $table = $this->buildTable($users);

        $heading = 'Użytkownicy';

        return view()->first(['admin.users.list', 'admin.default.list'], compact([
            'users', 'table', 'heading'
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

    public function postDelete(User $user){

        $user->delete();

        return redirect()->route('admin.users.list');
    }
}
