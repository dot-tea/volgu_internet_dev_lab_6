<!DOCTYPE html>
<!-- saved from url=(0014)about:internet -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Вход</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="/carousel.css">

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
    <?php
        session_start();
        if (isset($_SESSION['login'])) {
          header("Location: /cabinet/my_cabinet.php");
          exit;
        }
        include_once($_SERVER['DOCUMENT_ROOT'].'/include/templates/header_main.html');
        include_once($_SERVER['DOCUMENT_ROOT'].'/include/templates/header_unlogged_in.html');
    ?>
  <div class="card">
		<div class="card-header">
			<h2>Регистрация</h2>
		</div>
		<div class="card-body">
      <form method="post" action="/cabinet/register_new_parent.php" id="registration_form" onsubmit="return validateRegistration();">
        <small class="form-text text-muted">
          <?php
            $errors = array(
              1 => 'Недопустимое имя (может содержать только кириллицу)',
              2 => 'Недопустимое отчество (может содержать только кириллицу)',
              3 => 'Недопустимая фамилия (может содержать только кириллицу)',
              4 => 'Недопустимое место работы (может содержать только буквы и цифры)',
              5 => 'Недопустимая должность (может содержать только буквы и цифры)',
              6 => 'Недопустимая электронная почта',
              7 => 'Недопустимый номер телефона',
              8 => 'Недопустимый логин (логин может содержать только латинские буквы, цифры и _)',
              9 => 'Недопустимый пароль (логин может содержать только латинские буквы, цифры и _)',
              10 => 'Пароли не совпадают',
              11 => 'Логин уже занят',
              12 => 'Произошла ошибка на стороне сервера: не удалось добавить пользователя',
              13 => 'Произошла ошибка на стороне сервера: не удалось получить ID пользователя',
              14 => 'Произошла ошибка на стороне сервера: по ошибке отправилось несущ. ID кружка',
              15 => 'Произошла ошибка на стороне сервера: не удалось добавить родителя (прервано успешно)',
              16 => 'Произошла ошибка на стороне сервера: не удалось найти ID пользователя',
              17 => 'Произошла ошибка на стороне сервера: не удалось добавить родителя (прервано не полностью)'
            );
            $error_code = (isset($_GET['err_code'])) ? (int)$_GET['err_code'] : 0;
            if (0 === $error_code)
              echo "Сначала вам нужно завести учётную запись опекуна.";
            else
              echo '<div style="color: red;">'.$errors[$error_code].'</div>';
          ?>
        </small>
        <div class="row">
          <div class="col">
            <label for="last_name">Фамилия*</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
          </div>
          <div class="col">
            <label for="first_name">Имя*</label>
            <input type="text" name="first_name" class="form-control" id="first_name" required>
          </div>
          <div class="col">
            <label for="last_name">Отчество</label>
            <input type="text" name="middle_name" class="form-control" id="middle_name">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="workplace">Место работы</label>
            <input type="text" class="form-control" name="workplace" id="workplace" class="form-control">
          </div>
          <div class="col">
            <label for="position">Должность</label>
            <input type="text" name="position" id="position" class="form-control" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="email">Электронная почта*</label>
            <input type="text" name="email" id="email" placeholder="example@domain.com" required class="form-control">
          </div>
          <div class="col">
            <label for="phone_number">Номер телефона (мобильный)*</label>
            <input type="text" name="phone_number" id="phone_number" placeholder="+7XXXXXXXXXX (10 цифр после семёрки)" required class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="login">Логин* (именно он используется при входе)</label>
            <input type="text" name="login" id="login" required class="form-control">
          </div>
          <div class="col">
            <label for="password">Пароль*</label>
            <input type="password" name="password" id="password" required class="form-control">
          </div>
          <div class="col">
            <label for="confirm_password">Подтвердите пароль*</label>
            <input type="password" name="confirm_password" id="confirm_password" required class="form-control">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col">
            <button class="btn btn-primary" type="submit" value="submit" name="submit_form" id="submit_form">Отправить</button>
          </div>
        </div>
      </form>
		</div>
	</div>
  <?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/include/templates/footer.html')
  ?>
<script src="/cabinet/validate_registration.js"></script>
<script src="./Carousel Template · Bootstrap_files/jquery-3.3.1.slim.min.js.Без названия" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="./Carousel Template · Bootstrap_files/bootstrap.bundle.min.js.Без названия" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>

</body></html>