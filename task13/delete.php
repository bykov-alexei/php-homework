<?php
  include 'user.php';
  include 'db.php';
  
  $delete = $_POST['for_delete'];
  $users = User::load_users();
  foreach ($delete as $id) {
    User::delete_user($id);
  }
  echo "Данные удалены";
?>