<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function redirectIfNotLoggedIn($auth){
        if (!$auth) {
            return abort(403);
        }
    }

    protected function redirectIfNotManager($auth){
        if (!($auth->isManajer())) {
            return abort(403);
        } 
    }

    protected function redirectIfNotDosen($auth){
        if (!($auth->isDosen())) {
            return abort(403);
        } 
    }

    protected function redirectIfNotMahasiswa($auth){
        if (!($auth->isMahasiswa())) {
            return abort(403);
        } 
    }

    protected function redirectIfNoPermission($auth){
        $user = User::where('username', $username)->first();
        if (!($auth->id == $user->id || $auth->isManajer())) {
            return abort(403);
        }
    }
}
