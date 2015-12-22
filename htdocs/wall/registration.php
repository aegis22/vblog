<?php    
    include("../include/config.inc");
    
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
            $sql = "INSERT INTO blog_admin(username, passcode, numberposts) VALUES ('$username', '$password', 0);";
            $result = mysql_query($sql) or
                die("Incapaz de escribir en la base de datos");
            header("Location: index.php");
        }

        /*try {
            $chk = $dbh->query($checkuser);
            if ($chk->rowCount() != 0) {
                echo "Nombre actualmente en uso";
            } else {
                $password = mysql_real_escape_string($_POST['password']); 
                $password = md5($password);
                $sth = $dbh->prepare("INSERT INTO blog_admin(username, passcode, numberposts) VALUES ('$username', '$password', 0)");
                $sth->execute();
                header("Location: index.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }*/
        
    }
    
    include("../templates/registration.phtml");
    
?>
