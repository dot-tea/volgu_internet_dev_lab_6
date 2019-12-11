<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Ошибка авторизации</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="/carousel.css">
	<link rel="stylesheet" href="/cabinet/login.css">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
  <body>
    <header>
  <nav class="navbar navbar-expand-md fixed-top">
    <a class="navbar-brand" href="/main.html">"Неугомонные ребята"</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="/main.html">Главная</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Кружки</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="">Запись</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="">Расписание</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="">Новости</a>
        </li>
		<li class="nav-item">
          <a class="nav-link" href="contacts.html">Контакты</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="check_session.php"><span class="navlink"></span>Личный кабинет (для преподавателей)</a></li>
	  </ul>
    </div>
  </nav>
</header>
<main>
<div class="container marketing">
	<div class="card">
		<h2 style="padding-top: 10px; padding-left: 5px;">Ошибка</h2>
		<p style="padding-left: 5px">
		<?php
			$errors = array(
				0 => "Неизвестная ошибка<br>",
				1 => "Такого логина в системе нет.<br>",
        2 => "Неверный пароль.<br>",
        3 => "Произошла ошибка на сервере; попробуйте позднее.<br>"
			);
			$error_id = isset($_GET['err']) ? (int)$_GET['err'] : 0;
			echo $errors[$error_id];
		?>
		<a href="/cabinet/login.html">Вернуться к форме</a></p> 
	</div>
</div>
  <footer class="container">
    <p>Все права защищены. <a href=" ">Обратная связь</a> · <a href=" ">Дополнительная информация</a></p>
  </footer>
</main>
<script src="./Carousel Template · Bootstrap_files/jquery-3.3.1.slim.min.js.Без названия" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="./Carousel Template · Bootstrap_files/bootstrap.bundle.min.js.Без названия" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>

</body></html>