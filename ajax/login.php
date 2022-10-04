<?php

   $login = trim(filter_var($_POST ['login'], FILTER_SANITIZE_SPECIAL_CHARS));
   $pass = trim(filter_var($_POST ['password'], FILTER_SANITIZE_SPECIAL_CHARS));

   $error ='';


   if(strlen($login) < 3)
      $error = "Введіть логін";
   else if(strlen($pass) < 5)
      $error = "Введіть пароль";

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


   $sql = 'SELECT id FROM users WHERE `login` = ? AND `password` = ?';
   $query = $pdo->prepare($sql);
   $query->execute ([$login, $pass]);

   if($query->rowCount()==0)
         echo "Такого користувача нема";
   else {
         setcookie ('login', $login, time() + 3600 * 24* 30, "/" );
         echo "Done";
       }

 ?>
