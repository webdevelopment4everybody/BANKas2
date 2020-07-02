<?php  
namespace Main;

use Main\Login;

use Main\User;
use App\DB\JsonDb as DB;
use App\view\Menu;

class App{
    const DIR = '/Php/Bankas2/public/';
    const VIEW_DIR = './../view/';
    const URL='http://localhost/Php/Bankas2/public/';
    private static $params = [];

    private static $guarded = ['menu', 'slaptas-2'];
    public static function start(){
            session_start();
            $param = str_replace(self::DIR, '', $_SERVER['REQUEST_URI']);
            self::$params = explode('/', $param);

            if(count(self::$params) == 2){
                if(self::$params[0] == 'users'){

                    if(self::$params[1] == 'addUser'){
                        $newUser = User::createNew();
                        $db =new DB;
                        $db->create($newUser);
                        self::redirect('home');
                    }elseif(self::$params[1] == 'delete'){
                        $User = User::deleteUser();
                        $db=json_decode(file_get_contents('./../db/data.json'),1);
                        $db->delete($User);
                        file_put_contents('./../db/data.json', json_encode([]));
                        self::redirect('home');

                    }
                    if (file_exists(self::VIEW_DIR.self::$params[0].'/'.self::$params[1].'.php')){
                        require(self::VIEW_DIR.self::$params[0].'/'.self::$params[1].'.php');
                    }
                }

            }elseif(count(self::$params) == 1){


                if(self::$params[0] == 'doLogin'){
                    $login = new Login;
                    if($login->result()){
                        self::redirect('menu');
                    } else {
                        self::redirect('login');
                    }
                }

                if(in_array(self::$params[0], self::$guarded)){
                    if(!Login::auth()){
                        self::redirect('login');
                    }
                }
               if (file_exists(self::VIEW_DIR.self::$params[0].'.php')){
                require(self::VIEW_DIR.self::$params[0].'.php');
            }

        }
    }
    public static function getUriParams(){
        return self::$params;
    }
    public static function redirect($param){
        header('Location: '.self::URL.$param);
        die();
    }
}