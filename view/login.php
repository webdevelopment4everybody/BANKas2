
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,500&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/2b932cd76f.js" crossorigin="anonymous"></script>
<style>
body {
  margin: 0;
    margin-top:50px;
  font-family: 'Montserrat', sans-serif;
  /* background-color:#F4FBFF; */
}
h2{
    /* text-align:center; */
    color:#000;
    font-size:20px;
    margin-left:50px;
}
h1{
    text-align:center;
    color:#000;
    font-size:40px;
    /* margin-left:50px; */
}
form{
    width:200px;
    margin-left:50px;
  }
  input[type=text], select,
    input[type=password],select{
    width:200px;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

button {
  width:100px;
  background-color: #2BA1F0;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 2px;
  cursor: pointer;
}


button:hover {
  color:#000;
}
div{
  width:400px;
  margin-left:calc( 50% - 200px);  
  border-radius: 5px;
  background-color: #E3F4FF;
  padding: 20px;
}
p{
  padding:20px;
  font-size:20px;
  text-align:center;
}

</style>
<h1>BANKAS</h1>
<p>Sveiki, prašome prisijungti</p>
<div>
<h2>Prisijungti <i class="fas fa-sign-in-alt"></i></h2>
<form action="<?= Main\App::URL ?>doLogin" method="post">
User Name:<input type="text" name="user"><br>
User Password:<input type="password" name="password"><br>
<button type="submit">Jungtis</button>
</form>
</div>
<!-- <img src="./../img/download.jpg" alt="bank"> -->

