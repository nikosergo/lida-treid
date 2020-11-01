<?php
require "include/header.php" ?>
<div class="slider-area">
  <div class="slider-active owl-carousel nav-style-1">
    <div class="single-slider slider-height-1">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
            <div class="slider-content slider-1">
              <h3>Байки</h3>
              <h1>Новая<br />коллекция!</h1>
              <div class="slider-btn btn-hover">
                <a href="shop.php">КУПИТЬ!</a>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
            <div class="slider-single-img slider-1">
              <img src="assets/img/slider/single-slidee-1.png" alt="PIC">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="single-slider slider-height-1">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
            <div class="slider-content slider-1">
              <h3>Майки</h3>
              <h1>Скидки<br />До 30%</h1>
              <div class="slider-btn btn-hover">
                <a href="shop.php">КУПИТЬ!</a>
              </div>
            </div>
          </div>
          <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
            <div class="slider-single-img slider-1">
              <img src="assets/img/slider/single-slidee-2.png" alt="PIC">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="suppoer-area pt-100 pb-60">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="support-wrap mb-30 support-1">
          <div class="support-icon">
            <img class="animated" src="assets/img/icon-img/support-1.png" alt="">
          </div>
          <div class="support-content">
            <h5>Бесплатная доставка от 100кг </h5>
            <p>По всей территории Беларуси</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="support-wrap mb-30 support-2">
          <div class="support-icon">
            <img class="animated" src="assets/img/icon-img/support-2.png" alt="">
          </div>
          <div class="support-content">
            <h5>Поддержка 24/7</h5>
            <p>Звоните в любое время!</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="support-wrap mb-30 support-3">
          <div class="support-icon">
            <img class="animated" src="assets/img/icon-img/support-3.png" alt="">
          </div>
          <div class="support-content">
            <h5>Лучшие цены</h5>
            <p>Самые выгодные покупки</p>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="support-wrap mb-30 support-4">
          <div class="support-icon">
            <img class="animated" src="assets/img/icon-img/support-4.png" alt="">
          </div>
          <div class="support-content">
            <h5>Частые акции</h5>
            <p>Каждый месяц</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<div class="team-area pt-95 pb-70">
  <div class="container">
    <div class="section-title-2 text-center mb-60">
      <h1>Популярные бренды:</h1>
<div class="brand-logo-area pt-100 pb-100 about-brand-logo">
  <div class="container">
    <div class="brand-logo-active owl-carousel">
      <div class="single-brand-logo">
        <img src="assets/img/brand-logo/brand-logo-1.png" alt="">
      </div>
      <div class="single-brand-logo">
        <img src="assets/img/brand-logo/brand-logo-2.png" alt="">
      </div>
      <div class="single-brand-logo">
        <img src="assets/img/brand-logo/brand-logo-3.png" alt="">
      </div>
      <div class="single-brand-logo">
        <img src="assets/img/brand-logo/brand-logo-4.png" alt="">
      </div>
      <div class="single-brand-logo">
        <img src="assets/img/brand-logo/brand-logo-5.png" alt="">
      </div>
      <div class="single-brand-logo">
        <img src="assets/img/brand-logo/brand-logo-6.png" alt="">
        </div>
      <div class="single-brand-logo">
        <img src="assets/img/brand-logo/brand-logo-7.png" alt="">
        </div>
      <div class="single-brand-logo">
        <img src="assets/img/brand-logo/brand-logo-8.png" alt="">
        </div>
      <div class="single-brand-logo">
        <img src="assets/img/brand-logo/brand-logo-9.png" alt="">
        </div>
      <div class="single-brand-logo">
        <img src="assets/img/brand-logo/brand-logo-10.png" alt="">
        </div>
      <div class="single-brand-logo">
        <img src="assets/img/brand-logo/brand-logo-11.png" alt="">
        </div>
      <div class="single-brand-logo">
        <img src="assets/img/brand-logo/brand-logo-12.png" alt="">
        </div>
      <div class="single-brand-logo">
        <img src="assets/img/brand-logo/brand-logo-13.png" alt="">
    </div>
</div>
</div>
    </div>
    </div>
  </div>
</div>

<?php

$data = $_POST;

if (isset($data['subscribe'])) {
if ( R::getRow( 'SELECT * FROM subscribers WHERE email LIKE ? LIMIT 1',[$_POST['email']])) {
    echo '<div class="error">Вы уже подписаны</div>';
    
    } else {
    $sub = R::loadForUpdate('subscribers', $_POST['email']);
    $sub->email = $data['email'];
    R::store($sub);
    echo '<div class="success">Вы успешно подписаны на новости нашего магазина. Приятных покупок!</div>';
    }
}


require "include/footer.php" ?>