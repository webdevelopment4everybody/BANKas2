<?php
use App\DB\JsonDb;
use Main\App;
use Main\User;
require __DIR__ .'/menu.php';

$db = new JsonDb;
$user = $db->show(App::$user);
 $errorColor = '';
?>

<tr>
<?php

if(isset($_SESSION['note'])){
    if($_SESSION['note']['message'] == 'message'){
        $errorColor = 'green';
    }else{
        $errorColor = 'red';
    }
}
    // echo '<td>'.$user['name'].'</td>'.' '.' ';
    // echo '<td>'.$user['lastname'].'</td>'.' '.' ';
    // echo '<td>'.$user['saskNr'].'</td>'.' '.' ' ;
    ?>
    </tr>

    <p class="<?=$errorColor?> "><?php  
        
        if(isset($_SESSION['note'])) {
        
            echo $_SESSION['note']['text'];
            unset($_SESSION['note']);
            
        }

    ?></p><br>
<h1>BANKAS.Nuimti lėšas.</h1>
<div>
<form action='./../minus/<?=App::$user?>' method="POST">
Kiek nuimti:<br>
<input type="text" name="amount" value=""><br><br>
<input type="hidden" name="id" value="<?=$user['id']?>">
<input type="submit" value="Nuimti">
</div>
</form>