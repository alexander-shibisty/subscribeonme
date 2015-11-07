<?php
require '../php/main/db_connect.php';
require 'mm/parser.php';
$arr = array();
if($last_id && $page && $user_id) {
    //$string_object = new SafeMySQL();
    $writer = new Writer();
    $last_id = date('Y-m-d H:i:s',$last_id);
    $query = $o->getAll("SELECT d_id,pioneer_id,other_id,date,meter FROM users_dialogs WHERE pioneer_id=?i AND date<?s OR other_id=?i AND date<?s ORDER BY date DESC LIMIT 0,9",$user_id,$last_id,$user_id,$last_id);
    //Нужно перебрать все d_id в массиве, чтобы передать их в IN() для выборки последних сообщений в диалоге
    $arr_id = array();
    $r = array();
    foreach ($query as $m_id) {
        array_push($arr_id, $m_id['d_id']);
        $u_ids = ($user_id === $m_id['pioneer_id']) ?$m_id['other_id']:$m_id['pioneer_id'];
        array_push($r, $u_ids);
    }
    unset($m_id);
    $x = $o->getAll("SELECT text,user_id FROM (SELECT m.d_id,m.text,m.user_id,i.nickname,i.avatar FROM users_messages m, users_information i WHERE m.d_id IN(?a) AND i.user_id = m.user_id ORDER BY m.mes_id DESC) AS timetable WHERE d_id IN(?a) GROUP BY FIELD(d_id,?a) LIMIT 0,9",$arr_id,$arr_id,$arr_id);
    //Нужно перебрать все id пользователей в массив, чтобы передать в IN и выбрать из базы данные пользователей, с которым ведет переписку клиент, который запрашивает страницу
    //по этому мы отсеиваем ид, если он равен иду этого клиента (клиент ничего не поймет, если увидит у себя диалог с собой же)
    $y = $o->getAll("SELECT i.category, i.avatar, i.nickname,o.online FROM users_information i, users_online o WHERE i.user_id IN(?a) AND o.user_id = i.user_id ORDER BY FIELD(i.user_id,?a) LIMIT 0,9",$r,$r);
    //$cout_el = $string_object->getOne("SELECT COUNT(*) FROM users_dialogs WHERE pioneer_id=?i OR other_id=?i",$user_id,$user_id);
    //Теперь нам нужно все упаковать в json и вернуть
    $i= 0;
    foreach($query as $array) {
        $image = (file_exists('../upload_image/avatars/pre_150px/'.$y[$i]['avatar'].'.jpg')) ? $y[$i]['avatar'] : 'default';
        $mini_image = (file_exists('../upload_image/avatars/pre_50px/'.$x[$i]['avatar'].'.jpg')) ? $x[$i]['avatar'] : 'default';
        $read = ($array['meter'] !== $user_id && $array['meter'] !== '0') ?'#d1d1d1':'#000';
        $res = array(
            'n0' => $array['d_id'],
            'n1' => $image,
            'n2' => $y[$i]['nickname'],
            'n3' => $y[$i]['online'],
            'n4' => $y[$i]['category'],
            'n5' => $array['date'],
            'n6' => ($x[$i]['text'])?$writer->main($x[$i]['text']):':(',
            'n7' => strtotime($array['date']),
            'n8' => $read,
            'n9' => ($x[$i]['nickname'])?$x[$i]['nickname']:'Сообщений нет',
            'n10' => $mini_image
        );
        $i++;
        array_push($arr,$res);
    }
    unset($array);  
}

print json_encode($arr);