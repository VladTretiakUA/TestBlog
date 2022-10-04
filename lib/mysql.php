<?php
    $user = 'root';
    $password = '';
    $db = 'web-blog';
    $host = 'localhost';
    $port = 3306;

    $dsn= 'mysql:host=' . $host . ';dbname=' . $db . ';port=' . $port;
    $pdo = new PDO($dsn, $user, $password);

    ?>
