<?php
   $username = trim(filter_var($_POST ['username'], FILTER_SANITIZE_SPECIAL_CHARS));
   $email = trim(filter_var($_POST ['email'], FILTER_SANITIZE_EMAIL));
   $login = trim(filter_var($_POST ['login'], FILTER_SANITIZE_SPECIAL_CHARS));
   $pass = trim(filter_var($_POST ['password'], FILTER_SANITIZE_SPECIAL_CHARS));

   $error ='';

   if(strlen($username) < 2)
      $error = "Введіть ім'я";
   else if(strlen($email) < 5)
      $error = "Введіть email";
   else if(strlen($login) < 3)
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

   $sql = 'INSERT INTO users(name, email, login, password) VALUES (?, ?, ?, ?)';
   $query = $pdo->prepare($sql);
   $query->execute ([$username, $email, $login, $pass]);

   echo "Done";


 ?>
