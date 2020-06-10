<?php
function connect() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=webhomework72;charset=utf8', 'webhomework72', 'DW22Tc8y');
      } catch (PDOException $e) {
        echo "Ошибка подключения к БД";
      }
    return $db;
}

?>