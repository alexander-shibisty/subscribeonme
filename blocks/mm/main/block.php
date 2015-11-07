<?php
require '../php/main/db_connect.php';
require $page.'/parser.php';
$arr = array();
if(isset($user_id)) {
    $query = $o->getAll("SELECT d_id,pioneer_id,other_id,date,meter FROM users_dialogs WHERE pioneer_id=?i OR other_id=?i ORDER BY date DESC LIMIT 0,9",$user_id,$user_id);
    if($query) {
    //Нужно перебрать все d_id в массиве, чтобы передать их в IN() для выборки последних сообщений в диалоге
        $writer = new Writer();
        $arr_id = array();
        $r = array();
        foreach ($query as $m_id) {
            array_push($arr_id, $m_id['d_id']);
            $u_ids = ($user_id === $m_id['pioneer_id']) ?$m_id['other_id']:$m_id['pioneer_id'];
            array_push($r, $u_ids);
        }
        unset($m_id);
        $x = $o->getAll("SELECT text,user_id,nickname,avatar FROM (SELECT m.d_id,m.text,m.user_id,i.nickname,i.avatar FROM users_messages m, users_information i WHERE m.d_id IN(?a) AND i.user_id = m.user_id ORDER BY m.mes_id DESC) AS timetable WHERE d_id IN(?a) GROUP BY FIELD(d_id,?a) LIMIT 0,9",$arr_id,$arr_id,$arr_id);
        //Нужно перебрать все id пользователей в массив, чтобы передать в IN и выбрать из базы данные пользователей, с которым ведет переписку клиент, который запрашивает страницу
        //по этому мы отсеиваем ид, если он равен иду этого клиента (клиент ничего не поймет, если увидит у себя диалог с собой же)
        $y = $o->getAll("SELECT i.category, i.avatar, i.nickname,o.online FROM users_information i, users_online o WHERE i.user_id IN(?a) AND o.user_id = i.user_id ORDER BY FIELD(i.user_id,?a) LIMIT 0,9",$r,$r);
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
            if(!$i) {
                $res = array(
                    'head' => '<nav id="content_menu"> 
                                        <a href="mm=dialogs" class="new_local"><p>ДИАЛОГИ</p></a>
                                        <a href="mm=conference" class="new_local"><p>КОНФЕРЕНЦИИ</p></a>
                                        <a href="mm=friends" class="new_local"><p>ДРУЗЬЯ</p></a>
                                    </nav>
                                    <section class="my_message_url content_block">',
                    'tmp' => '<article class="you_message" id="%n[7]">
                                        <div class="user_info" style="background: #000 no-repeat center url(upload_image/avatars/pre_150px/%n[1].jpg);">
                                            <div class="users_nicknames">
                                                <p>%n[2]</p>
                                            </div>
                                            <div class="user_status" style="background: #636363 no-repeat center url(img/system_icon/status/%n[3].png);">
                                            </div>
                                            <div class="user_category" style="background: #ff5300 no-repeat center url(img/user_icon/%n[4].png);">
                                            </div>
                                        </div>
                                        <a class="new_local" href="dg=%n[0]"><div class="user_message">
                                            <div class="message_see" style="background:%n[8];">
                                                <div class="message_tr"></div>
                                            </div>
                                            <div class="message_information">
                                                    <p style="float:left;">%n[9]</p>
                                                    <p style="float:right;">%n[5]</p>
                                            </div>
                                            <div class="message_lt">
                                                <div class="message_list_avatar" style="background: no-repeat center url(upload_image/avatars/pre_50px/%n[10].jpg);background-size: cover;">
                                                </div>
                                                <div class="message_list">
                                                    <p>%n[6]</p>
                                                </div>
                                            </div>
                                        </div></a>
                                    </article>',
                    'footer' => '</section>'
                )+$res;
            }
            $i++;
            array_push($arr,$res);
        }
        unset($array); 
    }
    else {
        $res = array(
                    'head' => '<nav id="content_menu"> 
                                        <a href="mm=dialogs" class="new_local"><p>ДИАЛОГИ</p></a>
                                        <a href="mm=conference" class="new_local"><p>КОНФЕРЕНЦИИ</p></a>
                                        <a href="mm=friends" class="new_local"><p>ДРУЗЬЯ</p></a>
                                </nav>
                                <div id="material_null"><p>У вас нет диалогов, но вы можете их создать. <a href="pe" class="new_local">Просто найдите себе собеседника.</a></p><div>');
        array_push($arr,$res);
    }
}
else {
        $res = array(
            'head' => '<div id="none"><p>Для просмотра этой страницы пройдите регистрацию или авторизацию</p><div>'
        );
        array_push($arr,$res);
}

print json_encode($arr);