<?php
require '../php/main/db_connect.php';
if($last_id && $page && $user_id) {
    $string_object = new SafeMySQL();
    $o = $string_object->getAll("SELECT v_id, user_id, title, image, date FROM posts_videos_in WHERE user_id=?i AND v_id<?i ORDER BY v_id DESC LIMIT 0,10",$user_id,$last_id);   
    $arr = array();
    $i = 0;
    foreach($o as $array) {
        $image = (file_exists('../upload_image/videos/pre_500px/'.$array['image'].'.jpg')) ? $array['image'] : 'default';
        $res = array(
                'n0' => $array['v_id'],
                'n1' => $image,
                'n2' => $array['title'],
                'n3' => $array['date']
        );
        array_push($arr,$res);
        $i++;
    }
    print json_encode($arr);
    unset($array);
}