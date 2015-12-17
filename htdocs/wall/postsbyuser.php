<?php
    include("../include/config.inc");
    session_start();
    $selected = $_GET['selected'];
    $result = mysql_query("SELECT * FROM blog_posts WHERE autor='$selected' ORDER BY id DESC") or
        die("No se pudieron consultar las entradas");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="encoding">
    <title>Busqueda por nombre</title>
    <link rel="stylesheet" href="css/stylewall.css">
</head>

<body>
    <ul>
        <?php while ($row = mysql_fetch_array($result)) { ?>
            <li>Autor: <?= $row['autor'] ?>; Texto: <?= $row['texto'] ?></li>
        <?php } ?>
    </ul>
	<form class="form" action="wall.php" method="POST">
        <input type="submit" value="volver">
    </form>
</body>

</html>
