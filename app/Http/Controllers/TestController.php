<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\RegisterController;

class TestController extends Controller
{
    /*
    Class used for Php random testing only !
     */

    public function test()
    {
        /*
        Apply your draft / test here
         */

        $registerController = new RegisterController;

        $documentRoot = $_SERVER['DOCUMENT_ROOT'];
        $defaultPath = "/../storage/batchRegister/batchRegister.csv";
        $filename = $documentRoot . $defaultPath;
 
        $batchRegisterData = $this->parseBatchRegisterCSV($filename);
        $registerController->registerBatchUser($batchRegisterData);
    }

    private function parseBatchRegisterCSV($filename)
    {
        
        $file = fopen($filename, "r");
        if ($file) {

            $batchRegisterData = array();
            while ($entry = fgetcsv($file, 1000, ",")) {

                $newUser['name'] = $entry[0];
                $newUser['username'] = $entry[1];
                $newUser['email'] = $entry[2];
                $newUser['phone'] = $entry[3];
                $newUser['role'] = $entry[4];
                $newUser['password'] = str_random(20);
                
                array_push($batchRegisterData, $newUser);
            }
            fclose($file);
        }
        return $batchRegisterData;
    }

    private function testDocumentRoot()
    {
        echo $_SERVER['DOCUMENT_ROOT'];
        $this->separator();
    }

    private function separator()
    {
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
    }
}
