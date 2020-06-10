<?php
  include 'user.php';
  session_start();
  $user = User::create_empty();
  $warning = '';

  if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = $user;
    $_SESSION['warning'] = $warning;
  } else {
    $user = $_SESSION['user'];
    $warning = $_SESSION['warning'];
  }

  include 'page.php';

?>
