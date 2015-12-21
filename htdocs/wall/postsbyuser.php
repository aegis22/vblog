<?php
    include("../include/config.inc");
    session_start();
    $selected = $_GET['selected'];
    $result = mysql_query("SELECT * FROM blog_posts WHERE autor='$selected' ORDER BY id DESC") or
        die("No se pudieron consultar las entradas");
        
    $elements = array();
    while ($row = mysql_fetch_array($result)) {
        $elements[] = $row; 
    }
    
    include("../templates/postsbyuser.phtml");
    
?>
