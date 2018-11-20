<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Forms\CompanyForm;
use App\Forms\InvoiceForm;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class InvoicesController extends Controller
{
    use FormBuilderTrait;

    private function getForm($model, $formClass, $table){
        $url = $model->id ? route("admin.$table.update", $model) : route("admin.$table.create");
        $form = $this->form($formClass,[
            'url' => $url,
            'method' => 'POST',
            'model' => $model
        ]);

        return $form;
    }

    protected function getActions($model){
        $edit = '<a href="' . route('admin.invoices.edit', $model) . '" class="btn btn-success btn-sm"><i class="fa fa-fw fa-edit"></i></a>';
        $delete = '<a style="margin-left:10px;" href="' . route('admin.invoices.delete', $model) . '" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-remove"></i></a>';
        return $edit . $delete;
    }

    protected function buildTable($data){
        $html = '<thead><th>ID</th><th>Numer</th><th>Data wystawienia</th><th>Data płatności</th><th>Kwota</th><th>Opłacnoa</th><th>Zaległa</th><th>Akcja</th></thead><tbody>';
        if($data){
            foreach($data as $row){
                $actions = $this->getActions($row);
                $html = $html . "<tr>
                    <td>$row->id</td>
                    <td>$row->number</td>
                    <td>" . $row->sold_at->toDateString() . "</td>
                    <td>" . $row->payment_date->toDateString() . "</td>
                    <td>$row->value_brutto</td>
                    <td>" . ($row->paid() ? "<span class='returned_positive'>TAK</span>" : "<span class='returned_negative'>NIE</span>") . "</td>
                    <td>" . ($row->overdue() ? "<span class='returned_negative'>TAK</span>" : "<span class='returned_positive'>NIE</span>") . "</td>
                    <td>$actions</td></tr>";
                unset($actions);
            }
        }
        $html = $html . '</tbody>';
        return $html;
    }

    public function getIndex(){
        $invoices = Invoice::query()->select()->where('archive', '=', FALSE)->get();

        $table = $this->buildTable($invoices);

        $heading = 'Lista faktur';

        return view()->first(['admin.invoices.list', 'admin.default.list'], compact([
            'table', 'heading'
        ]));
    }

    public function getAdd(){
        $invoice = new Invoice;
        return $this->getEdit($invoice);
    }

    public function getEdit(Invoice $invoice){
        $title = ($invoice->id ? 'Edycja' : 'Dodawanie') . ' faktury';

        $form = $this->getForm($invoice, InvoiceForm::class, 'invoices');

        $company = new Company;
        $companyForm = $this->getForm($company, CompanyForm::class, 'companies');

        return view('admin.invoices.edit', compact([
            'title', 'form', 'invoice', 'companyForm'
        ]));
    }
}
