<?php
require '../../php/main/db_connect.php';
$id = filter_input(INPUT_POST,'pioneer');
if(isset($user_id,$id)) {
    //Объект с коннектом находится в подключаемом файле
    $user = $o->getOne("SELECT user_id FROM users WHERE user_id=?i",$id);
    $req = $o->getOne("SELECT sub_id FROM users_subscribes WHERE user_pioneer=?i AND user_other=?i",$user_id,$id);
    if(!$user || $req) {
        $er = ($req) ? 'Вы уже подписаны.' : 'Такого пользователя нет на сайте.';
        print($er);
    }
    else if($user_id != $id) {
        $q = $o->query("INSERT INTO users_subscribes (user_pioneer, user_other) "
                                . "VALUES (?i, ?i)",$user_id,$id);
        $result = ($q) ? 'success' : 'Что-то пошло не так...';
        print($result);
    }
    else {
        print('Извините, но вы не можете подписаться на себя.');
    }
}
else {
    print('Авторизуйтесь или зарегистрируйтесь на сайте.');
}