<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title>Регистрация</title>
  </head>
  <body>
    <p style="color: red"><?= $warning ?></p>
    <form action="submit.php" method='post'>
      <p>Имя:</p>
      <p><input name="name" value="<?= $user->name ?>"></p>
      <p>Фамилия:</p>
      <p><input name="surname" value="<?= $user->surname ?>"></p>
      <p>Электронная почта:</p>
      <p><input name="email" value="<?= $user->email ?>"></p>
      <p>Телефон:</p>
      <p><input name="phone" value="<?= $user->phone ?>"></p>
      <p>Тематика конференции:</p>
      <?php foreach ($subjects as $id => $name): ?> 
        <p><input type='radio' name='topic' value='<?= $id ?>'><?= $name ?></p>
      <?php endforeach ?>
      <p>Способ оплаты:</p>
      <?php foreach ($payments as $id => $name): ?> 
        <p><input type='radio' name='payment' value='<?= $id ?>'><?= $name ?></p>
      <?php endforeach ?>
      <p><input type="checkbox" name="mailing" checked>Я хочу получать рассылку на почту</p>
      <p><input type="submit" value="Send"></p>
    </form>
  </body>
</htm