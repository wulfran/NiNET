<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\Company;
use App\Forms\CompanyForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class CompaniesController extends Controller
{
    use FormBuilderTrait;

    private function getForm($model){
        $url = $model->id ? route("admin.companies.update", $model) : route('admin.companies.create');
        $form = $this->form(CompanyForm::class,[
            'url' => $url,
            'method' => 'POST',
            'model' => $model
        ]);

        return $form;
    }

    protected function buildActions($model){
        $edit = '<a href="' . route('admin.companies.edit', $model) . '" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i></a>';
        $delete = '<a style="margin-left:10px;" href="' . route('admin.companies.delete', $model) . '" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-remove"></i></a>';
        return $edit . $delete;
    }

    protected function buildTable($data){
        $html = '<thead><th>ID</th><th>Nazwa</th><th>E-mail</th><th>Telefon</th><th>Akcja</th></thead><tbody>';
        if($data){
            foreach($data as $row){
                $actions = $this->buildActions($row);
                $html = $html . "<tr><td>$row->id</td><td>$row->name</td><td>$row->email</td><td>$row->phone</td><td>$actions</td></tr>";
                unset($actions);
            }
        }
        $html = $html . '</tbody>';
        return $html;
    }

    public function getIndex(){
        $companies = Company::all();
        $table = $this->buildTable($companies);
        $heading = 'Lista kontrahentów';

        return view()->first(['admin.companies.list', 'admin.default.list'], compact([
            'companies', 'table', 'heading'
        ]));
    }

    public function getAdd(){
        return $this->getEdit(new Company);
    }

    public function getEdit(Company $company){
        $title = ($company->id ? 'Edycja' : 'Dodawanie') . ' kontrahenta';

        $form = $this->getForm($company);

        return view('admin.companies.edit', compact([
            'title', 'form'
        ]));
    }

    public function postSave(Company $company){
        $form = $this->getForm($company);

        if(!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $form->redirectIfNotValid();
        $company->fill($form->getFieldValues(TRUE));
        $company->save();
        if($company->getMainAddress()){
            $address = $company->getMainAddress();
        } else {
            $address = new Address;
        }

        $address->fill($form->address->getFieldValues(TRUE));
        $address->save();
        $company->address()->save($address);

        return redirect()->route('admin.companies.list');
    }

    public function postDelete(Company $company){
        $company->delete();

        return redirect()->route('admin.companies.list');
    }

}
