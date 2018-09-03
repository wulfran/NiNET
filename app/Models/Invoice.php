<?php

namespace App\Models;

use App\Company;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'invoices';

    public $dates = ['sold_at', 'payment_date', 'created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
        'number', 'seller_id', 'buyer_id', 'value_netto', 'value_vat', 'vat_percentage', 'value_brutto',
        'is_paid', 'sold_at', 'payment_date', 'bank_account', 'payment_method', 'comments', 'created_at'
    ];

    const PAYMENT_METHODS = [
        'wire_transfer' => 'Przelew',
        'cash' => 'Gotówka',
        'online_payment' => 'Płatność online'
    ];

    public function positions(){
        return $this->hasMany(InvoicePositions::class, 'invoice_id', 'id');
    }

    public function seller(){
        return $this->belongsTo(Company::class, 'seller_id', 'id');
    }

    public function buyer(){
        return $this->belongsTo(Company::class, 'buyer_id', 'id');
    }

    public function paid(){
        return ($this->is_paid ? TRUE : FALSE);
    }

    public function archived(){
        return $this->archive;
    }

    public function overdue(){
        return (Carbon::now()->diffInDays($this->payment_date, false) < 0 ? TRUE : FALSE);
    }
}
