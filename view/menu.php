
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
  font-family: 'Montserrat', sans-serif;
}
h1{
    text-align:center;
    color:#000;
    font-size:30px;
}
table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 1200px;
  margin-left:calc(50% - 600px);
  
}

th, td {
  padding: 15px;
}
a{
    text-decoration:none;
    color:#2BA1F0;
}

.menu {
  overflow: hidden;
  background-color: #2BA1F0;
  padding-left:40px;
}

.menu a {
  float: left;
  width:29.5%;
  color: #f1f1f1;
  text-align: center;
  padding: 20px 16px;
  text-decoration: none;
  font-size: 17px;
}

.menu a:hover {
  color: #000;
}

.menu a.active {
  background-color: #fff;
  color: #000;
}
.red{
    background-color: #F65C55;
    height:40px;
    line-height:40px;
        }
.green{
    background-color: #B2FCDB;
    height:40px;
    line-height:40px;
        }
  form{
    width:400px;
  }
  input[type=text], select {
    width:400px;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width:150px;
  background-color: #2BA1F0;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 2px;
  cursor: pointer;
}

input[type=submit]:hover {
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
}

</style>
<body>
 <nav class="menu">
    <a href = "<?=Main\App::URL. 'home'?>">Pradinis</a>
        <a href = "<?=Main\App::URL. 'users/create'?>">Pridėti naują vartotoją</a>
        <a class="navButton logout" href="./../public/login/logout">Atsijungti <i class="fas fa-sign-out-alt"></i> </a>
 </nav>
<p class="$klaidos_spalva"><?php  
        
        if(isset($_SESSION['note'])) {
            echo $_SESSION['note']['text'];
            unset($_SESSION['note']);
            
        }

    ?></p><br>
<!-- </body>
</html> -->