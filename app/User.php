<?php
namespace Main;
use Main\App;
use App\DB\JsonDb;
// require __DIR__ . '/home.php';

class User{

    public static function decode() : array{
    
        if(!file_exists('./../db/data.json')){
            return [];
        }
        return json_decode(file_get_contents('./../db/data.json'),1);
    }
    
    public static function encode(array $array){
        file_put_contents('./../db/data.json',json_encode($array));
        }

}