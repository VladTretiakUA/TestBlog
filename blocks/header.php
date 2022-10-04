<header>
  <span class="logo">Блог Влада</span>
  <nav>
    <a href="/">Головна</a>
    <?php if (isset($_COOKIE['login'])) : //коли авторизований то показує ці функції?>
      <a href="/add-article.php">Добавити статтю</a>
      <a href="/login.php" class="btn">Кабінет користувача</a>
    <?php else : ?>
      <a href="/login.php" class="btn">Увійти</a>
      <a href="/register.php" class="btn">Реєстрація</a>
    <?php endif; ?>
  </nav>
</header>
