
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
}

    echo '<td>'.$user['name'].'</td>';
    echo '<td>'.$user['lastname'].'</td>';
    echo '<td>'.$user['id'].'</td>';
    echo '<td>'.$user['saskNr'].'</td>';
    echo '<td>'.$user['amount'].'</td>';
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