<?php
require '../php/main/SafeMySQL.php';
    $string_object = new SafeMySQL();
    if($category === 'all' || !$category) {
        $query = $string_object->getAll("SELECT i.v_id, i.user_id, i.title, i.image, i.date, u.nickname FROM posts_videos_in i, users_information u WHERE i.user_id = u.user_id ORDER BY i.v_id DESC LIMIT 0,10");
    }
    else {
        $query = $string_object->getAll("SELECT i.v_id, i.user_id, i.title, i.image, i.date, u.nickname FROM posts_videos_in i, users_information u WHERE i.category=?s AND i.user_id = u.user_id ORDER BY i.v_id DESC LIMIT 0,10",$category);
    }
    $arr = array();
    $i = 0;
    foreach($query as $array) {
        $image = (file_exists('../upload_image/videos/pre_500px/'.$array['image'].'.jpg')) ? $array['image'] : 'default';
        $link  = ($category) ? $page.'='.$category.'&video='.$array['v_id'] : $page.'&video='.$array['v_id'];
        $res = array(
                'n0' => $array['v_id'],
                'n1' => $image,
                'n2' => $array['title'],
                'n3' => $array['date'],
                'n4' => $array['nickname']
        );
        if(!$i) {
            $res = array(
                'head' => '<nav id="content_menu">
                    <a href="vo=all" class="new_local"><p>ВСЕ</p></a>
                    <a href="vo=review" class="new_local"><p>ОБЗОРЫ</p></a>
                    <a href="vo=letsplay" class="new_local"><p>ЛЕТСПЛЕИ</p></a>
                    <a href="vo=vlog" class="new_local"><p>БЛОГИ</p></a>
                    <div id="lookatme">
                                    <div class="lookatme"></div>
                                    <div class="lookatme"></div>
                                    <div class="lookatme"></div>
                    </div>
                </nav>
                <nav id="content_search"></nav><section id="content_block">',
                 'tmp' => '<a href="vo&video=%n[0]" class="new_modal">
                <article class="video" id="%n[0]" style="background:#000 no-repeat center url(upload_image/videos/pre_500px/%n[1].jpg)">
                    <div class="video_title">
                        <p>%n[2]</p>
                    </div>
                    <div class="video_information">
                        <p style="float:left;">%n[4]</p>
                        <p style="float:right;">%n[3]</p>
                    </div>
                    <div class="video_icon"></div>
                </article></a>',
                'footer' => '</section>'
            )+$res;
        }
        array_push($arr,$res);
        $i++;
    }
    //print($_SERVER['REQUEST_URI']);
    print json_encode($arr);
    unset($array);