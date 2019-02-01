<?php

namespace App\Http\Controllers\Auth;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\KelasTesis;
use App\Mahasiswa;
use App\Manajer;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    public function showForm()
    {
        if (Auth::user() && Auth::user()->isManajer()) {
            return view('auth.register');
        } else {
            return abort(403);
        }
    }

    public function registerUserUIHandler(Request $request)
    // Handle registration coming form web-UI
    {
        $data = $request->all();
        $this->registerUser($data);
        return view('auth.register');
    }


    public function registerBatchUserHandler(Request $request)
    // Handle batch registration using csv --- NOT WORKING YET 
    {
        $data = $request->all();
        $filename = $_SERVER['DOCUMENT_ROOT'] . $data['filename'];
 
        $batchRegisterData = $this->parseBatchRegisterCSV($filename);
        foreach ($batchRegisterData as $newUserData) {
            $this->registerUser($data);
        }

        // TODO: Send the pass to where ?
        // return view('auth.register');
    }



    // TESTING CODE
    public function registerBatchUser($batchRegisterData)
    // Handle batch registration using csv --- NOT WORKING YET 
    {
        foreach ($batchRegisterData as $newUserData) {
            $this->registerUser($newUserData);
        }

        // TODO: Send the pass to where ?
        // return view('auth.register');
    }




    private function parseBatchRegisterCSV($filename)
    {
        
        $file = fopen($filename, "r");
        if ($file) {

            $batchRegisterData = array();
            while ($entry = fgetcsv($file, 1000, ",")) {

                $newUser['name'] = trim($entry[0]);
                $newUser['username'] = trim($entry[1]);
                $newUser['email'] = trim($entry[2]);
                $newUser['phone'] = trim($entry[3]);
                $newUser['role'] = trim($entry[4]);
                $newUser['password'] = str_random(20);
                
                array_push($batchRegisterData, $newUser);
            }
            fclose($file);
        }
        return $batchRegisterData;
    }

    private function registerUser($data)
    {
        if ($this->isDataValid($data)) {
            $this->createUser($data);
            $this->displayRegisterSuccess();
        }
    }

    private function isDataValid($data)
    {
        $username = $data['username'];
        $phone = $data['phone'];

        if ($this->checkUsernameExist($username)) {
            echo $this->errMsgUsernameExisted();
            return false;
        }

        if (!$this->checkUsernameValid($username)) {
            echo $this->errMsgInvalidUsername();
            return false;
        }

        if (!$this->checkPhoneValid($phone)) {
            echo $this->errMsgInvalidPhone();
            return false;
        }

        return true;
    }

    private function checkUsernameExist($username)
    {
        return User::where('username', $username)->count() > 0;
    }

    private function checkUsernameValid($username)
    {
        return (strlen($username) <= 18);
    }

    private function checkPhoneValid($phone)
    {
        return (strlen($phone) <= 18);
    }

    private function createUser($data)
    {
        $user = $this->create($data);
        $role = $data['role'];

        if ($role == User::ROLE_DOSEN) {
            Dosen::create(['id' => $user->id]);
        } else if ($role == User::ROLE_MAHASISWA) {
            $id_kelas_tesis = KelasTesis::orderByRaw('updated_at - created_at DESC')->first(); // DRANOTE: Kelas tesis harus ada dulu (?)
            Mahasiswa::create(['id' => $user->id, 'id_kelas_tesis' => $id_kelas_tesis->id]);
        } else if ($role == User::ROLE_MANAJER) {
            Manajer::create(['id' => $user->id]);
        }
        else{
            echo $data['role']; // RAISE ERROR
        }
    }

    private function errMsgUsernameExisted()
    {
        return '<div class="alert alert-warning alert-dismissible fade show text-center">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        This user <strong>already exist.</strong>
      </div>';
    }

    private function errMsgInvalidUsername()
    {

        return '<div class="alert alert-warning alert-dismissible fade show text-center">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Username</strong> too long (maximum size: 18 characters).
      </div>';
    }

    private function errMsgInvalidPhone()
    {
        return '<div class="alert alert-warning alert-dismissible fade show text-center">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Invalid</strong> phone number.
      </div>';
    }

    private function displayRegisterSuccess()
    {
        return '<div class="alert alert-success alert-dismissible fade show text-center">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success !</strong> New user has successfully registered!
      </div>';
    }

}
