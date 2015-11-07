<?php
require '../../php/main/db_connect.php';
$fre_id = filter_input(INPUT_POST, 'add_id', FILTER_VALIDATE_INT);
$user_pioneer = filter_input(INPUT_POST, 'pioneer_id', FILTER_VALIDATE_INT);
if($user_id && $fre_id) {
    $user = $o->getOne("SELECT user_id FROM users WHERE user_id=?i",$user_pionner);//проверить, существует ли пользователь.
    $query = $o->getOne("SELECT req_id FROM users_friends_req WHERE req_id=?i AND user_pioneer=?i AND user_other=?i",$fre_id,$user_pioneer,$user_id);//проверить существует ли заявка.
    $friend = $o->getOne("SELECT fr_id FROM users_friends WHERE user_pioneer=?i AND user_other=?i",$user_pioneer,$user_id);//проверить !существует ли такая связь.
    if($user || $query || !$friend) {
        $o->query("INSERT INTO users_friends (user_pioneer, user_other) "
                    . "VALUES (?i, ?i)",$user_pioneer,$user_id);
        $o->query('DELETE FROM users_friends_req WHERE req_id=?i',$fre_id);
        print('success');
    }
    else {
        print('Что-то пошло не так.');
    }
}
else {
    print('Авторизуйтесь или зарегистрируйтесь на сайте.');
}