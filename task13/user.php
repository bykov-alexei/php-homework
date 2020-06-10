<?php

class User {
    public $name = '';
    public $surname = '';
    public $email = '';
    public $phone = '';
    public $topic = '';
    public $payment = '';
    public $mailing = '';
    public $time = '';

    function __construct($name, $surname, $email, $phone, $topic, $payment, $mailing) {
        if ($name) {
            $this->name = $name;
            $this->surname = $surname;
            $this->email = $email;
            $this->phone = $phone;
            $this->topic = $topic;
            $this->payment = $payment;
            $this->mailing = $mailing;
        }
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
        
        return new User($name, $surname, $email, $phone, $topic, $payment, $mailing);
    }

    static function from_row($row) {
        $name = $row['name'];
        $surname = $row['lastname'];
        $email = $row['email'];
        $phone = $row['tel'];
        $topic = $row['subject'];
        $payment = $row['payment'];
        $mailing = $row['mailing'];
        $time = $row['created_at'];
        $user = new User($name, $surname, $email, $phone, $topic, $payment, $mailing);
        $user->time = $time;
        return $user;
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
        $db = connect();
        $q = $db->prepare('INSERT INTO participants (`name`, `lastname`, `email`, `tel`, `subject_id`, `payment_id`, `mailing`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())');
        $q->execute([$this->name, $this->surname, $this->email, $this->phone, $this->topic, $this->payment, $this->mailing]);
    }

    static function load_users() {
        $db = connect();
        $users = Array();
        $q = $db->query("SELECT id, name, lastname, email, tel, subject, payment, mailing, created_at FROM ps_info WHERE deleted_at IS NULL");
        while ($row = $q->fetch()) {
            $users[$row['id']] = User::from_row($row);
        }
        return $users;
    }

    static function delete_user($user_id) {
        $db = connect();
        $q = $db->prepare('UPDATE participants SET deleted_at=NOW() WHERE id=?');
        $q->execute([$user_id]);
    }
}

?>