<?php
  include 'user.php';

  session_start();

  $user = User::from_query($_POST);
  $warning = '';
  $_SESSION['user'] = $user;
  try {
    $user->assert_user();
  } catch (Exception $e) {

    $warning = $e->getMessage();
  }
  if ($warning) {
    $_SESSION['warning'] = $warning;
    header("Location: index.php");
  } else {
    $_SESSION['warning'] = '';
    $user->put();
    include 'success.html';
  }

?>