<?php
    include("../include/config.inc");
    session_start();
    if(!isset($_SESSION['login'])) {
        header("Location: index.php");
    }
    $username = mysql_real_escape_string($_SESSION['username']);
    
    // Getting posts from db
    $result = mysql_query("SELECT * FROM blog_posts ORDER BY id DESC LIMIT 30") or
        die("No se pudieron consultar las entradas");
    $elements = array();
    while ($row = mysql_fetch_array($result)) {
        $elements[] = $row; 
    }
    
    // Getting rank from user
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
    
    if(isset($_POST['texto']) and !empty($_POST['texto'])) {
        $text = mysql_real_escape_string($_POST['texto']);
        $qins = "INSERT INTO blog_posts(autor, texto) VALUES ('$username','$text')";
        $rins = mysql_query($qins) or
            die("No se pudo insertar el texto");
        $sql = "UPDATE blog_admin SET numberposts = numberposts + 1 WHERE username = '$username'";
        $update = mysql_query($sql) or
            die("No se pudo actualizar el número de posts");
    };
    
    include("../templates/wall.phtml");
    
    //mysql_close($db);
?>
