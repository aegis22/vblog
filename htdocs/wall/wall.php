<?php
    include("../include/config.inc");
    session_start();
    if(!isset($_SESSION['login'])) {
        header("Location: index.php");
    }
    $username = mysql_real_escape_string($_SESSION['username']);
    
    // Getting posts from db
    $request = "SELECT * FROM blog_posts ORDER BY id DESC LIMIT 30";
    
    $result = mysql_query($request) or
        die("No se pudieron consultar las entradas");
        
    /*try {
        $result = $dbh->query($request);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }*/    
    
    $elements = array();
    
    while ($row = mysql_fetch_array($result)) {
        $elements[] = $row; 
    }
    
    /*$result->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $result->fetch()) {
        $elements[] = $row;
    }*/
    
    // Getting rank from user
    $getnumposts = "SELECT numberposts FROM blog_admin WHERE username='$username'";
    
    $get = mysql_query($getnumposts) or
        die("Incapaz de leer el número de posts");
    $row = mysql_fetch_array($get);
    
    /*try {
        $get = $dbh->query($getnumposts);
        $get->setFetchMode(PDO::FETCH_ASSOC);
        $row = $get->fetch();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }*/  
    
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
        $sql = "UPDATE blog_admin SET numberposts = numberposts + 1 WHERE username = '$username'";
        $rins = mysql_query($qins) or
            die("No se pudo insertar el texto");
        $update = mysql_query($sql) or
            die("No se pudo actualizar el número de posts");
        
        /*$qins = $dbh->prepare("INSERT INTO blog_posts(autor, texto) VALUES ('$username','$text')");
        $sql = $dbh->prepare("UPDATE blog_admin SET numberposts = numberposts + 1 WHERE username = '$username'");
        try {
            $qins->execute();
            $sql->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }*/    
        
    };
    
    include("../templates/wall.phtml");
    
    //mysql_close($db);
?>
