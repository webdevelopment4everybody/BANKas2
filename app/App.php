<?php  
namespace Main;

use Main\Login;
use Main\Saskaita;
use App\DB\JsonDb;
use Main\App;

use Main\User;
use App\DB\JsonDb as DB;
use App\view\Menu;

class App{
    public static $user = '';
    const DIR = '/Php/Bankas2/public/';
    const VIEW_DIR = './../view/';
    const URL='http://localhost/Php/Bankas2/public/';
    private static $params = [];

    private static $guarded = ['home', 'slaptas-2'];
    public static function start(){
            session_start();
            $param = str_replace(self::DIR, '', $_SERVER['REQUEST_URI']);
            self::$params = explode('/', $param);

            if(self::$params[0]=='add' && isset($_SESSION['login']))
            {
                if(!empty($_POST)){

                    Saskaita::suma();

                    header('Location: /Php/Bankas2/public/add/'.self::$params[1]);
                    die();

                }
                else{
                    App::$user = self::$params[1];

                    require('./../view/prideti.php');
                }
            }

            if(self::$params[0] == 'minus' && isset($_SESSION['login'])){

                if(!empty($_POST)){

                    Saskaita::minus();

                    header('Location: /Php/Bankas2/public/minus/'.self::$params[1]);
                    die();

                }else{
                    App::$user = self::$params[1];

                    require('./../view/minus.php');
                }

            }
            if(self::$params[0]=='remove'&& isset($_SESSION['login'])){
                Saskaita::remove(self::$params[1]);

                header('Location: /Php/Bankas2/public/home');
                die();
            }
            if(self::$params[0] == 'change' && isset($_SESSION['login'])){

                if(!empty($_POST)){

                    
                    header('Location: /Php/Bankas2/public/change/'.self::$params[1]);
                    die();

                }else{
                    App::$user = self::$params[1];

                    require('./../view/keisti.php');
                }

            }

            if(count(self::$params) == 2){
                    if(self::$params[1] == 'addUser'&& isset($_SESSION['login'])){
                        Saskaita::add();
                        self::redirect('home');
                    }
                    if (file_exists(self::VIEW_DIR.self::$params[0].'/'.self::$params[1].'.php')){
                        require(self::VIEW_DIR.self::$params[0].'/'.self::$params[1].'.php');
                    }
                    if(self::$params[0] == 'login' && self::$params[1] == 'logout'){
                        Login::logout();
                    }

                }elseif(count(self::$params) == 1){

                if(self::$params[0] == 'doLogin'){
                    $login = new Login;
                    if($login->result()){
                        self::redirect('home');
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