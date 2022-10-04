<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <?php
    require_once "lib/mysql.php";//Підключились до бази даних
    $sql = 'SELECT * FROM article WHERE `id` = ?';//Sql запрос
    $query = $pdo->prepare($sql);//Готуєм цей запрос
    $query->execute([$_GET['id']]);//виконали sql команду, підставили потрібну ід

    $article = $query->fetch(PDO::FETCH_OBJ);// отримали потрібну записі помістили його в змінну

    $website_title = $article->title;
    require "blocks/head.php"
     ?>
  </head>
  <body>
    <?php require "blocks/header.php"?>

    <main>
      <?php
           echo "<div class='post'>
               <h1>" . $article->title . "</h1>
               <p>" . $article->anons . "</p><br>
               <p>" . $article->full_text . "</p>
               <p class='avtor'>Автор: <span>" . $article->avtor . "</span></p><br>
               <p><b>Час публікації: </b>" . date("d:m:Y   H:i:s", $article->date) ."</p>
           </div>";
       ?>
       <h3>Коментарії</h3>
       <form>
         <label for="username">Ваше ім'я</label>
         <?php if(isset($_COOKIE['login'])): //авторизований користувач ?>
              <input type="text" name="username" id="username" value="<?=$_COOKIE['login'] //Підставляєм його логін?>">
         <?php  else: //Якщо користувач не авторизований, то..?>
              <input type="text" name="username" id="username">
         <?php endif;//То не підставляєм в цей інпут ?>

         <label for="mess">Повідомлення</label>
         <textarea name="mess" id="mess"></textarea>

         <div class="error_mess" id="error_mess"></div>

         <button type="button" id="mess_send">Добавити коментар</button>
       </form>

       <?php //Вивести коменти
       $sql = 'SELECT * FROM comments WHERE `article_id` = ? ORDER BY id DESC' ;//Команда вибирає всі коментарі, в яких article_id буде співпадати з ід статті, на якій знаходимся
       $query = $pdo->prepare($sql);//Готуєм цей запрос
       $query->execute([$_GET['id']]);//виконали sql команду, підставили потрібну ід

       $comments = $query->fetchAll(PDO::FETCH_OBJ);//Тут отримали всі коменти
       foreach($comments as $el){ //І перебираєм їх в циклі
            echo "<div class='comment'>
                     <h2>" . $el->name . "</h2>
                     <p>". $el->mess ."</p>
                  </div>";
       }
        ?>
    </main>

    <?php require "blocks/aside.php"?>
    <?php require "blocks/footer.php"?>

    <script>
      $('#mess_send').click(function(){  //При нажатті на кнопку
        let name = $('#username').val();
        let mess = $('#mess').val();

        $.ajax({
            url: 'ajax/comment_add.php',
            type: 'POST',
            cache: false,
            data: {
              'username': name, //Передаєм імя
              'mess': mess,     //Передаєм повідомлення
              'id': '<?=$_GET['id']?>'  //Передаєм ід даної статті
            },
            dataType: 'html',
            success: function(data){
              if (data === "Done") {
                $("#mess_send").text("Все готово");
                $("#error_mess").hide();
                $('#mess').val("");
                }
              else {
                $("#error_mess").show();
                $("#error_mess").text(data);
              }
            }
        });
      });
    </script>

  </body>
</html>
