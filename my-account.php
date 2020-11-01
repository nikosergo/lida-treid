<?php
require "include/header.php";

$data = $_POST;
$errors = array();
$success = array();
$pro = R::find('products');


if (isset($data['do_edit'])) {

  // Обновление

  if (trim($data['user-name']) == '') {
    $errors[] = 'Введите имя пользователя';
  }

  if (trim($data['user-surname']) == '') {
    $errors[] = 'Введите Фамилию пользователя';
  }

  if (trim($data['user-email']) == '') {
    $errors[] = 'Введите Email';
  }

  if (empty($errors)) {
    // Обновить
    $user = R::load('users', $_SESSION['logged_user']->id);
    $user->name = $data['user-name'];
    $user->surname = $data['user-surname'];
    $user->email = $data['user-email'];
    $user->tel = $data['user-tel'];
    $user->index = $data['user-index'];
    $user->country = $data['user-country'];
    $user->city = $data['user-city'];
    $user->home = $data['user-home'];
    $user->flat = $data['user-flat'];
    R::store($user);
    unset($_SESSION['logged_user']);
    $_SESSION['logged_user'] = $user;
    $success[] = 'Информация изменена';
  }
}

if (isset($data['do_change'])) {

  // Регистрация
  if (trim($data['user-old-password']) != ($_SESSION['logged_user']->password)) {
    $errors[] = 'Неверный старый пароль';
  }

  if (trim($data['user-old-password']) == '') {
    $errors[] = 'Введите старый пароль';
  }

  if (trim($data['user-new-password']) == '') {
    $errors[] = 'Введите Новый пароль';
  }

  if ($data['user-new-password-repit'] != $data['user-new-password']) {
    $errors[] = 'Новые пароли не совпадают';
  }

    if (empty($errors)) {
      // Сменить пароль
      $user = R::load('users', $_SESSION['logged_user']->id);
      $user->password = $data['user-new-password'];
      R::store($user);
      unset($_SESSION['logged_user']);
      $_SESSION['logged_user'] = $user;
      $success[] = 'Пароль успешно изменен!';
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
        <li class="active">Мой аккаунт</li>
      </ul>
    </div>
  </div>
</div>
<div class="checkout-area pb-80 pt-100">
  <div class="container">
    <div class="row">
      <div class="ml-auto mr-auto col-lg-9">
        <div class="checkout-wrapper">
          <div id="faq" class="panel-group">
            <?php
if (isset($data['do_edit']) || isset($data['do_change'])) {
  if (empty($errors) || isset($success)) {
    echo '<div class="success">' . array_shift($success) . '</div>';
  }
  if (isset($errors))  {
    echo '<div class="error">' . array_shift($errors) . '</div>';
  }
}
?>

            <div class="panel panel-default single-my-account">
              <div class="panel-heading my-account-title">
                <h3 class="panel-title"><span>1 .</span> <a data-toggle="collapse" data-parent="#faq"
                    href="#my-account-1">
                    Изменить информацию аккаунта </a></h3>
              </div>
              <div id="my-account-1" class="panel-collapse collapse show">
                <div class="panel-body">
                  <div class="myaccount-info-wrapper">
                    <div class="account-info-wrapper">
                      <h4>Информация аккаунта</h4>
                    </div>
                    <form action="/my-account.php" method="post">
                      <div class="row">
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info">
                            <label>Имя</label>
                            <input type="text" name="user-name" value="<?php
echo $_SESSION['logged_user']->name ?>">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info">
                            <label>Фамилия</label>
                            <input type="text" name="user-surname" value="<?php
echo $_SESSION['logged_user']->surname ?>">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info">
                            <label>Email</label>
                            <input type="email" name="user-email" value="<?php
echo $_SESSION['logged_user']->email ?>">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info">
                            <label>Телефон</label>
                            <input type="text" name="user-tel" value="<?php
echo $_SESSION['logged_user']->tel ?>">
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="billing-select mb-20">
                            <label>Страна</label>
                            <select name="user-country">
                              <option selected>Беларусь</option>
                              <option>Россия</option>
                              <option>Украина</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info mb-20">
                            <label>Город/населенный пункт</label>
                            <input type="text" name="user-city" placeholder="Город/населенный пункт" value="<?php
echo $_SESSION['logged_user']->city ?>">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info mb-20">
                            <label>Почтовый индекс</label>
                            <input type="number" name="user-index" placeholder="Почтовый индекс" value="<?php
echo $_SESSION['logged_user']->index ?>">
                          </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info mb-20">
                            <label>Название улицы и номер дома</label>
                            <input type="text" name="user-home" placeholder="Название улици и номер дома" value="<?php
echo $_SESSION['logged_user']->home ?>">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info mb-20">
                            <label>Номер квартиры</label>
                            <input type="number" name="user-flat" placeholder="Номер квартиры" value="<?php
echo $_SESSION['logged_user']->flat ?>">
                          </div>
                        </div>
                      </div>
                      <div class="billing-back-btn">
                        <div class="billing-back">
                          <a href="#"><i class="fa fa-arrow-up"></i> Вверх</a>
                        </div>
                        <div class="billing-btn">
                          <button type="submit" name="do_edit">Применить</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-default single-my-account">
            <div class="panel-heading my-account-title">
              <h3 class="panel-title"><span>2 .</span> <a data-toggle="collapse" data-parent="#faq"
                  href="#my-account-2">Сменить
                  пароль</a></h3>
            </div>
            <div id="my-account-2" class="panel-collapse collapse">
              <div class="panel-body">
                <div class="myaccount-info-wrapper">
                  <div class="account-info-wrapper">
                    <h4>Смена пароля</h4>
                  </div>
                  <div class="row">
                    <form action="/my-account.php" method="post">
                      <div class="col-lg-12 col-md-12">
                        <div class="billing-info">
                          <label>Старый пароль</label>
                          <input type="password" name="user-old-password">
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-12">
                        <div class="billing-info">
                          <label>Новый пароль</label>
                          <input type="password" name="user-new-password">
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-12">
                        <div class="billing-info">
                          <label>Подтверждение нового пароля</label>
                          <input type="password" name="user-new-password-repit">
                        </div>
                      </div>
                  </div>
                  <div class="billing-back-btn">
                    <div class="billing-back">
                      <a href="#"><i class="fa fa-arrow-up"></i> Вверх</a>
                    </div>
                    <div class="billing-btn">
                      <button type="submit" name="do_change">Применить</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="panel panel-default single-my-account <?php if(!$_SESSION['logged_user']->admin) echo 'hidden';?>">
            <div class="panel-heading my-account-title">
              <h3 class="panel-title"><span>3 .</span> <a data-toggle="collapse" data-parent="#faq"
                  href="#my-account-3">Добавление и редактирование товара</a></h3>
            </div>
            <div id="my-account-3" class="panel-collapse collapse">
              <div class="panel-body">
                <div class="myaccount-info-wrapper">
                  <div class="account-info-wrapper">
                    <form action="pro-add.php" method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="billing-select">
                            <label>Выберите товар для редактирования</label>
                            <select name="pro-id">
                              <?php 
                              $new = (R::getAll(('SELECT id FROM products ORDER BY id DESC LIMIT 1'))[0]['id']) + 1;
                              foreach ($pro as $products) {
                              echo '<option value="'.$products->id.'">'.$products->id.'. '.$products->title.'</option>';
                            }
                              echo '<option value="'.$new .'">'.$new.'. НОВЫЙ ТОВАР </option>';
                          
                             ?>
                            </select>
                          </div>
                        </div>
                    </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info">
                            <label>Название продукта</label>
                            <input required type="text" name="pro-title">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-select">
                            <label>Категория</label>
                            <select name="pro-cat">
                              <?php
                              foreach ($cat as $categ) {echo '<option value="'.$categ->id.'">'.$categ->name.'</option>';}?>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-select">
                            <label>Пол</label>
                            <select name="pro-gender">
                              <option value="1" selected>Мужской</option>
                              <option value="0">Женский</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-select">
                            <label>Новинка?</label>
                            <select name="pro-new">
                              <option value="1">Да</option>
                              <option value="0" selected>Нет</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                          <div class="billing-info">
                            <label>Описание</label>
                            <input required type="text" name="pro-description">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info">
                            <label>Материалы</label>
                            <input required type="text" name="pro-materials">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info">
                            <label>Страна</label>
                            <input required type="text" name="pro-country">
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info">
                            <label>Бренд</label>
                            <input required type="text" name="pro-brand">
                          </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info">
                            <label>Цена</label>
                            <input required type="text" name="pro-price">
                          </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info">
                            <label>Скидка</label>
                            <input type="text" name="pro-discount">
                          </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info">
                            <label>Фото 1</label>
                            <input name="img[]" type="file" style="border:0" required>
                          </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info">
                            <label>Фото 2</label>
                            <input name="img[]" type="file" style="border:0" required>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                          <div class="billing-info">
                            <label>Фото 3</label>
                            <input name="img[]" type="file" style="border:0" required>
                          </div>
                          </div>
                      </div>
                      <div class="billing-back-btn">
                        <div class="billing-back">
                          <a href="#"><i class="fa fa-arrow-up"></i> Вверх</a>
                        </div>
                        <div class="billing-btn">
                          <button type="submit">Обновить информацию</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="panel panel-default single-my-account <?php if(!$_SESSION['logged_user']->admin) echo 'hidden';?>">
          <div class="panel-heading my-account-title">
            <h3 class="panel-title"><span>4 .</span> <a data-toggle="collapse" data-parent="#faq"
                href="#my-account-4">Удаление товара</a></h3>
          </div>
          <div id="my-account-4" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="myaccount-info-wrapper">
                <div class="account-info-wrapper">
                  <form action="pro-add.php" method="post">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="billing-select">
                          <label>Выберите товар для удаления</label>
                          <select name="pro-id">
                            <?php 
                              $new = (R::getAll(('SELECT id FROM products ORDER BY id DESC LIMIT 1'))[0]['id']) + 1;
                              foreach ($pro as $products) {
                              echo '<option value="'.$products->id.'">'.$products->id.'. '.$products->title.'</option>';
                            }
                             ?>
                          </select>
                        </div>
                      </div>
                      
                    </div>
                    <div class="billing-back-btn">
                      <div class="billing-back">
                        <a href="#"><i class="fa fa-arrow-up"></i> Вверх</a>
                      </div>
                      <div class="billing-btn">
                        <button type="submit" name="DELL">Удалить товар</button>
                      </div>
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
</div>


<?php
require "include/footer.php";


?>