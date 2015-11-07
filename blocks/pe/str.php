<?php
require '../php/main/SafeMySQL.php';
if($last_id && $page) {
    $string_object = new SafeMySQL();
    $arr = array();
    if($category === 'all' || !$category) {
        $o = $string_object->getAll("SELECT u.user_id, u.avatar, u.nickname, u.category, o.online FROM users_information u, users_online o WHERE o.user_id = u.user_id AND u.user_id<?i ORDER BY user_id DESC LIMIT 0,10",$last_id);   
    }
    else {
        $o = $string_object->getAll("SELECT u.user_id, u.avatar, u.nickname, u.category, o.online FROM users_information u, users_online o WHERE o.user_id = u.user_id AND u.user_id<?i AND u.category=?s ORDER BY user_id DESC LIMIT 0,10",$last_id,$category);
    }
    $i = 0;
    foreach($o as $array) {
            $image = (file_exists('../upload_image/avatars/pre_50px/'.$array['avatar'].'.jpg')) ? $array['avatar'] : 'default';
            $res = array(
                'n0' => $array['user_id'],
                'n1' => $image,
                'n2' => $array['nickname'],
                'n3' => $array['online'],
                'n4' => $array['category'],
                'n5' => 'Null'
            );
            $i++;
             array_push($arr,$res);
    }
    unset($array);
    print json_encode($arr);
}