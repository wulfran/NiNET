<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoicePositions extends Model
{
    protected $guarded = ['id'];

    protected $table = 'invoice_positions';

    public $timestamps = false;

    protected $fillable = [
        'invoice_id', 'name', 'price_netto', 'price_vat', 'price_brutto', 'quantity', 'unit', 'value_netto',
        'value_brutto', 'value_vat', 'vat_percentage'
    ];

}
