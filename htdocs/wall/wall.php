<?php
    include("../include/config.inc");
    session_start();
    if(!isset($_SESSION['login'])) {
        header("Location: index.php");
    }
    $username = $_SESSION['username'];
    $result = mysql_query("SELECT * FROM blog_posts ORDER BY id DESC") or
        die("No se pudieron consultar las entradas");
    
    while ($row = mysql_fetch_array($result)) {
        printf(" Autor: <a href=postsbyuser.php?selected=%s>%s</a>",$row{'autor'},$row{'autor'});
        printf(" Texto: ".$row{'texto'}."<br>");
    }

    if(array_key_exists('texto', $_POST) and !empty($_POST['texto'])) {
        $qins = "INSERT INTO blog_posts(`autor`, `texto`) VALUES ('".
        mysql_real_escape_string($username)."','".
        mysql_real_escape_string($_POST['texto'])."')";
        $rins = mysql_query($qins) or
            die("No se pudo insertar el texto");
        $sql = "UPDATE blog_admin SET numberposts = numberposts + 1 WHERE username = '$username'";
        $update = mysql_query($sql) or
            die("No se pudo actualizar el número de posts");
    };
    
    //mysql_close($db);
?>

<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Muro de publicaciones</title>
    <link rel="stylesheet" href="css/stylewall.css" type="text/css">
	<meta http-equiv="content-type" content="text/html";charset=utf-8" />
	<meta name="generator" content="Geany 0.21" />
</head>-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Muro de publicaciones</title>
    <link rel="stylesheet" href="css/stylewall.css">
</head>

<body>
    <hr>
	<form class="form" action="wall.php" method="POST">
        <label for="texto">Texto:</label>
        <input type="text" name="texto">
        <input type="submit" value="enviar">
    </form>
    <?php
        $getnumposts = "SELECT numberposts FROM blog_admin WHERE username='$username'";
        $get = mysql_query($getnumposts) or
            die("Incapaz de leer el número de posts");
        $row = mysql_fetch_array($get);
        if ($row['numberposts'] == 0) {
            $rank = "novato";
        } else if ($row['numberposts'] > 0 and $row['numberposts'] < 6) {
            $rank = "amateur";
        } else {
            $rank = "experto";
        }
        printf("Rango: %s", $rank);
    ?>
    <p>Cerrar la cuenta</p>
    <form class="form" action="logout.php" method="POST">
        <input type="submit" value="salir">
    </form>
</body>

</html>

