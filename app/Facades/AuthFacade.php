<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Auth;

class AuthFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'auth';
    }

    public static function useradmin()
    {
        if (Auth::check() && Auth::user()->isAdmin_group() && Auth::user()->isAdmin_group() != null) {
            return Auth::user();
        }elseif(Auth::check() && Auth::user()->isAdmin() && Auth::user()->isAdmin() != null){
            return Auth::user();
        }
        return null;
    }
}