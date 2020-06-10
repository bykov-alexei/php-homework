<?php
  include 'user.php';
  $user = User::create_empty();
  $warning = '';
  $display = True;
  $n_args = count($_POST);
  if ($n_args > 1) {
    $display = False;
    $user = User::from_query($_POST);
    try {
      $user->assert_user();
    } catch (Exception $e) {
      $warning = $e->getMessage();
      $display = True;
    }
  }

if ($display) {
  include 'page.php';
} else {
  $user->put();
  include 'success.html';
}
