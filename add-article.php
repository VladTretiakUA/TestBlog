<?php
    if (!isset($_COOKIE['login'])) { //умова, при якій добавити статтю може авторизований користувач
      header ('Location: /register.php');//буде перекидати на сторінку реєстреції
      exit;
    }?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <?php
     $website_title = 'Добавити статтю';
     require "blocks/head.php"
     ?>
  </head>
  <body>
    <?php require "blocks/header.php"?>

    <main>
      <h1>Добавити статтю</h1>
      <form>
        <label for="title">Назва статті</label>
        <input type="text" name="title" id="title">

        <label for="anons">Анонс статті</label>
        <textarea name="anons" id="anons"></textarea>

        <label for="full_text">Основний текст</label>
        <textarea name="full_text" id="full_text"></textarea>

        <div class="error_block" id="error_block"></div>

        <button type="button" id="add_article">Добавити</button>
      </form>
    </main>

    <?php require "blocks/aside.php"?>
    <?php require "blocks/footer.php"?>

   <script>
     $('#add_article').click(function(){
       let title = $('#title').val();
       let anons = $('#anons').val();
       let full_text = $('#full_text').val();
       $.ajax({
           url: 'ajax/add_article.php',
           type: 'POST',
           cache: false,
           data: {
             'title': title,
             'anons': anons,
             'full_text': full_text,
           },
           dataType: 'html',
           success: function(data){
             if (data === "Done") {
               $("#add_article").text("Все готово");
               $("#error_block").hide();
               $('#title').val("");
               $('#anons').val("");
               $('#full_text').val("");
               }
             else {
               $("#error_block").show();
               $("#error_block").text(data);
             }
           }
       });
     });
   </script>
  </body>
</html>
