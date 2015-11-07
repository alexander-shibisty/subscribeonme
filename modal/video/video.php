<?php
if($id && $category) {
    $string_object = new SafeMySQL();
    $o = $string_object->getRow('SELECT video FROM posts_videos WHERE v_id=?i',$id);
    
    preg_match("/(?:https?:\/\/)?(?:www\.)?((?:\w|-){1,50})\.(?:(?:\w|-\?\/){1,500})/", $o['video'], $result);	
    $parsing = mb_strtolower($result[1]);
    switch ($parsing) {
        case 'youtube':
        case 'youtu':
            preg_match("/^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((?:\w|-){11}))(?:\S+)?$/", $o['video'], $video_result);
            print('<iframe src="//www.youtube.com/embed/'.$video_result[1].'?wmode=opaque" frameborder="0" allowfullscreen></iframe>
                   <nav id="modal_nav">
                        <button></button>
                        <button></button>
                        <button></button>
                        <button></button>
                   </nav>
                   <section id="modal_in"></section>
                   <section id="modal_comments"></section>
                   <div id="modal_str"></div>');
            break;
    }
}