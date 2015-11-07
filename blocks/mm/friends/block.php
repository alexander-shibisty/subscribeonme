<?php
require '../php/main/db_connect.php';
$arr = array();
if($user_id) {
        $u_friends = $o->getAll('SELECT f.req_id, f.user_pioneer, f.user_other, f.date, u.nickname, u.category, u.avatar, o.online FROM users_friends_req f, users_information u, users_online o WHERE f.user_other=?i AND u.user_id = f.user_pioneer AND o.user_id = f.user_pioneer',$user_id);
        $r_friends = $o->getAll('SELECT f.user_pioneer, f.user_other, f.date, u.nickname, u.category, u.avatar, o.online FROM users_friends_req f, users_information u, users_online o WHERE f.user_pioneer=?i AND u.user_id = f.user_other AND o.user_id = f.user_other',$user_id);
        $friends = $o->getAll('SELECT f.user_pioneer, f.user_other, u.nickname, u.category, u.avatar, o.online FROM users_friends f, users_information u, users_online o WHERE f.user_pioneer=?i AND u.user_id = f.user_other AND o.user_id = f.user_other OR f.user_other=?i AND u.user_id = f.user_pioneer AND o.user_id = f.user_pioneer',$user_id,$user_id);
    if($u_friends || $r_friends || $friends) {
        $i=0;
        foreach ($u_friends as $u_array){
            $image = (file_exists('../upload_image/avatars/pre_150px/'.$u_array['avatar'].'.jpg')) ? $u_array['avatar'] : 'default';
            $res = array(
                'n0' => $u_array['user_pioneer'],
                'n1' => $image,
                'n2' => $u_array['nickname'],
                'n3' => $u_array['online'],
                'n4' => $u_array['category'],
                'n5' => '<div class="p_in"><button class="re_friend" id="'.$u_array['req_id'].'">Отклонить</button><button class="add_friend" id="'.$u_array['req_id'].'">Принять</button></div>'
            );
            if(!$i) {
                        $res = array(
                                    'head' => '<nav id="content_menu"> 
                                                                <a href="mm=dialogs" class="new_local"><p>ДИАЛОГИ</p></a>
                                                                <a href="mm=conference" class="new_local"><p>КОНФЕРЕНЦИИ</p></a>
                                                                <a href="mm=friends" class="new_local"><p>ДРУЗЬЯ</p></a>
                                                            </nav><nav id="content_search"></nav><section id="content_block">',
                                        'tmp' => '<article class="people_article" id="%n[0]">
                                                    <div class="people_avatar" style="background: no-repeat center url(upload_image/avatars/pre_50px/%n[1].jpg); background-size: cover;">
                                                    </div>
                                                    <div class="peaple_cat">
                                                        <div class="people_status" style="background: #636363 no-repeat center url(img/system_icon/status/%n[3].png);background-size: contain;"></div>
                                                        <div class="people_status" style="background: #ff5300 no-repeat center url(img/user_icon/%n[4].png);background-size: contain;"></div>
                                                    </div>
                                                    <div class="pp">
                                                        <a class="new_local" href="pl=%n[0]">
                                                            <p class="people_title">%n[2]</p>
                                                        </a>
                                                        <div class="p_in">
                                                            %n[5]
                                                        <div>
                                                    </div>
                                                </article>',
                                        'footer' => '</section><script defer src="js/blocks/mm.js"></script>')+$res;
            }
            $i++;
            array_push($arr,$res);
        }
        foreach ($r_friends as $r_array){
            $image = (file_exists('../upload_image/avatars/pre_150px/'.$r_array['avatar'].'.jpg')) ? $r_array['avatar'] : 'default';
            $res = array(
                'n0' => $r_array['user_other'],
                'n1' => $image,
                'n2' => $r_array['nickname'],
                'n3' => $r_array['online'],
                'n4' => $r_array['category'],
                'n5' => '<div class="p_in">Ваша заявка еще не принята.<button id="'.$r_array['req_id'].'">Отозвать</button></div>'
            );
            if(!$i) {
                        $res = array(
                                    'head' => '<nav id="content_menu"> 
                                                                <a href="mm=dialogs" class="new_local"><p>ДИАЛОГИ</p></a>
                                                                <a href="mm=conference" class="new_local"><p>КОНФЕРЕНЦИИ</p></a>
                                                                <a href="mm=friends" class="new_local"><p>ДРУЗЬЯ</p></a>
                                                            </nav><nav id="content_search"></nav><section id="content_block">',
                                        'tmp' => '<article class="people_article" id="%n[0]">
                                                    <div class="people_avatar" style="background: no-repeat center url(upload_image/avatars/pre_50px/%n[1].jpg); background-size: cover;">
                                                    </div>
                                                    <div class="peaple_cat">
                                                        <div class="people_status" style="background: #636363 no-repeat center url(img/system_icon/status/%n[3].png);background-size: contain;"></div>
                                                        <div class="people_status" style="background: #ff5300 no-repeat center url(img/user_icon/%n[4].png);background-size: contain;"></div>
                                                    </div>
                                                    <div class="pp">
                                                        <a class="new_local" href="pl=%n[0]">
                                                            <p class="people_title">%n[2]</p>
                                                        </a>
                                                        <div class="p_in">
                                                            %n[5]
                                                        <div>
                                                    </div>
                                                </article>',
                                        'footer' => '</section><script defer src="js/blocks/mm.js"></script>')+$res;
            }
            $i++;
            array_push($arr,$res);
        }
        foreach ($friends as $array){
            $image = (file_exists('../upload_image/avatars/pre_50px/'.$array['avatar'].'.jpg')) ? $array['avatar'] : 'default';
            $res = array(
                    'n0' => ($array['user_other'] === $user_id) ? $array['user_pioneer'] : $array['user_other'],
                    'n1' => $image,
                    'n2' => $array['nickname'],
                    'n3' => $array['online'],
                    'n4' => $array['category'],
                    'n5' => ''
                );
            if(!$i) {
                        $res = array(
                                    'head' => '<nav id="content_menu"> 
                                                                <a href="mm=dialogs" class="new_local"><p>ДИАЛОГИ</p></a>
                                                                <a href="mm=conference" class="new_local"><p>КОНФЕРЕНЦИИ</p></a>
                                                                <a href="mm=friends" class="new_local"><p>ДРУЗЬЯ</p></a>
                                                            </nav><nav id="content_search"></nav><section id="content_block">',
                                        'tmp' => '<article class="people_article" id="%n[0]">
                                                    <div class="people_avatar" style="background: no-repeat center url(upload_image/avatars/pre_50px/%n[1].jpg); background-size: cover;">
                                                    </div>
                                                    <div class="peaple_cat">
                                                        <div class="people_status" style="background: #636363 no-repeat center url(img/system_icon/status/%n[3].png);background-size: contain;"></div>
                                                        <div class="people_status" style="background: #ff5300 no-repeat center url(img/user_icon/%n[4].png);background-size: contain;"></div>
                                                    </div>
                                                    <div class="pp">
                                                        <a class="new_local" href="pl=%n[0]">
                                                            <p class="people_title">%n[2]</p>
                                                        </a>
                                                        <div class="p_in">
                                                            %n[5]
                                                        <div>
                                                    </div>
                                                </article>',
                                        'footer' => '</section><script defer src="js/blocks/mm.js"></script>')+$res;
            }
            $i++;
            array_push($arr,$res);
        }
            
    }
    else {
        $res = array(
            'head' => '<nav id="content_menu"> 
                                        <a href="mm=dialogs" class="new_local"><p>ДИАЛОГИ</p></a>
                                        <a href="mm=conference" class="new_local"><p>КОНФЕРЕНЦИИ</p></a>
                                        <a href="mm=friends" class="new_local"><p>ДРУЗЬЯ</p></a>
                                    </nav><div id="material_null">
                                <p>В списке никого нет, <a href="pe" class="new_local">попробуйте найти друзей здесь.</a></p>
                            </div>'
        );
        array_push($arr,$res);
    }

}
else {
        $res = array(
        'head' => '<div id="material_null">
                            <p>Для просмотра этой страницы пройдите регистрацию или авторизацию</p>
                        </div>'
    );
    array_push($arr,$res);
}
print json_encode($arr);