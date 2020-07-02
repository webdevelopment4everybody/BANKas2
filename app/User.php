<?php
namespace Main;
use Main\App;
require __DIR__ . '/home.php';

class User{

public static function createNew(){
    $saskNr = 'LT';
    for($i = 0; $i<18; $i++){
        $randNr = rand(0,9);
        $saskNr .= $randNr;
    }

    return ['name'=>$_POST['user'], 'lastname'=>$_POST['lastname'],'asmensKodas'=>$_POST['pc'],'saskNr' =>$saskNr];

}
public static function deleteUser(){
    return $_GET[$data['asmensKodas']];
}

}