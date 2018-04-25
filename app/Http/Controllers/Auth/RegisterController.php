<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Manajer;
use App\Dosen;
use App\Mahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:4',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function showForm() {
        if(Auth::user() && Auth::user()->isManajer()) {
            return view('auth.register');
        } else {
            return abort(403);
        }
    }

    public function registerUser(Request $request) {
        $data = $request->all();
        $username = $data['username'];
        if(User::where('username',$username)->count()>0) {
            echo '<div class="alert alert-warning alert-dismissible fade show text-center">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning!</strong> This user already exist.
                  </div>';
            return view('auth.register');
        } else {
           $user = $this->create($data);
           $role = $data['role'];
           if($role == User::ROLE_DOSEN) {
               Dosen::create(['id'=>$user->id]);
           }else if($role == User::ROLE_MAHASISWA) {
               Mahasiswa::create(['id'=>$user->id]);
           } else if($role == User::ROLE_MANAJER) {
               Manajer::create(['id'=>$user->id]);
           }
           return view('manajer.index');
        }
//        echo $id;


    }

}
