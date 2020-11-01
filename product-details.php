<?php 
if (isset($_GET["id"])) {
require "include/header.php";
  $element = R::getRow( 'SELECT * FROM products WHERE id = ? LIMIT 1', [$_GET["id"]] );
  $category = R::getRow( 'SELECT * FROM categories WHERE id = ? LIMIT 1', [$element["cat"]] );
} else if (isset($_POST['id'])) {
require "include/connect.php";

  $prod = array(
    "id" => $_POST['id'],
    "color" => $_POST['color'],
    "size" => $_POST['size'],
    "quantity" => $_POST['quantity']
  );
  if (isset($_SESSION['cart'])) {
    $id = count($_SESSION['cart']);
    $productsInCart = array();
    $productsInCart = $_SESSION['cart'];
  } else {
    $id = 0;

  }
    $productsInCart[$id] = $prod;
    $_SESSION['cart'] = $productsInCart;
    header('Location: /cart-page.php'); exit;
} else {
    echo 'Вы что-то перепутали!'; exit;
}
?>
<div class="breadcrumb-area pt-35 pb-35 bg-gray-3">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="index.php">Главная</a>
                </li>
                <li>
                    <a href="shop.php">Каталог </a>
                </li>
                <li class="active">Товар</li>
            </ul>
        </div>
    </div>
</div>
<div class="shop-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details">
                    <div class="product-details-img">
                        <div class="tab-content jump">
                            <div id="shop-details-1" class="tab-pane large-img-style">
                                <img src="assets/img/product-details<?php echo $_GET['id'];?>/large-1.jpg" alt="">
                                <span class="red">-10%</span>
                                <div class="img-popup-wrap">
                                    <a class="img-popup"
                                        href="assets/img/product-details<?php echo $_GET['id'];?>/b-large-1.jpg"><i
                                            class="pe-7s-expand1"></i></a>
                                </div>
                            </div>
                            <div id="shop-details-2" class="tab-pane active large-img-style">
                                <img src="assets/img/product-details<?php echo $_GET['id'];?>/large-2.jpg" alt="">
                                <?php if ($element['discount'] != '')  {
                        echo '<span class="red">-'.$element['discount'].'%</span>';
                      } else if (($element['new']) != "0")  {
                        echo '<span class="new">Новинка</span>';
                      }; ?>
                                <div class="img-popup-wrap">
                                    <a class="img-popup"
                                        href="assets/img/product-details<?php echo $_GET['id'];?>/b-large-2.jpg"><i
                                            class="pe-7s-expand1"></i></a>
                                </div>
                            </div>
                            <div id="shop-details-3" class="tab-pane large-img-style">
                                <img src="assets/img/product-details<?php echo $_GET['id'];?>/large-3.jpg" alt="">
                                <span class="red">-10%</span>
                                <div class="img-popup-wrap">
                                    <a class="img-popup"
                                        href="assets/img/product-details<?php echo $_GET['id'];?>/b-large-3.jpg"><i
                                            class="pe-7s-expand1"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="shop-details-tab nav">
                            <a class="shop-details-overly" href="#shop-details-1" data-toggle="tab">
                                <img src="assets/img/product-details<?php echo $_GET['id'];?>/small-1.jpg" alt="">
                            </a>
                            <a class="shop-details-overly active" href="#shop-details-2" data-toggle="tab">
                                <img src="assets/img/product-details<?php echo $_GET['id'];?>/small-2.jpg" alt="">
                            </a>
                            <a class="shop-details-overly" href="#shop-details-3" data-toggle="tab">
                                <img src="assets/img/product-details<?php echo $_GET['id'];?>/small-3.jpg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product-details-content ml-70">
                    <h2><?php echo $element['title'] ?></h2>
                    <div class="product-details-price">
                        <span><?php echo $element['price'] ?> BYN</span>
                        <?php 
                        if ($element['price_old'] != $element['price']) {
                        echo '<span class="old">'.$element['price_old'].'  BYN </span>'; };?> 
                    </div>
                    <p><?php echo $element['description'] ?></p>
                    <div class="pro-details-list">
                        <ul>
                            <li>Бренд: <?php echo $element['brand'] ?></li>
                            <li>Страна: <?php echo $element['country'] ?></li>
                            <li>Материалы: <?php echo $element['materials'] ?></li>
                        </ul>
                    </div>
                    <form action="product-details.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"></input>
                        <div class="pro-details-size-color">
                            <div class="pro-details-color-wrap">
                                <span>Цвет</span>
                                <div class="pro-details-color-content">
                                    <input type="radio" name="color" class="white" value="Белый" checked></input>
                                    <input type="radio" name="color" class="black" value="Черный"></input>
                                    <input type="radio" name="color" class="gray" value="Серый"></input>
                                    <input type="radio" name="color" class="green" value="Зеленый"></input>
                                    <input type="radio" name="color" class="red" value="Красный"></input>
                                </div>
                            </div>
                            <div class="pro-details-size">
                                <span>Размер</span>
                                <div class="pro-details-size-content">
                                    <select name="size">
                                        <option>s</option>
                                        <option>m</option>
                                        <option>l</option>
                                        <option>xl</option>
                                        <option>xxl</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="quantity" value="1">
                            </div>
                            <div class="pro-details-cart btn-hover">
                                <button>В корзину</button>
                            </div>
                        </div>
                    </form>
                    <div class="pro-details-meta">
                        <span>Категория :</span>
                        <ul>
                            <li><a href="shop.php?cat=<?php echo $category['id']?>"><?php echo $category['name']?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require "include/footer.php";
?>