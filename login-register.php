<?php
session_start();
if (empty($_SESSION['logged_user'])) {
  require "include/header.php";
} else {
  require "include/connect.php";
  header('Location: /');
};
?>

<?php
$data = $_POST;
$errors = array();
$success = array();

if (isset($data['do_login'])) {
  unset($_SESSION['logged_user']);

  // Вход

  if (trim($data['user-email']) == '') {
    $errors[] = 'Введите Email';
  }

  if (trim($data['user-password']) == '') {
    $errors[] = 'Введите Пароль';
  }

  $user = R::findOne('users', 'email = ?', array(
    $data['user-email']
  ));
  if ($user) {
    if ($data['user-password'] == $user->password) {
      $_SESSION['logged_user'] = $user;
      echo '<script>window.location.reload()</script>';
    }
    else {
      $errors[] = 'Неверный пароль!';
    }
  }
  else {
    $errors[] = 'Пользователь с таким Email не найден!';
  }
}

if (isset($data['do_singup'])) {

  // Регистрация

  if (trim($data['user-name']) == '') {
    $errors[] = 'Введите имя пользователя';
  }

  if (trim($data['user-surname']) == '') {
    $errors[] = 'Введите Фамилию пользователя';
  }

  if (trim($data['user-email']) == '') {
    $errors[] = 'Введите Email';
  }

  if (trim($data['user-password']) == '') {
    $errors[] = 'Введите Пароль';
  }

  if ($data['user-password-repit'] != $data['user-password']) {
    $errors[] = 'Пароли не совпадают';
  }

  if (R::count('users', 'email = ?', array(
    $data['user-email']
  )) > 0) {
    $errors[] = 'Такой пользователь уже существует!';
  }

  if (isset($data['do_singup'])) {
    if (empty($errors)) {

      // Зарегестрировать

      $user = R::dispense('users');
      $user->name = $data['user-name'];
      $user->surname = $data['user-surname'];
      $user->email = $data['user-email'];
      $user->password = $data['user-password'];
      $user->tel = '';
      $user->index = '';
      $user->city = '';
      $user->home = '';
      $user->flat = '';
      $user->admin = 0;
      R::store($user);
      $success[] = 'Вы успешно зарагестрированы!';
    }
  }
}

?>

<div class="breadcrumb-area pt-35 pb-35 bg-gray-3">
  <div class="container">
    <div class="breadcrumb-content text-center">
      <ul>
        <li>
          <a href="index.php">Главная</a>
        </li>
        <li class="active">Войти или Зарегестрироваться</li>
      </ul>
    </div>
  </div>
</div>
<div class="login-register-area pt-100 pb-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-12 ml-auto mr-auto">
        <div class="login-register-wrapper">
          <div class="login-register-tab-list nav">
            <a class="active" data-toggle="tab" href="#lg1">
              <h4> Войти </h4>
            </a>
            <a data-toggle="tab" href="#lg2">
              <h4> Зарагестрироваться </h4>
            </a>
          </div>

          <?php

if (isset($data['do_singup']) || isset($data['do_login'])) {
  if (empty($errors) || isset($success)) {
    echo '<div class="success">' . array_shift($success) . '</div>';
  }
  else {
    echo '<div class="error">' . array_shift($errors) . '</div>';
  }
}

?>
          <div class="tab-content">
            <div id="lg1" class="tab-pane active">
              <div class="login-form-container">
                <div class="login-register-form">
                  <form action="/login-register.php" method="post">
                    <label>Email</label>
                    <input type="text" name="user-email" placeholder="Введите Email"
                      value="<?php
echo @$data['user-email'];
?>">
                    <label>Пароль</label>
                    <input type="password" name="user-password" placeholder="Введите Пароль"
                      value="<?php
echo @$data['user-password'];
?>">
                    <div class="button-box">
                      <div class="login-toggle-btn"
                         <input type="checkbox"> 
                        <label>Запомнить</label> 
                      </div> 
                      <button type="submit" name="do_login"><span>Войти</span></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div id="lg2" class="tab-pane">
              <div class="login-form-container">
                <div class="login-register-form">
                  <form action="login-register.php" method="post">
                    <label>Имя</label>
                    <input type="text" name="user-name" placeholder="Имя пользователя"
                      value="<?php
echo @$data['user-name'];
?>">
                    <label>Фамилия</label>
                    <input type="text" name="user-surname" placeholder="Фамилия пользователя"
                      value="<?php
echo @$data['user-surname'];
?>">
                    <label>Email</label>
                    <input type="email" name="user-email" placeholder="Email"
                      value="<?php
echo @$data['user-email'];
?>">
                    <label>Пароль</label>
                    <input type="password" name="user-password" placeholder="Пароль"
                      value="<?php
echo @$data['user-password'];
?>">
                    <label>Повторите пароль</label>
                    <input type="password" name="user-password-repit" placeholder="Повторите пароль"
                      value="<?php
echo @$data['user-password-repit'];
?>">
                    <div class="button-box">
                      <button type="submit" name="do_singup"><span>Зарегестрироваться</span></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require "include/footer.php";
?>