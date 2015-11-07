<?php    
    $arr = array();
    $res = array(
        'head' => '<nav id="content_menu"> 
                            <a href="au=all" class="new_local"><p>ВСЕ</p></a>
                    </nav>
                    <section id="content_search">
                    </section>
                     <section id="content_block">
                        <article class="audio_ar">
                            <div class="audio_ar_play">
                            </div>
                            <p>Исполнитель - Название</p>
                            <div class="audio_ar_timeline">
                            </div>
                            <div class="audio_ar_volue">
                            </div>
                        </article>
                    </section>
                    <div id="material_null">
                        <p>ПЛЕЕР РАБОТАЕТ В ТЕСТОВОМ РЕЖИМЕ</p>
                    </div><script defer src="js/blocks/au.js"></script>'
    );
    array_push($arr,$res);
    print json_encode($arr);
