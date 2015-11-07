<?php
require '../php/main/SafeMySQL.php';
    $o = new SafeMySQL();
    $base = $o->getAll('SELECT id,title FROM base_games LIMIT 0,10');
    $arr = array();
    $i = 0;
    foreach ($base as $array) {
        $res = array (
            'n0' => $array['id'],
            'n1' => $array['title']
        );
        if(!$i) {
                $res = array(
                'head' => '<nav id="content_menu">
                                    <a href="be=games" class="new_local"><p>ИГРЫ</p></a>
                            </nav><nav id="content_search"></nav><section id="content_block">',
                    'tmp' => '<article id="%n[0]" class="game">
                        <div class="game_img"></div>
                        <h4>%n[1]</h4>
                    </article>',
                    'footer' => '</section>'
            )+$res;
        }
        $i++;
        array_push($arr,$res);
    }
    unset($array);
    print json_encode($arr);