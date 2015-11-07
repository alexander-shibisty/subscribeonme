<?php
require '../../php/main/db_connect.php';
require '../mm/parser.php';
$id_last = filter_input(INPUT_GET, 'last_id', FILTER_VALIDATE_INT);
$id_dialog = filter_input(INPUT_GET,'page');
$arr = array();
if($user_id && $id_last && $id_dialog) {
        $x = $o->getOne("SELECT mes_id FROM users_messages WHERE d_id=?i ORDER BY mes_id DESC LIMIT 1",$id_dialog);
        $y = $o->getOne("SELECT d_id FROM users_dialogs WHERE d_id=?i AND pioneer_id=?i OR d_id=?i AND other_id=?i LIMIT 1",$id_dialog,$user_id,$id_dialog,$user_id);
        if($x !== $id_last && $y) {
            $writer = new Writer();
            $query = $o->getAll("SELECT m.text, m.date, m.mes_id, m.d_id, i.avatar, i.category, i.nickname FROM users_messages m, users_information i WHERE m.d_id=?i AND m.mes_id>?i AND m.user_id <> ?i AND i.user_id=m.user_id ORDER BY m.mes_id DESC LIMIT 9",$id_dialog,$id_last,$user_id);
            foreach($query as $array) {
                $image = (file_exists('../../upload_image/avatars/pre_150px/'.$array['avatar'].'.jpg')) ? $array['avatar'] : 'default';
                $res = array(
                   'dialog_id' => $array['d_id'],
                   'message_id' => $array['mes_id'],
                   'date' => $array['date'],
                   'text' => $writer->main($array['text']),
                   'avatar' => $image,
                   'nickname' => $array['nickname']
                );
                array_push($arr,$res);
            }
        }
}
print json_encode($arr);