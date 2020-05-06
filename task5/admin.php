<?php
  $files = scandir("applications/");
  unset($files[0]);
  unset($files[1]);
  $users = Array();
  foreach ($files as $filename) {
    $data = file_get_contents("applications/".$filename);
    $data = explode("\n", $data);
    $user = [
      "name" => $data[0],
      "surname" => $data[1],
      "email" => $data[2],
      "phone" => $data[3],
      "topic" => $data[4],
      "payment" => $data[5],
      "mailing" => $data[6],
      "filename" => $filename,
    ];
    array_push($users, $user);
  }
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
  </head>
  <body>
    <form action="/delete.php">
    <table>
      <tr>
        <th>Имя</th>
        <th>Фамилия</th>
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
          <td><?= $user["email"] ?></td>
          <td><?= $user["phone"] ?></td>
          <td><?= $user["topic"] ?></td>
          <td><?= $user["payment"] ?></td>
          <td><?= $user["mailing"] ?></td>
          <td><input type="checkbox" name="for_delete[]" value="<?=$user["filename"]?>"></td>
        </tr>
      <?php endforeach ?>
    </table>
    <input type="submit" value="Удалить выбранных">
  </form>
  </body>
</html>
