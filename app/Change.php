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
    static public function getEURtoUSD(){

        if(isset($_SESSION['EURtoUSD']) && time() < ($_SESSION['EURtoUSD']["timestamp"] + 60)){

            return $_SESSION['EURtoUSD']['rate'];
  
          }else{

            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, 'https://api.exchangeratesapi.io/latest?base=EUR');

            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);

            $buffer = curl_exec($curl_handle);
            $object = json_decode($buffer);

            curl_close($curl_handle);

            $_SESSION['EURtoUSD'] = [ 
                "rate" => $object->rates->USD,
                'timestamp' => time()
            ]; 

            return $object->rates->USD;
        }
    }
    static public function convert($userId){

        $duomenys = new JsonDb();

        $user =  $duomenys->show($userId);

        $userEur = $user['eur'];
        $userUsd = $user['usd'];

        if($_POST['currency1'] == 'eur'){

            if($_POST['currency2'] == 'eur'){
                $_SESSION['note'] = [
                    "message" => "error",
                    "text" => 'Pasirinktos vienodos valiutos'
                ];
            }

            if($_POST['currency2'] == 'usd'){
                if($_POST['sum'] > $userEur){
                    $_SESSION['note'] = [
                        "message" => "error",
                        "text" => 'Nepakankamai lesu saskaitoje'
                    ];
                }else{
                    $rate = self::getEURtoUSD();
                    $usdToAdd = $_POST['sum'] * $rate;
                    $user['usd'] += round($usdToAdd, 2);
                    $user['eur'] -= $_POST['sum'];

                    $duomenys->update($userId, $user);

                    $_SESSION['note'] = [
                        "message" => "message",
                        "text" => 'Operacija sekminga'
                    ];
                }
            }
        }
        
        if($_POST['currency1'] == 'usd'){

            if($_POST['currency2'] == 'usd'){

                $_SESSION['note'] = [
                    "message" => "error",
                    "text" => 'Pasirinktos vienodos valiutos'
                ];
            }

            if($_POST['currency2'] == 'eur'){
                if($_POST['sum'] > $userUsd){

                    $_SESSION['note'] = [
                        "message" => "error",
                        "text" => 'Nepakankamai lesu saskaitoje'
                    ];

                }else{
                    $rate = self::getUSDtoEUR();
                    $eurToAdd = $_POST['sum'] * $rate;
                    $user['eur'] += round($eurToAdd, 2);
                    $user['usd'] -= $_POST['sum'];

                    $duomenys->update($userId, $user);

                    $_SESSION['note'] = [
                        "message" => "message",
                        "text" => 'Operacija sekminga'
                    ];
                }
            }
        }
    }
}