<?php

namespace App\Http\Controllers\Admin\Auth;

class LoginController extends \Brackets\AdminAuth\Http\Controllers\Auth\LoginController {
    /**
     * Show the application's login form.
     *
     * @return Response
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
}
