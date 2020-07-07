<?php 

namespace Main;
use App\DB\JsonDb;

class Change{

    static public function getUSDtoEUR(){

        if(isset($_SESSION['USDtoEUR']) &&  time() < ($_SESSION['USDtoEUR']["timestamp"]  + 60)){

          return $_SESSION['USDtoEUR']["rate"];

        }else{

            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, 'https://api.exchangeratesapi.io/latest?base=USD');
    
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    
            $buffer = curl_exec($curl_handle);
    
            $object = json_decode($buffer);
    
            curl_close($curl_handle);

            $_SESSION['USDtoEUR'] = [
                "rate" => $object->rates->EUR,
                "timestamp" => time()
            ];
    
            return $object->rates->EUR;
        }

    }
}