<?php
    include("../include/config.inc");
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
    
    include("../templates/login.phtml");
    
?>
