<?php
namespace Main;
use App\DB\JsonDb;
class Login{
    private $loginResult = false;
    public function __construct(){
        $data = [
            ['name'=>'Petras', 'pass'=>md5('123')],
            ['name'=>'Migle', 'pass'=>md5('321')],
        ];
        if(!empty($_POST)){//jei paspaudem mygtuka
            foreach ($data as $user) {
                if($user['name'] === $_POST['user']&& 
                $user['pass'] === md5($_POST['password'])){
                    $_SESSION['login'] = 1;
                    $this->loginResult = true;
                }
            }
        }
    }
    public function result(){
       return $this->loginResult;
    }
    public static function auth(){
        return(isset($_SESSION['login']) && $_SESSION['login'] == 1);
    }
}