<?php
  $n_args = count($_GET);
  $name = "";
  $surname = "";
  $email = "";
  $phone = "";
  $topic = "";
  $payment = "";
  $mailing = "";
  $warning = "";
  $ok = "";
  if ($n_args > 1) {
    $name = trim($_GET['name']);
    $surname = trim($_GET['surname']);
    $email = trim($_GET['email']);
    $phone = trim($_GET['phone']);
    $topic = trim($_GET['topic']);
    $payment = trim($_GET['payment']);
    $mailing = (int)(trim($_GET['mailing']) == "on");
    $warning = "";
    $ok = True;
    if ($name == "" and $ok) {
      $ok = False;
      $warning = "Не указано имя";
    }
    if (strpos($name, "|") !== False) {
      $ok = False;
      $warning = "Имя содержит недопустимый символ";
    }
    if ($surname == "" and $ok) {
      $ok = False;
      $warning = "Не указана фамилия";
    }
    if (strpos($surname, "|") !== False) {
      $ok = False;
      $warning = "Фамилия содержит недопустимый символ";
    }
    if ($email == "" and $ok) {
      $ok = False;
      $warning = "Не указана почта";
    }
    if (strpos($email, "|") !== False) {
      $ok = False;
      $warning = "Почта содержит недопустимый символ";
    }
    if ($phone == "" and $ok) {
      $ok = False;
      $warning = "Не указан номер телефона";
    }
    if (strpos($phone, "|") !== False) {
      $ok = False;
      $warning = "Номер телефона содержит недопустимый символ";
    }
    if ($topic == "" and $ok) {
      $ok = False;
      $warning = "Не указана тематика";
    }
    if ($payment == "" and $ok) {
      $ok = False;
      $warning = "Не указан способ оплаты";
    }
  }

if (!$ok) {
  include 'page.html';
} else {
  $time = date('d/m/Y h:i:s');
  $data = $name.'||'.$surname.'||'.$time.'||'.$email.'||'.$phone.'||'.$topic.'||'.$payment.'||'.$mailing."||1\n";
  file_put_contents('applications.txt', $data, FILE_APPEND);
  include 'success.html';
}