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
        if(!empty($_POST) && self::validateId()){
            if(strlen( $_POST['user']) <=3){
                // $error=true;
                $_SESSION['note'] = [
                    "message" => "error",
                    "text"=>'Tokio vardo negali būti.',
                ];
            }
            elseif(strlen( $_POST['lastname']) <=3){
                // $error=true;
                $_SESSION['note'] = [
                    "message" => "error",
                    "text"=>'Tokios pavardes negali būti.',
                ];

            }
            elseif(strlen($_POST['id']) != 11 || !is_numeric($_POST['id']) ){
                // $error=true;
                $_SESSION['note'] = [
                    "message" => "error",
                    "text"=>'Blogas asmens kodo formatas',
                    ];
                }
            
            if(strlen( $_POST['user']) >=3 && strlen( $_POST['lastname']) >=3 && strlen($_POST['id']) == 11){
            $newObject = [
                'name'=> $_POST['user'],
                'lastname' => $_POST['lastname'],
                'saskNr' => $saskNr,
                'id' => $_POST['id'],
                'amount' => 0,
                'usd' => 0
            ];

            $duomenys = new JsonDb;
            $duomenys->create($newObject);
             // $error=true;
             $_SESSION['note'] = [
                "message" => "message",
                "text"=>'Saskaita sukurta.',
            ];
        }
        
    }
}

    public static function validateId(){
        $duomenys = new JsonDb;
        $data = $duomenys->showAll();

        foreach($data as $value){

            if($value['id'] == $_POST['id']){
            
                $uniqueId = false;

                $_SESSION['note'] = [
                    "message" => "error",
                    "text" => "Saskaita: ".$_POST['id']." jau egzistuoja!"
                ];

            }
        }

        return true;
    }
    public static function remove($id){

        $duomenys = new JsonDb;
        $user = $duomenys->show($id);

        if($user['amount'] > 0 ){

            $_SESSION['note'] = [
                "message" => "error",
                "text" => 'Saskaita nera tuscia!'
            ];

        }else{

            $_SESSION['note'] = [
                "message" => "message",
                "text" => "Saskaita: $id istrinta sekmingai!"
            ];

            $duomenys->delete($id);
        }
       
    }
    public static function sum(){

        if(!empty($_POST)){
            $duomenys = new JsonDb;

            $user = $duomenys->show($_POST['id'] );
                $user['amount'] += $_POST['amount'];
        
                $duomenys->update($_POST['id'], $user);
            
    
        }
        header('Location: /Php/Bankas2/public/home');
        die();
    }
    public static function minus(){

       
        if(!empty($_POST)){
            $duomenys = new JsonDb;

            $user = $duomenys->show($_POST['id'] );
            
                $user['amount'] -= $_POST['amount'];
        
                $duomenys->update($_POST['id'], $user);
        }
        header('Location: /Php/Bankas2/public/home');
        die();
    }
}