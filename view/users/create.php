
<h1>BANKAS<br>Naujas klientas.</h1>
<div>
<form action="<?= Main\App::URL ?>users/addUser"method="POST">
Vardas:<br>
<input type="text" name="user" placeholder="Vardas"><br>
Pavardė: <br>
<input type="text" name="lastname" placeholder="Pavarde"><br>
Asmens kodas:<br>
<input type="text" name="id" placeholder="Asmens kodas"><br><br>
<input type="submit" value="Add">
</div>
</form>