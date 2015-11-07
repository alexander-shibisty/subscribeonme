<?php
require '../../php/main/db_connect.php';
$fre_id = filter_input(INPUT_POST, 'rem_id', FILTER_VALIDATE_INT);
$user_pioneer = filter_input(INPUT_POST, 'pioneer_id', FILTER_VALIDATE_INT);
if($user_id && $fre_id) {
    $query = $o->getOne('SELECT req_id FROM users_friends_req WHERE req_id=?i AND user_pioneer=?i AND user_other=?i',$fre_id,$user_pioneer,$user_id);
    if($query){
        $o->query('DELETE FROM users_friends_req WHERE req_id=?i',$query);
        print('success');
    }
    else {
        print('Что-то пошло не так.');
    }
}
else {
    print('Авторизуйтесь или зарегистрируйтесь на сайте.');
}
