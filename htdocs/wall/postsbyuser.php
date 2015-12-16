<?php
    include("../include/config.inc");
    session_start();
    $selected = $_GET['selected'];
    $result = mysql_query("SELECT * FROM blog_posts WHERE autor='$selected' ORDER BY id DESC") or
        die("No se pudieron consultar las entradas");
    
    while ($row = mysql_fetch_array($result)) {
        printf(" Autor: ".$row{'autor'}." Texto: ".$row{'texto'}."<br>");
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Busqueda por nombre</title>
    <link rel="stylesheet" href="css/stylewall.css" type="text/css">
	<meta http-equiv="content-type" content="text/html";charset=utf-8" />
	<meta name="generator" content="Geany 0.21" />
</head>

<body>
	<form class="form" action="wall.php" method="POST">
        <input type="submit" value="volver">
    </form>
</body>

</html>
