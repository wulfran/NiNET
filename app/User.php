<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'users';

    const account_type = [
        'superuser' => 'SuperUser',
        'admin' => 'Administrator',
        'employee' => 'Pracownik',
        'user' => 'Użytkownik zewnętrzny'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone', 'address_id', 'first_name', 'last_name', 'account_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function address(){
        return $this->belongsTo(Address::class, 'address_id');
    }
}
