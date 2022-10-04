<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <?php
     $website_title = 'Реєстрація';
     require "blocks/head.php"
     ?>
  </head>
  <body>
    <?php require "blocks/header.php"?>

    <main>
      <h1>Реєстрація</h1>
      <form>
        <label for="username">Ваше ім'я</label>
        <input type="text" name="username" id="username">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <label for="login">Логин</label>
        <input type="text" name="login" id="login">

        <label for="password">Пароль</label>
        <input type="password" name="password" id="password">

        <div class="error_block" id="error_block"></div>

        <button type="button" id="reg_user">Зареєструватись</button>
      </form>
    </main>

    <?php require "blocks/aside.php"?>
    <?php require "blocks/footer.php"?>

   <script>
     $('#reg_user').click(function(){
       let name = $('#username').val();
       let email = $('#email').val();
       let login = $('#login').val();
       let pass = $('#password').val();

       $.ajax({
           url: 'ajax/reg.php',
           type: 'POST',
           cache: false,
           data: {
             'username': name,
             'email': email,
             'login': login,
             'password': pass
           },
           dataType: 'html',
           success: function(data){
             if (data === "Done") {
               $("#reg_user").text("Все готово");
               $("#error_block").hide();
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
