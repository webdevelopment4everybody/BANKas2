
<?php
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
<th>Pridėti pinigų</th>
<th>Nuskaičiuoti pinigų</th>
<th>Ištrinti vartotoją</th>
</tr>

<?php
$data1=json_decode(file_get_contents('./../db/data.json'),1);
foreach($data1 as $asmensKodas => $data){
    ?><tr><?php
    echo '<td>'.$data['name'].'</td>';
    echo '<td>'.$data['lastname'].'</td>';
    echo '<td>'.$data['asmensKodas'].'</td>';
    echo '<td>'.$data['saskNr'].'</td>';
    echo '<td>'.'0'.'</td>';
    echo '<td><a href="'.Main\App::URL.'?a=add&user='.$asmensKodas.'">Pridėti pinigų</a></td>';
    echo '<td><a href="'.Main\App::URL.'?a=remove&user='.$asmensKodas.'">Nuskaičiuoti pinigų</a></td>';
    echo '<td><a href="'.Main\App::URL.'users/delete='.$asmensKodas.'">Ištrinti klientą</a></td>';

    ?></tr>
    <?php
} 
?>
</table>