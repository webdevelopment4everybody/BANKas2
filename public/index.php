<?php
use Main\App; //namespace vardas ir klases vardas
require '..\vendor\autoload.php';

App::start();

echo '<pre>';

// var_dump(App::getUriParams());