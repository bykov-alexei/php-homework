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
    $mailing = trim($_GET['mailing'] == "on");
    $warning = "";
    $ok = True;
    if ($name == "" and $ok) {
      $ok = False;
      $warning = "Не указано имя";
    }
    if ($surname == "" and $ok) {
      $ok = False;
      $warning = "Не указана фамилия";
    }
    if ($email == "" and $ok) {
      $ok = False;
      $warning = "Не указана почта";
    }
    if ($phone == "" and $ok) {
      $ok = False;
      $warning = "Не указан номер телефона";
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
  $date = new DateTime();
  $filename = hash('md5', $name.$surname.strval($date->getTimeStamp())).".dat";
  $data = $name."\n".$surname."\n".$email."\n".$phone."\n".$topic."\n".$payment."\n".$mailing."\n";
  file_put_contents("applications/".$filename, $data);
  include 'success.html';
}
?>
