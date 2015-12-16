<?php
    include("../include/config.php");
    if(isset($_POST['username']) and !empty($_POST['username']) 
    and isset($_POST['password']) and !empty($_POST['password'])) {
        $username = mysql_real_escape_string($_POST['username']);
        $checkuser = "SELECT * FROM blog_admin WHERE username='$username'";
        $check = mysql_query($checkuser) or
            die("Incapaz de leer de la base de datos");
        if (mysql_num_rows($check) != 0) {
            echo "Nombre actualmente en uso";
        } else {
            $password = mysql_real_escape_string($_POST['password']); 
            $password = md5($password);
            $sql = "INSERT INTO blog_admin(username, passcode) VALUES ('$username', '$password');";
            $result = mysql_query($sql) or
                die("Incapaz de escribir en la base de datos");
            header("Location: login.php");
        }
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>Registro</title>
    <link rel="stylesheet" href="css/stylewall.css" type="text/css">
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.21" />
</head>

<body>
    <h1>Registro</h1>
    <form class="form" action="registration.php" method="post">
        <label>Usuario:</label>
        <input type="text" name="username"/><br />
        <label>Contraseña:</label>
        <input type="password" name="password"/><br/>
        <input type="submit" value=" Registrarse "/><br />
    </form>
    <p> Volver a la página de login</p>
    <form class="form" action="login.php" method="POST">
        <input type="submit" value="volver">
    </form>
</body>

</html>
