<?php
require '../php/main/db_connect.php';
require 'mm/parser.php';
$arr = array();
if(isset($user_id, $category)) {
	$string_object = new SafeMySQL();
                $writer = new Writer();
	$y = $string_object->getRow("SELECT d_id, other_id, pioneer_id,meter FROM users_dialogs WHERE d_id=?i AND pioneer_id=?i OR d_id=?i AND other_id=?i LIMIT 1", $category, $user_id, $category, $user_id);
                if($y['meter'] !== $user_id) {
                    $string_object->query('UPDATE users_dialogs SET meter=0 WHERE d_id=?i',$id_page);
                }
                            if($y['d_id']) {
                                    $dg = $string_object->getAll("SELECT m.text, m.date, m.mes_id, i.avatar, i.category, i.nickname FROM users_messages m, users_information i WHERE m.d_id=?i AND i.user_id = m.user_id ORDER BY m.mes_id DESC LIMIT 10", $y['d_id']);
                                    $avatar = $string_object->getOne('SELECT avatar FROM users_information WHERE user_id=?i',$user_id);
                                    $avatar = file_exists('../upload_image/avatars/pre_150px/'.$avatar.'.jpg')? $avatar: 'default';
                                    //Если диалогов нет
                                    if($dg) {
                                        $i = 0;
                                        foreach($dg as $array) {
                                                $avatar_other = file_exists('../upload_image/avatars/pre_150px/'.$array['avatar'].'.jpg')? $array['avatar']: 'default';
                                                $res = array(
                                                    'n0' => $y['d_id'],
                                                    'n1' => $array['mes_id'],
                                                    'n2' => $avatar_other,
                                                    'n3' => $array['nickname'],
                                                    'n4' => $array['date'],
                                                    'n5' => $writer->main($array['text'], 1)
                                                );
                                                if(!$i) {
                                                    $res = array(
                                                        'head' => '<nav id="content_menu"> 
                                                                        <a href="mm=dialogs" class="new_local"><p>ДИАЛОГИ</p></a>
                                                                    </nav>
                                                                    <section id="message_input">
                                                                        <div id="message_input_center">
                                                                            <div id="user" style="background: #000 no-repeat center url(upload_image/avatars/pre_150px/'.$avatar.'.jpg);">
                                                                            </div>
                                                                            <div id="text" contenteditable="true"></div>
                                                                            <div id="material">
                                                                            </div>
                                                                            <p id="text_meter">0</p>
                                                                            <button id="message_input_button">ОТПРАВИТЬ</button>
                                                                        </div>
                                                                    </section>
                                                                    <section id="messages" class="content_block">',
                                                        'tmp' => '<article class="messages %n[0]" id="%n[1]">
                                                                            <div class="user_name">
                                                                                <p style="float:left;">%n[3]</p>
                                                                                <p style="float:right; font-size:10px;">%n[4]</p>
                                                                            </div>
                                                                            <div class="user" style="background: #000 no-repeat center url(upload_image/avatars/pre_150px/%n[2].jpg);">
                                                                            </div>
                                                                            <div class="text">
                                                                                <span>%n[5]</span>
                                                                            </div>
                                                                        </article>',
                                                        'footer' => '</section><script defer src="js/blocks/dg.js"></script>'
                                                    )+$res;
                                                }
                                                $i++;
                                                array_push($arr,$res);
                                        }
                                        unset($array);
                                    }
                                    else {
                                        $res = array(
                                                        'head' => '<section id="dialog">
                                                                            <nav id="content_menu"> 
                                                                                <a href="mm=dialogs" class="new_local"><p>ДИАЛОГИ</p></a>
                                                                            </nav>
                                                                            <section id="message_input">
                                                                                <div id="user" style="background: #000 no-repeat center url(upload_image/avatars/pre_150px/'.$avatar.'.jpg);">
                                                                                </div>
                                                                                <div id="text" contenteditable="true"></div>
                                                                                <div id="material">
                                                                                </div>
                                                                                <button>ОТПРАВИТЬ</button>
                                                                            </section>
                                                                        </section>
                                                                        <section id="messages_not_absolut">   
                                                                        <section id="messages" class="content_block"><div id="dialog_403">Диалога нет, но вы можете его начать.</div></section></section>'
                                        );
                                        array_push($arr,$res);
                                    }
                                    
		}
		else {
                                    $res = array(
                                        'head' => '<p id="dialog_403">Этот диалог не существует в вашей вселенной</p>'
                                    );
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