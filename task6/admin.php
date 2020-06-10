<?php
  $data = file_get_contents("applications.txt");
  $data = explode("\n", $data);
  array_pop($data);
  $users = Array();
  foreach ($data as $user_data) {
    $data = explode("||", $user_data);
    if ($data[8]) {
      $user = [
        "name" => $data[0],
        "surname" => $data[1],
        "time" => $data[2],
        "email" => $data[3],
        "phone" => $data[4],
        "topic" => $data[5],
        "payment" => $data[6],
        "mailing" => $data[7],
      ];
      array_push($users, $user);
    }
  }
?>

<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
  </head>
  <body>
    <form action="delete.php">
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
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= $user["name"] ?></td>
          <td><?= $user["surname"] ?></td>
          <td><?= $user["time"] ?></td>
          <td><?= $user["email"] ?></td>
          <td><?= $user["phone"] ?></td>
          <td><?= $user["topic"] ?></td>
          <td><?= $user["payment"] ?></td>
          <td><?= $user["mailing"] ?></td>
          <td><input type="checkbox" name="for_delete[]" value="<?=$user["name"]."||".$user["surname"]."||".$user["time"]?>"></td>
        </tr>
      <?php endforeach ?>
    </table>
    <input type="submit" value="Удалить выбранных">
  </form>
  </body>
</ht