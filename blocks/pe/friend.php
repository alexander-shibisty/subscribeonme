<?php
require '../../php/main/db_connect.php';
$id = filter_input(INPUT_POST,'pioneer', FILTER_VALIDATE_INT);
if(isset($user_id)) {
    //Объект с коннектом находится в подключаемом файле
    $user = $o->getOne("SELECT user_id FROM users WHERE user_id=?i",$id);
    $req = $o->getOne("SELECT req_id FROM users_friends_req WHERE user_pioneer=?i AND user_other=?i OR user_pioneer=?i AND user_other=?i",$id,$user_id,$user_id,$id);
    $fre = $o->getOne("SELECT fr_id FROM users_friends WHERE user_pioneer=?i AND user_other=?i OR user_pioneer=?i AND user_other=?i",$id,$user_id,$user_id,$id);
    if(!$user || $req || $fre) {
        $er = ($req) ? 'Заявка уже существует.' : 'Такого пользователя нет на сайте.';
        print($er);
    }
    else if($user_id != $id) {
        $q = $o->query("INSERT INTO users_friends_req (user_pioneer, user_other) "
                                . "VALUES (?i, ?i)",$user_id,$id);

        print('success');
    }
    else {
        print('Извините, но нельзя добавить в друзья себя. Лучше купите себе подарок.');
    }
}
else {
    print('Авторизуйтесь или зарегистрируйтесь на сайте.');
}