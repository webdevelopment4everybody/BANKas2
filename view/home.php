
<?php
// use app\db\JsonDb;
use Main\App;

require __DIR__ . '/menu.php';

?>
<h1>BANKAS.<br> Klientų sąrašas.</h1>
<table class="table">
<tr>
<th>Vardas</th>
<th>Pavardė</th>
<th>Asmens kodas</th>
<th>Sąskaitos numeris</th>
<th>Likutis</th>
<th>Valiutos keitimas</th>
<th>Pridėti pinigų</th>
<th>Nuskaičiuoti pinigų</th>
<th>Ištrinti vartotoją</th>
</tr>

<?php
use App\DB\JsonDb;
$duomenys = new JsonDb;
$data = $duomenys->showAll();

foreach($data as $asmensKodas => $data){
    ?><tr><?php
    echo '<td>'.$data['firstname'].'</td>';
    echo '<td>'.$data['lastname'].'</td>';
    echo '<td>'.$data['id'].'</td>';
    echo '<td>'.$data['saskNr'].'</td>';
    echo '<td>'.$data['amount'].'</td>';
    echo'<td><a href="./../public/change/'.$data['id'].'">Pakeisti valiutą(eur,usd)</a></td>';
    echo '<td><a href="./../public/add/'.$data['id'].'">Pridėti pinigų</a></td>';
    echo '<td><a href="./../public/minus/'.$data['id'].'">Nuskaičiuoti pinigų</a></td>';
    echo '<td><a href="./../public/remove/'.$data['id'].'">Ištrinti klientą</a></td>';
    
    ?></tr>
    <?php
} 
?>
</table>