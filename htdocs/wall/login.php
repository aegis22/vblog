<?php
    include("../include/config.php");
    session_start();
    if(isset($_POST['username']) and !empty($_POST['username']) 
    and isset($_POST['password']) and !empty($_POST['password'])) {
        $username = mysql_real_escape_string($_POST['username']);
        $password = mysql_real_escape_string($_POST['password']); 
        $password = md5($password);
        $sql = "SELECT * FROM blog_admin WHERE username='$username' AND passcode='$password'";
        $result = mysql_query($sql) or
            die("Incapaz de leer de la base de datos");
        $count = mysql_num_rows($result);
        
        // If result matched $username and $password, table row must be 1 row
        if($count == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['login'] = true;
            header("Location: wall.php");
        } else {
            echo "Usuario o contraseña incorrectos";
        }
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Login</title>
    <link rel="stylesheet" href="css/stylewall.css" type="text/css">
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.21" />
</head>

<body>
    <h1>Muro de publicaciones</h1>
    <p>Bienvenido al muro de publicaciones. Por favor, introduzca su nombre y su contraseña:</p>
    <form class="form" action="" method="post">
        <label>Usuario:</label>
        <input type="text" name="username"/><br />
        <label>Contraseña:</label>
        <input type="password" name="password"/><br/>
        <input type="submit" value=" Login "/><br />
    </form>
    <p> Si no estás registrado, regístrate primero para entrar en nuestro blog:</p>
     <form class="form" action="registration.php" method="POST">
        <input type="submit" value="Registrarse">
    </form>
    <footer>Aegis 2015</footer>
</body>

</html>

