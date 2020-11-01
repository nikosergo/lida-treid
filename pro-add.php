<?php 
  require 'include/connect.php';
?>
<a href="my-account.php">Вернуться</a>
<br>
<a href="index.php">На главную</a>
<br>
<br>
<a href="shop.php">В Каталог</a>
<br>

<pre>
  <?php
  $pro = R::find('products');
  $pro = R::loadForUpdate('products', $_POST['pro-id']);

  print_r($_POST);

  if (isset($_POST['DELL'])) {
    R::getAll( 'DELETE FROM `products` WHERE `products`.`id` = ?', [$_POST["pro-id"]]);
    exit;
  }

  if ($_POST['pro-title'] != '') {
  $pro->title = $_POST['pro-title'];
  }

  if ($_POST['pro-price'] != '') {
  $pro->price_old = $_POST['pro-price'];
  }
  if ($_POST['pro-discount'] != '') {
  $pro->discount = $_POST['pro-discount'];
  } 
  if ($_POST['pro-discount'] != '') {
$pro->price = round($_POST['pro-price'] * (100-$_POST['pro-discount']) /100);
  } else {
    $pro->price = $_POST['pro-price'];
  }

$pro->cat = $_POST['pro-cat'];
$pro->gender = $_POST['pro-gender'];
$pro->new = $_POST['pro-new'];

if ($_POST['pro-description'] != '') {
  $pro->description = $_POST['pro-description'];
  }
  if ($_POST['pro-brand'] != '') {
  $pro->brand = $_POST['pro-brand'];
  }
  if ($_POST['pro-materials'] != '') {
  $pro->materials = $_POST['pro-materials'];
  }
  if ($_POST['pro-country'] != '') {
  $pro->country = $_POST['pro-country'];
  }

R::store($pro);

$uploaddir = 'assets/img/product-details'.$_POST['pro-id'].'/';
@mkdir($uploaddir, 0777, true);

$img1 = $uploaddir.'b-large-1.jpg';
if (copy($_FILES['img']['tmp_name'][0], $img1))
{
echo "<h3>Файл 1 успешно загружен на сервер</h3>";
}
else { echo "<h3>Ошибка! Не удалось загрузить файл 1 на сервер!</h3>";exit;} ;

$img2 = $uploaddir.'b-large-2.jpg';
if (copy($_FILES['img']['tmp_name'][1], $img2))
{
echo "<h3>Файл 2 успешно загружен на сервер</h3>";
}
else { echo "<h3>Ошибка! Не удалось загрузить файл 2 на сервер!</h3>";exit;} ;

$img3 = $uploaddir.'b-large-3.jpg';
if (copy($_FILES['img']['tmp_name'][2], $img3))
{
echo "<h3>Файл 3 успешно загружен на сервер</h3>";
}
else { echo "<h3>Ошибка! Не удалось загрузить файл 3 на сервер!</h3>";exit;} ;


list($width1, $height1) = getimagesize($img1);
list($width2, $height2) = getimagesize($img2);
list($width3, $height3) = getimagesize($img3);

$source1 = imagecreatefromjpeg($img1);
$source2 = imagecreatefromjpeg($img2);
$source3 = imagecreatefromjpeg($img3);

$width = 270;
$height = 345;
$out1 = imagecreatetruecolor($width, $height);
$out2 = imagecreatetruecolor($width, $height);
imagecopyresized($out1, $source1, 0, 0, 0, 0, $width, $height, $width1, $height1);
imagecopyresized($out2, $source2, 0, 0, 0, 0, $width, $height, $width2, $height2);
imagejpeg($out1, 'assets\img\product\pro-'.$_POST['pro-id'].'.jpg');
imagejpeg($out2, 'assets\img\product\pro-'.$_POST['pro-id'].'-1.jpg');

$width = 570;
$height = 680;
$out1 = imagecreatetruecolor($width, $height);
$out2 = imagecreatetruecolor($width, $height);
$out3 = imagecreatetruecolor($width, $height);
imagecopyresized($out1, $source1, 0, 0, 0, 0, $width, $height, $width1, $height1);
imagecopyresized($out2, $source2, 0, 0, 0, 0, $width, $height, $width2, $height2);
imagecopyresized($out3, $source3, 0, 0, 0, 0, $width, $height, $width3, $height3);
imagejpeg($out1, $uploaddir.'large-1.jpg');
imagejpeg($out2, $uploaddir.'large-2.jpg');
imagejpeg($out3, $uploaddir.'large-3.jpg');

$width = 144;
$height = 144;
$out1 = imagecreatetruecolor($width, $height);
$out2 = imagecreatetruecolor($width, $height);
$out3 = imagecreatetruecolor($width, $height);
imagecopyresized($out1, $source1, 0, 0, 0, 0, $width, $height, $width1, $height1);
imagecopyresized($out2, $source2, 0, 0, 0, 0, $width, $height, $width2, $height2);
imagecopyresized($out3, $source3, 0, 0, 0, 0, $width, $height, $width3, $height3);
imagejpeg($out1, $uploaddir.'small-1.jpg');
imagejpeg($out2, $uploaddir.'small-2.jpg');
imagejpeg($out3, $uploaddir.'small-3.jpg');

$width = 82;
$height = 82;
$out1 = imagecreatetruecolor($width, $height);
imagecopyresized($out1, $source1, 0, 0, 0, 0, $width, $height, $width1, $height1);
imagejpeg($out1, 'assets\img\cart\cart-'.$_POST['pro-id'].'.jpg');