<?php
require '../php/main/SafeMySQL.php';
$string_object = new SafeMySQL();
if($category === 'all' || !$category) {
    $query = $string_object->getAll("SELECT u.user_id, u.avatar, u.nickname, u.category, o.online FROM users_information u, users_online o WHERE o.user_id = u.user_id  ORDER BY user_id DESC LIMIT 0,10");
}
else {
    $query= $string_object->getAll("SELECT u.user_id, u.avatar, u.nickname, u.category, o.online FROM users_information u, users_online o WHERE o.user_id = u.user_id AND u.category=?s ORDER BY user_id DESC LIMIT 0,10",$category);
}

$arr = array();
$i = 0;
foreach($query as $array) {
    $image = (file_exists('../upload_image/avatars/pre_50px/'.$array['avatar'].'.jpg')) ? $array['avatar'] : 'default';
    $res = array(
        'n0' => $array['user_id'],
        'n1' => $image,
        'n2' => $array['nickname'],
        'n3' => $array['online'],
        'n4' => $array['category'],
        'n5' => 'Null'
    );
    if(!$i) {
            $res = array(
                'head' => '<nav id="content_menu">
                                    <a href="pe=all" class="new_local"><p>ВСЕ</p></a>
                                    <a href="pe=user" class="new_local"><p>ПОЛЬЗОВАТЕЛИ</p></a>
                                    <a href="pe=motiondesign" class="new_local"><p>МОУШЕН-ДИЗАЙНЕРЫ</p></a>
                                    <a href="pe=review" class="new_local"><p>ОБОЗРЕВАТЕЛИ</p></a>
                                    <a href="pe=letsplay" class="new_local"><p>ЛЕТСПЛЕЕРЫ</p></a>
                                </nav>
                                <nav id="content_search">
                                    <button class="content_search">
                                        Город
                                    </button>
                                    <button class="content_search">
                                        Пол
                                    </button>
                                    <button class="content_search">
                                        Возраст
                                    </button>
                                    <button class="content_search">
                                        Род деятельности
                                    </button>
                                </nav>
                                <section id="content_block">',
                'tmp' => '<article class="people_article" id="%n[0]">
                                    <div class="people_avatar" style="background: no-repeat center url(upload_image/avatars/pre_50px/%n[1].jpg); background-size: cover;">
                                    </div>
                                    <div class="peaple_cat">
                                        <div class="people_status" style="background: #cecece no-repeat center url(img/system_icon/status/%n[3].png);background-size: contain;"></div>
                                        <div class="people_status" style="background: #ff8441 no-repeat center url(img/user_icon/%n[4].png);background-size: contain;"></div>
                                    </div>
                                    <div class="pp">
                                        <a class="new_local" href="pl=%n[0]">
                                            <p class="people_title">%n[2]</p>
                                        </a>
                                        <div class="p_in">
                                            <p class="p_info">%n[5]</p>
                                            <button class="friend_button">В друзья</button>
                                            <button class="subscribe_button">Подписаться</button>
                                            <button class="message_button">Написать</button>
                                        <div>
                                    </div>
                                </article>',
                'footer' => '</section><script defer src="js/blocks/pe.js"></script>'
            )+$res;
    }
        $i++;
        array_push($arr,$res);
    }
    unset($array);
    print json_encode($arr);