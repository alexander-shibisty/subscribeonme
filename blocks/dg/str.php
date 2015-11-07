<?php
require '../php/main/db_connect.php';
require 'mm/parser.php';
$arr = array();
if($last_id && $page && $user_id) {
	$string_object = new SafeMySQL();
        $writer = new Writer();
	$y = $string_object->getRow("SELECT d_id, other_id, pioneer_id,meter FROM users_dialogs WHERE d_id=?i AND pioneer_id=?i OR d_id=?i AND other_id=?i LIMIT 1", $category, $user_id, $category, $user_id);
            if($y['d_id']) {
                $dg = $string_object->getAll("SELECT m.text, m.date, m.mes_id, i.avatar, i.category, i.nickname FROM users_messages m, users_information i WHERE m.d_id=?i AND m.mes_id < ?i AND i.user_id = m.user_id ORDER BY m.mes_id DESC LIMIT 10", $y['d_id'],$last_id);
                $avatar = $string_object->getOne('SELECT avatar FROM users_information WHERE user_id=?i',$user_id);
                $avatar = file_exists('../upload_image/avatars/pre_150px/'.$avatar.'.jpg')? $avatar: 'default';
                $i = 0;
                foreach($dg as $array) {
                    $res = array(
                        'n0' => $y['d_id'],
                        'n1' => $array['mes_id'],
                        'n2' => $array['avatar'],
                        'n3' => $array['nickname'],
                        'n4' => $array['date'],
                        'n5' => $writer->main($array['text'], 1)
                    );
                    $i++;
                    array_push($arr,$res);
                }
                unset($array);
            }
}

print json_encode($arr);