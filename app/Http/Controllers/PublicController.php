<?php

namespace App\Http\Controllers;

use Auth;

class PublicController extends LoginController 
{
    function main(){
        if (!Auth::check())
        return view('pages.auth.login');
        return LoginController::checkRoles();
    }
}
