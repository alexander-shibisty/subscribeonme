<?php
require '../php/main/db_connect.php';
$string_object = new SafeMySQL();
if($user_id) {
    $arr = array();
    $res = array(
        'head' => '<nav id="content_menu">
                            <a href="hm=subscribes" class="new_local"><p>ПОДПИСКИ</p></a>
                            <a href="hm=news" class="new_local"><p>НОВОСТИ</p></a>
                            </nav><div id="material_null">
                                    <p>МАТЕРИАЛОВ НЕТ</p>
                            </div>'
    );
    array_push($arr,$res);
    print json_encode($arr);
}
else {
    $query = $string_object->getAll("SELECT v_id, image, title FROM posts_videos_in ORDER BY v_id DESC LIMIT 0,9");
    $arr = array();
    $i = 0;
    foreach($query as $array) {
        $image = (file_exists('../upload_image/videos/pre_500px/'.$array['image'].'.jpg')) ? $array['image'] : 'default';
        $res = array(
            'n0' => $array['v_id'],
            'n1' => $image,
            'n2' => $array['text'],
            'n3' => $array['title'],
        );
        if(!$i) {
            $res = array(
                'head' => '<section id="main_news">',
                'tmp' => '<a href="hm&video=%n[0]" class="new_local"><article class="main_news" style="background: no-repeat center url(upload_image/videos/pre_500px/%n[1].jpg)">
                    <div class="main_news_information">
                    <p>%n[2]</p>
                    </div>
                    <div class="main_title">
                    <p>%n[3]</p>
                    </div>
                    <div class="main_icon" style="background:#000 url(../../img/post_icon/video.png) no-repeat center;">
                    </div>
                </article></a>',
                'footer' => '</section><section id="information_block">
                                    <p>Pulsar — полностью настраиваемое социальное Web-приложение с хорошо структурированной информационной базой, заточенное под ваше творчество и ваши интересы. Pulsar — место, где каждый профиль уникален как и его владелец, а развитие профиля не заканчивается на заполнении форм "Деятельность" и "Интересы". Это единственное место в интернете, где за каждое проявление вы гарантированно получите вознаграждение в виде повышения уровня, подарков и скидок на покупки. Работы еще много, и если вы разделяете наши взгляды и также считаете, что интернет — свободная площадка, где ваш профиль должен быть таким, как вы захотите, где нет места нападкам правообладателей, где можно скрыть свое присутствие и послушать любимую музыку, или все время оставаться анонимным — просим вас поддержать в будущем команду сайта на BOOMSTARTER. Мы стремимся изменить понятия терминов "Сайт", "Социальная сеть" и "Web-приложение".</p>
                                </section>'
            )+$res;
        }
        $i++;
        array_push($arr,$res);
    }
    print json_encode($arr);
    unset($array);

    //$query = "SELECT id_m FROM magazin ORDER BY id_m DESC LIMIT 0,4";
    //$x = $string_object->getRow($query);
    //$x=false;
    /*if($x){
    print('<section id="magazin_block">');
        foreach($x as $array) {
            print('<article class="magazin_block" style="background: center no-repeat url(../../upload_image/ad/8YHEaY4zdbU.jpg);">
                <div class="magazin_title">
                <p>Восьмая дверь</p>
                </div>
                <div class="magazin_price">
                <p>70₴</p>
                </div>
                <div class="magazin_icon" style="background:#000 url(../../img/main/music_ico.png) no-repeat center;">
                </div>
                <div class="magazin_icon_bay">
                </div>
            </article>');							
        }				
        print('</section>');
    }*/
}