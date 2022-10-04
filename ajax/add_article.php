<?php
   $title = trim(filter_var($_POST ['title'], FILTER_SANITIZE_SPECIAL_CHARS));
   $anons = trim(filter_var($_POST ['anons'], FILTER_SANITIZE_SPECIAL_CHARS));
   $full_text = trim(filter_var($_POST ['full_text'], FILTER_SANITIZE_SPECIAL_CHARS));


   $error ='';

   if(strlen($title) < 5)
      $error = "Введіть назву статті";
   else if(strlen($anons) < 10)
      $error = "Введіть анонс статті";
   else if(strlen($full_text) < 10)
      $error = "Введіть текст статті";

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

   $sql = 'INSERT INTO article(title, anons, full_text, date, avtor) VALUES (?, ?, ?, ?, ?)';
   $query = $pdo->prepare($sql);
   $query->execute ([$title, $anons, $full_text, time(), $_COOKIE['login']]);

   echo "Done";


 ?>
