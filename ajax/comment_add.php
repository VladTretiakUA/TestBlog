<?php
   $username = trim(filter_var($_POST ['username'], FILTER_SANITIZE_SPECIAL_CHARS));
   $mess = trim(filter_var($_POST ['mess'], FILTER_SANITIZE_SPECIAL_CHARS));
   $id = trim(filter_var($_POST ['id'], FILTER_SANITIZE_SPECIAL_CHARS));

   $error ='';

   if(strlen($username) < 2)
      $error = "Введіть ім'я";
   else if(strlen($mess) < 5)
      $error = "Введіть email";

   if($error != ''){
     echo $error;
     exit();
   }

   $user = 'root';
   $password = '';
   $db = 'web-blog';
   $host = 'localhost';
   $port = 3306;

   $dsn= 'mysql:host=' . $host . ';dbname=' . $db . ';port=' . $port;
   $pdo = new PDO($dsn, $user, $password);

   $pass = md5($pass);

   $sql = 'INSERT INTO comments(name, mess, article_id) VALUES (?, ?, ?)';
   $query = $pdo->prepare($sql);
   $query->execute ([$username, $mess, $id]);

   echo "Done";


 ?>
