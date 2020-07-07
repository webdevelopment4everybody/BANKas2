<?php
use App\DB\JsonDb;
use Main\App;
use Main\Change;

$duomenys = new JsonDb; $user = $duomenys->show(App::$user);
?>
<tr><?php

if(isset($_SESSION['note'])){
    if($_SESSION['note']['message'] == 'message'){
        $errorColor = 'green';
    }else{
        $errorColor = 'red';
    }
}

$select = "<select id=\"select1\" name=\"currency1\">
        <option name=\"eur-input\" value=\"eur\">EUR</option>
        <option name=\"usd-input\" value=\"usd\">USD</option>
        </select>";

$select2 = "<select id=\"select2\" name=\"currency2\">
        <option name=\"eur-input\" value=\"eur\">EUR</option>
        <option name=\"usd-input\" value=\"usd\">USD</option>
        </select>";


       

// echo '<td>'.$user['name'].'</td>'.' '.' ';
// echo '<td>'.$user['lastname'].'</td>'.' '.' ';
// echo '<td>'.$user['saskNr'].'</td>'.' '.' '. '<br>';
// echo '<td>'.$user['eur'].'</td>';
// echo  '<td>'.$user['usd'].'</td>';
// echo '<a id="change" style="color:black" href="./../change/'.App::$user.'">Keisti valiuta</a>';
?>
    </tr>
<h1>BANKAS.Keisti valiutą.</h1>
<div>
<form action='./../change/<?=App::$user?>'method="POST">
Iš <?="$select"?>  <input id="form-input" type="number" step="0.01" name="sum" min="0" required> į   <?="$select2"?><br>
<input type="text" name="" value=""><br><br>
<input type="hidden" name="id" value="<?=$user['id']?>">
<button id="submit" type="submit">Keisti</button>
</div>
</form>