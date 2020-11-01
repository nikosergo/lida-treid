<?php 
     require 'include/connect.php';
     unset($_SESSION['logged_user']) ;
     header('Location: /');
