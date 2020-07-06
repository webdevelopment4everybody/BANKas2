
<?php
use App\DB\JsonDb;
use Main\App;
use Main\User;


$db = new JsonDb;
$user = $db->show(App::$user);
?>
<tr><?php

if(isset($_SESSION['note'])){
    if($_SESSION['note']['message'] == 'message'){
        $errorColor = 'green';
    }else{
        $errorColor = 'red';
    }
}?>
<!-- 
<select id='select1' name=\"currency\">
        <option name=\"eur-input\" value=\"eur\">EUR</option>
        <option name=\"usd-input\" value=\"usd\">USD</option>
</select> -->
<?php
echo '<td>'.$user['name'].'</td>'.' '.' ';
echo '<td>'.$user['lastname'].'</td>'.' '.' ';
echo '<td>'.$user['saskNr'].'</td>'.' '.' '. '<br>';
echo '<td>'.$user['amount'].'</td>';
echo '<td>'.$user['eur'].'</td>';
echo  '<td>'.$user['usd'].'</td>';
// echo '<a id="change" style="color:black" href="./../change/'.App::$user.'">Keisti valiuta</a>';
    ?>
    </tr>
<h1>BANKAS.Pridėti lėšas.</h1>
<div>
<form action='./../add/<?=App::$user?>'method="POST">
Kiek pridėti:<br>
<input type="text" name="amount" value=""><br><br>
<input type="hidden" name="id" value="<?=$user['id']?>">
<input type="submit" value="Prideti">
</div>
</form>