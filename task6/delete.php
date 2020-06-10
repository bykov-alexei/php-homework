<?php
$file = file_get_contents('applications.txt');
$lines = explode("\n", $file);
array_pop($lines);
$for_delete = $_GET['for_delete'];
$excluded = Array();
foreach ($for_delete as $line) {
  $data = explode("||", $line);
  $user = [
    'name' => $data[0],
    'surname' => $data[1],
    'time' => $data[2],
  ];
  array_push($excluded, $user);
}

foreach ($lines as $user_data) {
  $data = explode('||', $user_data);
  $user = [
    'name' => $data[0],
    'surname' => $data[1],
    'time' => $data[2],
    'email' => $data[3],
    'phone' => $data[4],
    'topic' => $data[5],
    'payment' => $data[6],
    'mailing' => $data[7],
  ];
  $delete = False;
  foreach ($excluded as $usr) {
    if ($usr['name'] == $user['name'] &&
            $usr['surname'] == $user['surname'] &&
            $usr['time'] == $user['time']) {

          $delete = True;
        }
  }
  if ($delete) {
    $new_line = substr($user_data, 0, strlen($user_data));
    $new_line[strlen($new_line) - 1] = '0';
    $file = str_replace($user_data, $new_line, $file);
  }
}
file_put_contents('applications.txt', $file);
echo 'Заявки успешно удалены';