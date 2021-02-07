<?php 

namespace App\Traits;

//Allows admins to access everything independently
trait AdminActions
{
	public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}

