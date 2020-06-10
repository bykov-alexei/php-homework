<?php
  include 'db.php';
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

  $subjects = Array();
  $payments = Array();

  $db = connect();
  $q = $db->query("SELECT id, name FROM subjects");
  while ($row = $q->fetch()) {
    $subjects[$row['id']] = $row['name'];
  }
  $q = $db->query('SELECT id, name FROM payments');
  while ($row = $q->fetch()) {
    $payments[$row['id']] = $row['name'];
  }

  include 'page.php';

?>
