<?php
  include 'user.php';
  include 'db.php';

  $users = User::load_users();
?>

<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
  </head>
  <body>
    <form action="delete.php" method='post'>
    <table>
      <tr>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Дата и время заявки</th>
        <th>Почта</th>
        <th>Телефон</th>
        <th>Тематика</th>
        <th>Способ оплаты</th>
        <th>Рассылка</th>
        <th>Удалить</th>
      </tr>
      <?php foreach ($users as $id => $user): ?>
        <tr>
          <td><?= $user->name ?></td>
          <td><?= $user->surname ?></td>
          <td><?= $user->time ?></td>
          <td><?= $user->email ?></td>
          <td><?= $user->phone ?></td>
          <td><?= $user->topic ?></td>
          <td><?= $user->payment ?></td>
          <td><?= $user->mailing ?></td>
          <td><input type="checkbox" name="for_delete[]" value="<?= $id ?>"></td>
        </tr>
      <?php endforeach ?>
    </table>
    <input type="submit" value="Удалить выбранных">
  </form>
  </body>
</ht