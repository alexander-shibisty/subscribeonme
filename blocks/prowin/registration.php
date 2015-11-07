<?php
$session_start = session_start();
require_once '../../php/main/SafeMySQL.php';
$string_object = new SafeMySQL();
$email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
$login = filter_input(INPUT_POST,'login');
$password = md5(filter_input(INPUT_POST,'password'));
$category = filter_input(INPUT_POST,'category');
$rules = filter_input(INPUT_POST,'rules');
if(isset($email,$login,$password,$category,$rules)) {
    $x = $string_object->getOne("SELECT user_id FROM users WHERE email=?s",$email);
    if($x) {
        print('Извините пожайлуста, но такой email уже зарегистрирован.');
        exit();
    }
    $x = $string_object->getOne("SELECT in_id FROM users_information WHERE nickname=?s",$login);
    if ($x) {
        print('Извините пожайлуста, но такой никнейм уже зарегистрирован.');
        exit();
    }
    $x = $string_object->getOne("SELECT nickname FROM users_registration WHERE nickname=?s", $login);
    if($x) {
        print('Просим прощения, но такой никнейм уже пытается зарегистрироваться.');
        exit();
    }
    $x = $string_object->getOne("SELECT email FROM users_registration WHERE email=?s", $email);
    if($x) {
        print('Просим прощения, но кто-то уже регистрируется с таким E-mail.');
        exit();
    }   
    $_SESSION['registration_email'] = $email;
    $_SESSION['registration_password'] = $password;
    $key_reg = uniqid(rand(1,1000).'_');
    $x = $string_object->query("INSERT INTO users_registration (key_reg, password, email, nickname, category, rules) VALUES (?s, ?s, ?s, ?s, ?s, ?s)",$key_reg,$password,$email,$login,$category,$rules);
    if($x) {
        $text = 'Для окончания регистрации пройдите по ссылке: http://subscribeonme.ru/rn='.$key_reg;
        mail($email, 'Pulsar. Подтверждение регистрации на сайте', $text);
        print('success');
    }
}
else {
    print('Нам неудобно вас разочаровывать, но формат данных некоректен.');
} 