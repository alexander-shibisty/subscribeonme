<?php
require '../../php/main/db_connect.php';
$id_other = filter_input(INPUT_POST, 'page');
$text = filter_input(INPUT_POST, 'text');
if(isset($user_id, $text, $id_other) && $id_other !== $user_id) {
    $string = new SafeMySQL();
    date_default_timezone_set('Europe/London');
    $date = date('Y-m-d H:i:s');
    $x = $string->getRow("SELECT d_id FROM users_dialogs WHERE pioneer_id=?i AND other_id=?i OR other_id=?i AND pioneer_id=?i",$user_id,$id_other,$user_id,$id_other);
    if($x) {
        $y = $string->query("INSERT INTO users_messages (d_id,user_id,text,date) VALUES (?i,?i,?s,?s)",$x['d_id'],$user_id,$text,$date);
        $query_dialog = $string->query('UPDATE users_dialogs SET date=?s,meter=?i WHERE d_id=?i LIMIT 1',$date,$user_id,$x['d_id']);
        print("success");
    }
    else {
        $y = $string->query("INSERT INTO users_dialogs (other_id, pioneer_id, date) VALUES (?i, ?i, ?s)",$id_other,$user_id,$date);
        $k = $string->getOne('SELECT d_id FROM users_dialogs WHERE pioneer_id=?i AND other_id=?i',$user_id,$id_other);
        $z = $string->query("INSERT INTO users_messages (d_id,user_id,text,date) VALUES (?i,?i,?s,?s)",$k,$user_id,$text,$date);
        print("success");
    }
}
else {
    print('Пройдите регистрацию или авторизацию.');
}