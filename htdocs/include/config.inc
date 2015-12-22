<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '0000');
    define('DB_DATABASE', 'db_blog');
    
    try {
        $dbh = new PDO("mysql:host=localhost;dbname=db_blog", DB_USERNAME, DB_PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
    $db = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or
        die("No se pudo conectar a MySQL");
    $selected = mysql_select_db(DB_DATABASE) or
        die("No se pudo seleccionar la base de datos");
?>
