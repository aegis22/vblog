<?php
    include("../include/config.inc");
    session_start();
    $selected = $_GET['selected'];
    
    $request = "SELECT * FROM blog_posts WHERE autor='$selected' ORDER BY id DESC";
    
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
    
    include("../templates/postsbyuser.phtml");
    
?>
