<?php

class User {
    public $name = '';
    public $surname = '';
    public $time = '';
    public $email = '';
    public $phone = '';
    public $topic = '';
    public $payment = '';
    public $mailing = '';

    function __construct($name, $surname, $time, $email, $phone, $topic, $payment, $mailing) {
        if ($name) {
            $this->name = $name;
            $this->surname = $surname;
            $this->time = $time;
            $this->email = $email;
            $this->phone = $phone;
            $this->topic = $topic;
            $this->payment = $payment;
            $this->mailing = $mailing;
        }
    }

    static function from_line($line) {
        $parts = explode('||', $line);
        return new User($parts[0], $parts[1], $parts[2], $parts[3], 
                        $parts[4], $parts[5], $parts[6], $parts[7]);
    }

    static function create_empty() {
        return new User('', '', '', '', '', '', '', '');
    }

    static function from_query($_DATA) {
    $name = $surname = $email = $phone = $topic = $payment = $mailing = '';
        if (array_key_exists('name', $_DATA))
            $name = trim($_DATA['name']);
        if (array_key_exists('surname', $_DATA))
            $surname = trim($_DATA['surname']);
        if (array_key_exists('email', $_DATA))
            $email = trim($_DATA['email']);
        if (array_key_exists('phone', $_DATA))
            $phone = trim($_DATA['phone']);
        if (array_key_exists('topic', $_DATA))
            $topic = trim($_DATA['topic']);
        if (array_key_exists('payment', $_DATA))
            $payment = trim($_DATA['payment']);
        if (array_key_exists('mailing', $_DATA))
            $mailing = (int) (trim($_DATA['mailing']) == 'on');
        $time = date('d/m/Y h:i:s');

        return new User($name, $surname, $time, $email, $phone, $topic, $payment, $mailing);
    }

    function get_line() {
        return  $this->name.'||'.
            $this->surname.'||'.
            $this->time.'||'.
            $this->email.'||'.
            $this->phone.'||'.
            $this->topic.'||'.
            $this->payment.'||'.
            $this->mailing."\n";
    }

    function hash() {
        return md5($this->name.$this->surname.$this->time);
    }

    function assert_user() {
        User::assert_specified($this->name, 'Не указано имя');
        User::assert_specified($this->surname, 'Не указана фамилия');
        User::assert_specified($this->email, 'Не указана почта');
        User::assert_specified($this->phone, 'Не указан номер телефона');
        User::assert_specified($this->topic, 'Не указана тематика');
        User::assert_specified($this->payment, 'Не указан способ оплаты');

        User::assert_symbols($this->name, 'Имя содержит недопустимый символ');
        User::assert_symbols($this->surname, 'Фамилия содержит недопустимый символ');
        User::assert_symbols($this->email, 'Почта содержит недопустимый символ');
        User::assert_symbols($this->phone, 'Номер телефона содержит недопустимый символ');
        User::assert_symbols($this->topic, 'Тематика содержит недопустимый символ');
        User::assert_symbols($this->payment, 'Способ облаты содержит недопустимый символ');

        User::assert_regexp($this->name, '/^[А-Я][а-я]+$/u', 'Неверно указано имя. Должны содержаться только символы русского алфавита. Пример корректного ввода: Иван');
        User::assert_regexp($this->surname, '/^[А-Я][а-я]+$/u', 'Неверно указана фамилия. Должны содержаться только символы русского алфавита. Пример корректного ввода: Иванов');
        User::assert_regexp($this->email, '/^[a-z\.0-9_]+@[a-z\d]+(\.[a-z\d]+)+$/', 'Неверно указана почта. Пример правильного адреса: example@site.com');
        User::assert_phone($this->phone, 'Неверно указан номер телефона. Пример корректного ввода: +7 999 123-45-66');
    }

    private function assert_specified($var, $message) {
        if ($var == '') {
            throw new Exception($message);
        }
    }

    private function assert_symbols($var, $message) {
        if (strpos($var, '|') !== False) {
            throw new Exception($message);
        }
    }

    private function assert_phone($phone, $message) {
        $regexp = '/^(\+7|8)[\s\-\(]*([\d]{3})[\s\-\)]*([\d]{3})[\s\-\)]*([\d]{2})[\s\-\)]*([\d]{2})$/';
        if (!preg_match($regexp, $phone)) {
            throw new Exception($message);
        }
        $phone = preg_replace($regexp, '+7 $2 $3-$4-$5', $phone);
        $this->phone = $phone;
    }

    private function assert_regexp($var, $regexp, $message) {
        if (!preg_match($regexp, $var)) {
            throw new Exception($message);
        }
    }

    function put() {
        file_put_contents('applications.txt', $this->get_line(), FILE_APPEND);
    }

    static function load_users() {
        $file = file_get_contents('applications.txt');
        $lines = explode("\n", $file);
        array_pop($lines);
        $users = Array();
        foreach ($lines as $line) {
            $user = User::from_line($line);
            $users[$user->hash()] = $user;
        }
        return $users;
    }

    static function save_users($users) {
        $file = fopen('applications.txt', 'w');
        foreach ($users as $user) {
            fwrite($file, $user->get_line());
        }
        fclose($file);
    }
}

?>