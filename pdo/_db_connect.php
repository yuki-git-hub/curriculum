<?php
    define('DB_DATABASE', 'yigroupBlog');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('PDO_DSN', 'mysql:host=localhost;charset=utf8;dbname='.DB_DATABASE);
  
    try {
        $dbh = new PDO(
            "mysql:dbname=yigroupBlog;host=localhost","root","study",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
        );
        echo 'DBと接続しました。';
    } catch (PDOException $e) {
        echo 'Error:' . $e->getMessage();
        die();
    }
    ?>