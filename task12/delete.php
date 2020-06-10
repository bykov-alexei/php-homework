<?php
  include 'user.php';

  $delete = $_POST['for_delete'];
  $users = User::load_users();
  foreach ($delete as $hash) {
    unset($users[$hash]);
  }
  User::save_users($users);
  echo "Данные удалены";
?>