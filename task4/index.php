<?php

function f($word) {
  $LANG = $_GET['lang'] ? $_GET['lang'] : 'en';
  $dict = [
    'en' => [
      'hello' => 'Hello!',
      'open' => 'Open',
      'save' => 'Save',
      'close_the_window' => 'Close the window?',
      'cannot_translate' => 'Cannot translate the phrase :(',
    ],
    'ru' => [
      'hello' => 'Привет!',
      'open' => 'Открыть',
      'save' => 'Сохранить',
      'close_the_window' => 'Закрыть окно?',
      'cannot_translate' => 'Не удается перевести фразу :(',
    ]
  ];
  if (!array_key_exists($LANG, $dict)) {
    return "Language is not supported :(";
  }
  if (!array_key_exists($word, $dict[$LANG])) {
    $word = "cannot_translate";
  }
  return $dict[$LANG][$word];
}

?>

<html>
  <head>
    <meta charset="utf-8">
    <title><?= f('hello') ?></title>
  </head>
  <body>
    <p><a href="index.php?lang=ru">Версия на русском языке</a></p>
    <p><a href="index.php?lang=en">English version</a></p>
    <p><a href="index.php?lang=es">Versión en español</a></p>
    <p><?= f('open') ?></p>
    <p><?= f('save') ?></p>
    <p><?= f('close_the_window') ?></p>
    <p><?= f('close') ?></p>
  </body>
</html>
