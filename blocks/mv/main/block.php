<?php
require '../php/main/db_connect.php';
$arr = array();
if(isset($user_id)) {

        $query = $o->getAll("SELECT p.v_id,i.image,i.title,i.date FROM posts_videos p, posts_videos_in i WHERE i.user_id=?i AND i.v_id = p.v_id ORDER BY p.v_id DESC LIMIT 0,10",$user_id);
        if($query) {
                $i = 0;
		foreach($query as $array) {
                    $image = (file_exists('../upload_image/videos/pre_500px/'.$array['image'].'.jpg')?$array['image']:'default');
                    $res = array(
                        'n0' => $array['v_id'],
                        'n1' => $image,
                        'n2' => $array['title'],
                        'n3' => $array['date']);
                    if(!$i) {
                        $res = array(
                            'head' => '<nav id="content_menu">
                                    <a href="mv=my" class="new_local"><p>МОИ ВИДЕО</p></a>
                                    <a href="mv=bookmarks" class="new_local"><p>ИЗБРАННОЕ</p></a>
                                    <a href="mv=upload" class="new_local"><p>ЗАГРУЗИТЬ</p></a>
                                </nav>
                                <nav id="content_search">
                                </nav><section id="content_block">',
                            'tmp' => '<a href="mv&video=%n[0]" class="new_modal"><article class="video" id="%n[0]" style="background: #000 no-repeat center url(upload_image/videos/pre_500px/%n[1].jpg)">
                                        <div class="video_title">
                                            <p>%n[2]</p>
                                        </div>
                                        <div class="video_information">
                                            <p style="float:right;">%n[3]</p>
                                        </div>
                                        <div class="video_icon"></div>
                                    </article></a>',
                            'footer' => '</section>')+$res;
                    }
                    $i++;
                    array_push($arr,$res);
		}
                unset($array);
        }
        else {
            $res = array(
                'head' => '<nav id="content_menu">
                    <a href="mv=my" class="new_local"><p>МОИ ВИДЕО</p></a>
                    <a href="mv=bookmarks" class="new_local"><p>ИЗБРАННОЕ</p></a>
                    <a href="mv=upload" class="new_local"><p>ЗАГРУЗИТЬ</p></a>
                </nav>
                <div id="material_null">
                    <p>МАТЕРИАЛОВ НЕТ</p>
                </div>'
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