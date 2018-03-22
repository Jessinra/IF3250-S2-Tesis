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

    /**
     * Debug Only will be disabled, to generate admin user
     * @param $password password admin
     */
    public function generateAdmin() {
            if (!User::where('username', 'superadmin')->count()) {
<<<<<<< HEAD
                $data = ['name' => "Admin Tesis IF", 'username' => 'superadmin', 'password' => 'admin123', 'email' => 'adminif@if.org'];
=======
                $data = ['name' => "Admin Tesis IF", 'username' => 'superadmin', 'password' => 'admin123', 'phone'=>'123','email' => 'adminif@if.org'];
>>>>>>> develop
                $user = $this->create($data);
                echo "User Created";
                $manajer = Manajer::create(['id' => $user->id]);
//                echo json_encode($user);
            } else {
                echo "User already Exist";
            }

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
            echo "User already exist";
        } else {
            echo "Creating user...<br>";
           $user = $this->create($data);
           echo "User: ".$user->username." created...<br>";
           echo "Creating Model";
           $role = $data['role'];
           if($role == User::ROLE_DOSEN) {
               Dosen::create(['id'=>$user->id]);
           }else if($role == User::ROLE_MAHASISWA) {
               Mahasiswa::create(['id'=>$user->id]);
           } else if($role == User::ROLE_MANAJER) {
               Manajer::create(['id'=>$user->id]);
           }
        }
//        echo $id;


    }

}
