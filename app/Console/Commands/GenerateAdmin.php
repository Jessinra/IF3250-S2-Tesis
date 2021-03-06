<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Manajer;
use Illuminate\Support\Facades\Hash;

class GenerateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Seeder Manager Account";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "Creating admin user: \n";
        $data = [
            'name' => 'Admin Tesis IF',
            'username' => 'admin',
            'password' => 'adminpassword',
            'phone' => '+620 0000 0000',
            'email' => 'admin-tesis@if.org',
        ];
        echo "Admin Name [" . $data['name'] . "]: ";
        fscanf(STDIN, "%s\n", $buffer);
        if ($buffer) {
            $data['name'] = $buffer;
        }
        echo "Admin Username [" . $data['username'] . "]: ";
        fscanf(STDIN, "%s\n", $buffer);
        if ($buffer) {
            $data['username'] = $buffer;
        }
        echo "Admin Password [" . $data['password'] . "]: ";
        fscanf(STDIN, "%s\n", $buffer);
        if ($buffer) {
            $data['password'] = $buffer;
        }
        echo "Admin Phone [" . $data['phone'] . "]: ";
        fscanf(STDIN, "%s\n", $buffer);
        if ($buffer) {
            $data['phone'] = $buffer;
        }
        echo "Admin Email [" . $data['email'] . "]: ";
        fscanf(STDIN, "%s\n", $buffer);
        if ($buffer) {
            $data['email'] = $buffer;
        }

        if (!User::where('username', $data['username'])->count()) {
            $user = $this->create($data);
            echo "Admin Created\n";
            $manajer = Manajer::create(['id' => $user->id]);
        } else {
            echo "Admin already Exist\n";
        }

    }
}
