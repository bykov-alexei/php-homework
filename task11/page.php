﻿<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Регистрация</title>
  </head>
  <body>
    <p style="color: red"><?= $warning ?></p>
    <form action="index.php" method='post'>
      <p>Имя:</p>
      <p><input name="name" value="<?= $user->name ?>"></p>
      <p>Фамилия:</p>
      <p><input name="surname" value="<?= $user->surname ?>"></p>
      <p>Электронная почта:</p>
      <p><input name="email" value="<?= $user->email ?>"></p>
      <p>Телефон:</p>
      <p><input name="phone" value="<?= $user->phone ?>"></p>
      <p>Тематика конференции:</p>
      <p><input type="radio" name="topic" value="Бизнес">Бизнес</p>
      <p><input type="radio" name="topic" value="Технологии">Технологии</p>
      <p><input type="radio" name="topic" value="Реклама и Маркетинг">Реклама и Маркетинг</p>
      <p>Способ оплаты:</p>
      <p><input type="radio" name="payment" value="WebMoney">WebMoney</p>
      <p><input type="radio" name="payment" value="Яндекс.Деньги">Яндекс.Деньги</p>
      <p><input type="radio" name="payment" value="PayPal">PayPal</p>
      <p><input type="radio" name="payment" value="Кредитная карта">Кредитная карта</p>
      <p><input type="checkbox" name="mailing" checked>Я хочу получать рассылку на почту</p>
      <p><input type="submit" value="Send"></p>
    </form>
  </body>
</htm