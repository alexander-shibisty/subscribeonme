<?php
require '../../php/main/db_connect.php';
$text = trim(filter_input(INPUT_POST,'text'));
$key_dialog = filter_input(INPUT_POST,'page');
if ($text && $key_dialog && $user_id) {
    $x = $o->getRow("SELECT d_id, other_id, pioneer_id FROM users_dialogs WHERE d_id=?i AND pioneer_id=?i OR d_id=?i AND other_id=?i LIMIT 1",$key_dialog,$user_id,$key_dialog,$user_id);
    if($x) {
        if($x['id_other'] == $user_id) {
            $id_other = $x['pioneer_id'];
        }
        else {
            $id_other = $x['other_id'];
        }
        date_default_timezone_set('Europe/London');
        $date = date('Y-m-d H:i:s');
            $query_message = $o->query("INSERT INTO users_messages (d_id, user_id, text, date) "
                                        . "VALUES (?i, ?i, ?s, ?s)", 
                                        $x['d_id'],$user_id,$text,$date);
            $query_dialog = $o->query('UPDATE users_dialogs SET date=?s,meter=?i WHERE d_id=?i LIMIT 1',$date,$user_id,$x['d_id']);
            if($query_message && $query_dialog) {
                $message = $o->getOne('SELECT mes_id FROM users_messages WHERE d_id=?i AND user_id=?i ORDER BY mes_id DESC LIMIT 1',$key_dialog,$user_id);
                print($message);
            }   
    }
    unset($text,$key_dialog,$string,$x);
}
else {
    print('Сервер не получил нужных данных.');
}