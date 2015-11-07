<?php
require '../php/main/SafeMySQL.php';
if($last_id && $page) {
    $string_object = new SafeMySQL();
    if($category === 'all' || !$category) {
        $o = $string_object->getAll("SELECT i.v_id, i.user_id, i.title, i.image, i.date, u.nickname FROM posts_videos_in i, users_information u WHERE i.user_id = u.user_id AND i.v_id<?i ORDER BY i.v_id DESC LIMIT 0,10",$last_id);   
    }
    else {
        $o = $string_object->getAll("SELECT i.v_id, i.user_id, i.title, i.image, i.date, u.nickname FROM posts_videos_in i, users_information u WHERE i.user_id = u.user_id AND i.v_id<?i AND i.category=?s ORDER BY i.v_id DESC LIMIT 0,10",$last_id,$category);
    }
    $arr = array();
     $i = 0;
    foreach($o as $array) {
        $image = (file_exists('../upload_image/videos/pre_500px/'.$array['image'].'.jpg')) ? $array['image'] : 'default';
        $res = array(
                'n0' => $array['v_id'],
                'n1' => $image,
                'n2' => $array['title'],
                'n3' => $array['date'],
                'n4' =>  $array['nickname']
        );
        array_push($arr,$res);
        $i++;
    }
    unset($array);
    print json_encode($arr);
}