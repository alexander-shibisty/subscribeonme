<?php
require '../php/main/db_connect.php';
$get_var = filter_input(INPUT_POST, 'get_first_var');
$arr = array();
if(empty($user_id)) {//Вывод профиля для не вошедшего пользователя
    $string_object = new SafeMySQL();
    $y = $string_object->getRow("SELECT nickname, avatar FROM users_information WHERE user_id=?i",$get_var);
    if($y) {		
        $i = (file_exists('../upload_image/avatars/'.$y['avatar'].'.jpg')) ? $y['avatar'] : 'default';
        $res = array(
            'head' => '<section id="user_profile">
                            <section id="user_information" style="background: #000 no-repeat center url(upload_image/avatars/'.$i.'.jpg);">
                            <div id="user_nickname">
                            <p>'.$y['nickname'].'</p>
                            </div>
                                <nav id="user_buttom">
                                <div class="user_buttom"><p>ПОДПИСЧИКИ</p><div id="sub_meter"><p>0</p></div></div>
                                <div class="user_buttom">
                                <div id="user_lvl">
                                <p>0</p>
                                <div>
                                <div id="user_progress">
                                <div id="user_progress_r">
                                </div>
                                <p>LVL</p>
                                </div>
                                </div>
                                </nav>
                            </section>
                            <section>
                            <nav id="content_menu">
                                <a href="pl&cat=all" class="new_local"><p>ПРОФИЛЬ</p></a>
                                <a href="pl&cat=content" class="new_local"><p>КОНТЕНТ</p></a>
                                <a href="pl&cat=community" class="new_local"><p>СООБЩЕСТВА</p></a>
                                <a href="pl&cat=rating" class="new_local"><p>РЕЙТИНГ</p></a>
                            </nav>'
        );
        array_push($arr,$res);
    }
}
else if($get_var == '' or $get_var === $user_id) {//Вывод профиля вошедшего пользователя
    $string_object = new SafeMySQL();
    $y = $string_object->getRow("SELECT nickname, avatar FROM users_information WHERE user_id=?i",$user_id);	
    $i = (file_exists('../upload_image/avatars/'.$y['avatar'].'.jpg')) ? $y['avatar'] : 'default';
    $res = array(
        'head' => '<section id="user_information" style="background: #000 no-repeat center url(upload_image/avatars/'.$i.'.jpg);">
                            <div id="user_nickname">
                            <p>'.$y['nickname'].'</p>
                            </div>
                            </section>
                        <nav id="content_menu">
                            <a href="pl&cat=all" class="new_local"><p>ПРОФИЛЬ</p></a>
                            <a href="pl&cat=content" class="new_local"><p>КОНТЕНТ</p></a>
                            <a href="pl&cat=comunity" class="new_local"><p>СООБЩЕСТВА</p></a>
                            <a href="pl&cat=rating" class="new_local"><p>РЕЙТИНГ</p></a>
                        </nav>'
    );
    array_push($arr,$res);
}
else if($get_var !== $user_id) {//Вывод профиля другого пользователя
    $string_object = new SafeMySQL();
    $y = $string_object->getRow($query = "SELECT nickname, avatar FROM users_information WHERE user_id=?i",$get_var);
        if($y) {
            $i = (file_exists('../upload_image/avatars/'.$y['avatar'].'.jpg')) ? $y['avatar'] : 'default';
            $res = array(
                'head' => '<section id="user_profile">
                                <section id="user_information" style="background: #000 no-repeat center url(upload_image/avatars/'.$i.'.jpg);">
                                <div id="user_nickname">
                                <p>'.$y['nickname'].'</p>
                                </div>
                                <nav id="user_buttom">
                                <div class="user_buttom"><p>НАПИСАТЬ СООБЩЕНИЕ</p></div>
                                <div class="user_buttom"><p>ПОДПИСЧИКИ</p><div id="sub_meter"><p>0</p></div></div>
                                <div class="user_buttom">
                                <div id="user_lvl">
                                <p>0</p>
                                <div>
                                <div id="user_progress">
                                <div id="user_progress_r">
                                </div>
                                <p>LVL</p>
                                </div>
                                </div>
                                </nav>
                                </section>
                                <section id="modal_massage">
                                <textarea></textarea>
                                <button>ОТПРАВИТЬ</button>
                                </section>
                                <section>
                                <nav id="content_menu">
                                    <a href="pl&cat=all" class="new_local"><p>ПРОФИЛЬ</p></a>
                                    <a href="pl&cat=content" class="new_local"><p>КОНТЕНТ</p></a>
                                    <a href="pl&cat=comunity" class="new_local"><p>СООБЩЕСТВА</p></a>
                                    <a href="pl&cat=rating" class="new_local"><p>РЕЙТИНГ</p></a>
                                </nav>');
            array_push($arr,$res);
        }
}
    print json_encode($arr);

/*if(!$string_object) {
    $string_object = new SafeMySQL();
}
$query = "SELECT id_ad, title, text, image FROM ad ORDER BY id_ad DESC LIMIT 0,4";
$x = $string_object->getRow($query);
$x = false;
if($x) {//реклама
    print('<section id="ad_block">');
        foreach($x as $array) {
            foreach($array as $key => $string) {
                ${$key} = $string;
            }
            print('<article class="ad_block" style="background: center no-repeat url(upload_image/ad/8YHEaY4zdbU.jpg);">
                <div class="ad_title">
                <p>Горы</p>
                </div>
                <div class="ad_icon" class="magazin_icon" style="background:#000 url(../../img/main/music_ico.png) no-repeat center;">
                </div>
                </article>');
        }
    print('</section>');
}*/