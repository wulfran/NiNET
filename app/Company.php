<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $table = 'companies';

    public $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
        'name', 'short_name', 'nip', 'regon', 'email', 'phone', 'phone_2', 'description'
    ];

    const ADDRESS_TYPE = [
        'main' => 'Adres główny',
        'secondary' => 'Adres dodatkowy'
    ];

    public function address(){
        return $this->belongsToMany(Address::class, 'companies_addresses', 'company_id', 'address_id')->withPivot('type');
    }

    public function getMainAddress(){
        return $this->address->first(function($item){
            return $item->pivot->type == 'main';
        });
    }
}
