<?php require "include/header.php";
  $pro = R::find('products');

if (isset($_GET["gender"])) {
  $pro = R::find('products', 'gender = ?', [$_GET["gender"]]);
}
if (isset($_GET['cat'])) {
  $pro = R::find('products', 'cat = ?', [$_GET["cat"]]);
}
if (isset($_GET['serch'])) {
  $pro = R::find('products', 'title LIKE ?', ['%'.$_GET["serch"].'%']);
}
if (isset($_GET["gender"]) && isset($_GET['cat'])) {
  $pro = R::find('products', 'gender = ? AND cat = ?', [$_GET["gender"],$_GET['cat']]);
}

if (isset($_GET["gender"]) && isset($_GET['serch'])) {
  $pro = R::find('products', 'gender = ? AND title LIKE ?', [$_GET["gender"],['%'.$_GET["serch"].'%']]);
}

if (isset($_GET["gender"]) && isset($_GET['cat']) && isset($_GET['serch'])) {
  $pro = R::find('products', 'gender = ? AND cat = ? AND title LIKE ?', [$_GET["gender"],$_GET['cat'],['%'.$_GET["serch"].'%']]);
}
?>

<div class="breadcrumb-area pt-35 pb-35 bg-gray-3">
  <div class="container">
    <div class="breadcrumb-content text-center">
      <ul>
        <li>
          <a href="index.php">Главная</a>
        </li>
        <li class="active">Каталог </li>
      </ul>
    </div>
  </div>
</div>
<div class="shop-area pt-95 pb-100">
  <div class="container">
    <div class="row">
      <div class="col-lg-9">
        <div class="shop-top-bar mb-25">
          <div class="select-shoing-wrap">
            <?php echo'<p>Показано '. count($pro).' из '. count($pro).' товаров</p>'?>
          </div>
        </div>
        <div class="shop-bottom-area">
          <div class="tab-content jump">
            <div id="shop-1" class="tab-pane active">
              <div class="row">
                <?php 
                foreach ($pro as $pro => $element) {
                echo '<div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">
                  <div class="product-wrap mb-25 scroll-zoom">
                    <div class="product-img">
                      <a href="product-details.php?id='.$element->id.'">
                        <img class="default-img" src="assets/img/product/pro-'. $element->id . '.jpg" alt="">
                        <img class="hover-img" src="assets/img/product/pro-'. $element->id . '-1.jpg" alt="">
                      </a>';
                      if ($element->discount != '')  {
                        echo '<span class="red">-'.$element->discount.'%</span>';
                      } else if (($element->new) != "0")  {
                        echo '<span class="new">Новинка</span>';
                      };
                      echo'<div class="product-action">
                        <div class="pro-same-action pro-cart">
                          <a title="В корзину" href="product-details.php?id='.$element->id.'"><i class="pe-7s-cart"></i> В корзину</a>
                        </div>
                      </div>
                    </div>
                    <div class="product-content text-center">
                      <h3><a href="product-details.php?id='.$element->id.'">'.$element->title.'</a></h3>
                      <div class="product-price">
                        <span>'.$element->price.' BYN</span>';
                        if ($element->price_old != $element->price) {
                        echo '<span class="old">'.$element->price_old.' BYN</span>';
                        }; 
                        echo ' 
                      </div>
                    </div>
                  </div>
                </div>';}
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="sidebar-style ml-30">
          <div class="sidebar-widget">
            <h4 class="pro-sidebar-title">Поиск</h4>
            <div class="pro-sidebar-search mb-50 mt-25">
              <form class="pro-sidebar-search-form" method="GET" action="shop.php">
                <input type="text" name="serch" placeholder="Поиск" value="<?php echo $_GET['serch'];?>">
                <button>
                  <i class="pe-7s-search"></i>
                </button>
              </form>
            </div>
          </div>
          <div class="sidebar-widget">
            <form method="GET" action="shop.php">
              <h4 class="pro-sidebar-title">Пол</h4>
              <div class="sidebar-widget-list mt-30">
                <ul>
                  <li>
                    <div class="sidebar-widget-list-left">
                      <input name="gender" type="radio" value="1" <?php if (isset($_GET['gender']) && $_GET['gender'] == 1){
                      echo 'checked';}
                     ?>> <a href="shop.php?gender=1">Мужские
                        <span>
                          <? echo R::count('products', "WHERE gender = 1").'</span>'; ?></a>
                      <span class="checkmark"></span>
                    </div>
                  </li>
                  <li>
                    <div class="sidebar-widget-list-left">
                      <input name="gender" type="radio" value="0" <?php if (isset($_GET['gender']) && $_GET['gender'] == 0){
                      echo 'checked';}
                     ?>> <a href="shop.php?gender=0">Женские
                        <span>
                          <? echo R::count('products', "WHERE gender = 0").'</span>'; ?></a>
                      <span class="checkmark"></span>
                    </div>
                  </li>
                </ul>
              </div>
              <h4 class="pro-sidebar-title mt-30">Категории</h4>
              <div class="sidebar-widget-list mt-30">
                <ul>
                  <?php 
                  foreach ($cat as $cat) {
          echo ' <li>
                  <div class="sidebar-widget-list-left">
                    <input name="cat" type="radio" value="'.$cat ->id.'"';  
                    if ($cat->id == $_GET['cat']){
                      echo 'checked';}; echo '>
                      <a href="shop.php?cat='.$cat ->id.'">'.$cat->name .'<span>';
                    echo R::count('products', "WHERE cat = ?",array($cat ->id)).'</span></a>
                    <span class="checkmark"></span>
                  </div>
                </li>';}?>
                  <div class="Place-order mt-25">
                    <button class="btn-hover" type="submit">Найти</button>
                    <a class=" mt-20" href="shop.php">Очистить фильтр</a>
                  </div>
            </form>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php require "include/footer.php" ?>