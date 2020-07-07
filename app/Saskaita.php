<?php
namespace Main;
use Main\App;
use App\DB\JsonDb;


class Saskaita {
    
    public static function add(){
        $saskNr = 'LT';
            for($i = 0; $i<18; $i++){
                $randNr = rand(0,9);
                $saskNr .= $randNr;
            }
        if(!empty($_POST)){
            if(strlen( $_POST['user']) <=3){
                $error=true;
                $_SESSION['note'] = [
                    "message" => "error",
                    "text"=>'Netesingas vardas.',
                ];
            }
            elseif(strlen( $_POST['lastname']) <=3){
                $error=true;
                $_SESSION['note'] = [
                    "message" => "error",
                    "text"=>'Neteisinga pavardė.',
                ];
            }
            elseif(strlen($_POST['id']) != 11 || !is_numeric($_POST['id'])){
                $error=true;
                $_SESSION['note'] = [
                    "message" => "error",
                    "text"=>'Neteisingas asmens kodo formatas.',
                    ];
                } 
                if(!self::checkId()){
                    $_SESSION['note'] = [
                        "message" => "message",
                        "text"=>'Toks asmuo jau yra įrašytas.',
                    ];
                  }   else{
            if(strlen( $_POST['user']) >=3 && strlen( $_POST['lastname']) >=3 && strlen($_POST['id']) == 11 ){
            $newObject = [
                'name'=> $_POST['user'],
                'lastname' => $_POST['lastname'],
                'saskNr' => $saskNr,
                'id' => $_POST['id'],
                'amount' => 0,
                'usd' => 0,
                'eur'=>0
            ];
            $duomenys = new JsonDb;
            $duomenys->create($newObject);
             $error=true;
             $_SESSION['note'] = [
                "message" => "message",
                "text"=>'Asmuo įrašytas.',
            ];
        }
                        }
    }
}
    public static function checkId(){
        $duomenys = new JsonDb;
        $data = $duomenys->showAll();
        $uniqueId = true;
        foreach($data as $value){
            if($value['id'] == $_POST['id']){
                $uniqueId = false;
                return false;
                $_SESSION['note'] = [
                    "message" => "error",
                    "text" => "Saskaita: ".$_POST['id']." jau yra."
                ];
            }
        }
        return true;
    }
    
public static function remove($id){
    
        $duomenys = new JsonDb;
        $user = $duomenys->show($id);

        if($user['amount'] > 0 ){
            $error=true;
            $_SESSION['note'] = [
                "message" => "error",
                "text" => 'Sąskaitos negalima ištrinti, nes ji nėra tuščia.'
            ];

        }else{
            $error=true;
            $_SESSION['note'] = [
                "message" => "message",
                "text" => "Sąskaita ištrinta."
            ];

            $duomenys->delete($id);
        }
       
    }
    public static function suma(){

        if(!empty($_POST)){
            $duomenys = new JsonDb;

            $user = $duomenys->show($_POST['id'] );
                $user['amount'] += $_POST['amount'];
        
                $duomenys->update($_POST['id'], $user);
            
    
        }
        if($user['amount'] > 0){
            $_SESSION['note'] = [
                "message" => "message",
                "text"=>'Vartotojui pridėta '.$_POST['amount'] .' eurai(-ų)!',
                ];
        }
        header('Location: /Php/Bankas2/public/home');
        die();
    }
    public static function minus(){

       
        if(!empty($_POST)){
            $duomenys = new JsonDb;

            $user = $duomenys->show($_POST['id'] );
            if($user['amount'] >= ($_POST['amount'] ?? 0)){

                $user['amount'] -= $_POST['amount'];
        
                $duomenys->update($_POST['id'], $user);
            $_SESSION['note'] = [
            "message" => "message",
            "text"=>'Iš vartotojo nuimta '.$_POST['amount']. ' euras(-ų).']
            ;
            header('Location: /Php/Bankas2/public/home');
            die();
        }else{
        $_SESSION['note'] = [
            "message" => "error",
            "text"=>'Vartotojas  neturi pakankamai pinigų, todėl pinigai nenuskaičiuoti.'
            ];
            header('Location: /Php/Bankas2/public/home');
        die();
    }

    }
    }

}
