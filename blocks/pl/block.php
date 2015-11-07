<?php
require '../php/main/db_connect.php';
$arr = array();
    
if($user_id) {
    $id = ($user_id == $category || $category == '') ? $user_id : $category;
}
else {
    $o = new SafeMySQL;
    $id = $category;
}

if ($id) {
    $y = $o->getRow("SELECT nickname, avatar FROM users_information WHERE user_id=?i",$id);	
    $i = (file_exists('../upload_image/avatars/'.$y['avatar'].'.jpg')) ? $y['avatar'] : 'default';
    $i_min = (file_exists('../upload_image/avatars/pre_150px/'.$y['avatar'].'.jpg')) ? $y['avatar'] : 'default';
    $res = array(
        'head' => '<section id="user_information" style="background: #000 no-repeat center url(upload_image/avatars/'.$i.'.jpg);background-size:cover;">
                            <div id="user_avatar" style="background: #000 no-repeat center url(upload_image/avatars/pre_150px/'.$i_min.'.jpg);">
                                <div id="user_nickname">
                                    <p>'.$y['nickname'].'</p>
                                </div>
                            </div>
                        </section>
                        <nav id="content_menu">
                            <a href="pl='.$id.'&cat=all" class="new_local"><p>ПРОФИЛЬ</p></a>
                            <a href="pl='.$id.'&cat=content" class="new_local"><p>КОНТЕНТ</p></a>
                            <a href="pl='.$id.'&cat=community" class="new_local"><p>СООБЩЕСТВА</p></a>
                            '.(($user_id == $id) ? '<a href="pl='.$id.'&cat=settings" class="new_local"><p>НАСТРОЙКА</p></a>' : '').'
                            <div id="lookatme">
                                <div class="lookatme"></div>
                                <div class="lookatme"></div>
                                <div class="lookatme"></div>
                            </div>
                        </nav>'
    );
    array_push($arr,$res);
}
else {
        $res = array(
            'head' => '<div id="none"><p>Для просмотра этой страницы пройдите регистрацию или авторизацию</p><div>'
        );
        array_push($arr,$res);
}
print json_encode($arr);

/*
$query = "SELECT id_ad, title, text, image FROM ad ORDER BY id_ad DESC LIMIT 0,4";
$x = $o->getRow($query);
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