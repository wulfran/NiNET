<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    public function creating(User $user)
    {
        if(is_null($user->name)){
            $user->name = $user->email;
        }
    }
}
