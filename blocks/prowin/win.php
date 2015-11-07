<!--Audio-->
<section id="audio_player">
    <audio id="audio" src="upload_audio/1.mp3"></audio>
    <div id="player_bar">
        <div id="player_buttom" onClick="PlayPauseVideo()">
            <div id="player_play_buttom">
            </div>
            <div id="player_pause_buttom" class="player_button">
            </div>
        </div>
        <div id="player_vol">
                 <div id="player_vol_prg">
                    <div id="vol_buttom">
                    </div>
                </div>
                <input type="range" id="vol" onmousedown="audiovol()" onmouseup="volsafe()" onmousemove="audiovol()" />
        </div>
        <div id="player_close">
        </div>
        <div id="player_modal">
        </div>
        </div>
        <div id="player_body">
                <div id="player_waveform">
                    <input type="range" id="ratio" onMouseDown="clearAnimateRange()" onMouseUp="movedRange()" />
                    <div id="player_waveform_progress">
                    </div>
                </div>
        </div>
        <div id="player_can">
                <div id="eq_bord">
                    <div id="player_title_bar">
                        <p id="player_title">Исполнитель - Название</p>
                        <p id="player_time"></p>
                    </div>
                    <canvas id="equalizer_analyzer">
                    </canvas>
                </div>
        </div>
        <div id="list">
                <div id="player_list">
                    <div class="player_list" id="1">
                        <p class="player_title">Исполнитель - Название</p>
                        <p class="player_time">00:00</p>
                        <source src="upload_audio/1.mp3">
                    </div>
                </div>
        </div>
</section>
<?php
if(isset($user_id)) {
?>
<!--Avatar Upload-->
<div id="up" ondragover="return false">
    	<p>Перетащите файл в эту область!</p>
           <input type="file" id="uploadbtn"/>
        <div id="img_container">
            <div id="pre_hiden">
            </div>
            <div id="loadbar_box">
                <div id="loadbar_plane">
                    <div id="loadbar_progress_plane">
                    </div>
                </div>
            </div> 
            <div id="startupload">
                <button title="Пути назад не будет!">ГОТОВО</button>
            </div>
        </div>
</div>
<?php
        $string_object = new SafeMySQL();
        $o = $string_object->getOne('SELECT avatar FROM users_information WHERE user_id=?i',$user_id);
        $i = (file_exists('upload_image/avatars/pre_50px/'.$o.'.jpg')) ? $o : 'default';
        $online = $string_object->getOne('SELECT online FROM users_online WHERE user_id=?i',$user_id);
        $rating = $string_object->getOne('SELECT rating FROM users_rating WHERE user_id=?i',$user_id);
        $lvl = floor($rating/100);
        $xp = floor($rating%100);
        $prifile_ui = json_decode(file_get_contents('json/ui/ru/main/main_login.json'),true);
?>
    <section id="profile_info">
            <div id="profile_avatar_upload">
                <button class="profile_avatar_upload"></button>
                <button class="profile_avatar_upload" id="avatar_upload"></button>
                <button class="profile_avatar_upload"></button>
                <button class="profile_co" id="profile_close"></button>
            </div>
            <div id="profile_avatar" style="background: #000 url('upload_image/avatars/pre_150px/<?php print($i); ?>.jpg') no-repeat center;background-size: contain;">
            </div>
        <div id="profile_rating">
                <nav id="user_action">
                    <button  class="<?php $on = ($online !== 'offline' && $online !== 'busy')? 'user_action user_action_tr' : 'user_action'; print($on); ?>" id="online" style="background: #fff no-repeat center url('img/system_icon/status/online_p.png')">
                    </button>
                    <button  class="<?php $off  = ($online === 'offline' || $online === 'busy') ? 'user_action user_action_tr' : 'user_action'; print($off ); ?>" id="offline" style="background: #fff no-repeat center url('img/system_icon/status/spy_p.png')">
                    </button>
                    <button id="exit"></button>
                </nav>
          	<div id="profile_rating_bar">
                    <?php print($lvl); ?><sup style="font-size:8px;">lvl</sup>
                <div id="profile_rating_bar_progres">
                    <div id="profile_rating_bar_progres_bac" style="width:<?php print($xp); ?>%;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <nav id="profile_menu">
        <a href="pl" class="new_local"><div class="profile_menu_button">
                    <div id="profile_menu_button_icon" style="background-position:-180px;">
                    </div>
                    <p><?php print($prifile_ui['profile_menu']['profile']); ?></p>
        </div></a>
    	<div id="profile_menu_metr">0</div>
       	<a href="mm" class="new_local"><div class="profile_menu_button">
                    <div id="profile_menu_button_icon" style="background-position:0px;">		
                    </div>
                    <p><?php print($prifile_ui['profile_menu']['message']); ?></p>
        </div></a>
        <a href="mi" class="new_local"><div class="profile_menu_button">
                    <div id="profile_menu_button_icon" style="background-position:-150px;">
                    </div>
                    <p><?php print($prifile_ui['profile_menu']['image']); ?></p>
        </div></a>
        <a href="mu" class="new_local"><div class="profile_menu_button">
                    <div id="profile_menu_button_icon" style="background-position:-120px;">	
                    </div>
                    <p><?php print($prifile_ui['profile_menu']['audio']); ?></p>
        </div></a>
        <a href="mv" class="new_local"><div class="profile_menu_button">
                    <div id="profile_menu_button_icon" style="background-position:-90px;">	
                    </div>
                    <p><?php print($prifile_ui['profile_menu']['video']); ?></p>
        </div></a>
        <a href="ma" class="new_local"><div class="profile_menu_button">
                    <div id="profile_menu_button_icon" style="background-position:-60px;">	
                    </div>
                    <p><?php print($prifile_ui['profile_menu']['article']); ?></p>
        </div></a>
        <a href="ml" class="new_local"><div class="profile_menu_button">
                    <div id="profile_menu_button_icon" style="background-position:-30px;">	
                    </div>
                    <p><?php print($prifile_ui['profile_menu']['leterature']); ?></p>
        </div></a>
        <nav id="wdng_rollup">
        </nav>
    </nav>
<?php
} 
else {
?>
            <div class="profile_co" id="profile_close">
            </div>
            <section id="login_and_registration">
                <button class="login"><div class="l_radial"></div>Войти</button>
                <button class="registration"><div class="l_radial"></div>Зарегистрироваться</button>
            </section>
            <section id="login">
                <form action="#">
                    <input id="login_email_input" type="text"/>
                    <input id="login_password_input" type="password"/>
                    <button id="login_button">ОТПРАВИТЬ</button>  
                </form>
            </section>
            <section id="registration">
                <form action="#" autocomplete="false">
                    <input id="registration_email_input" type="text"/>
                    <input id="registration_login_input" type="text"/>
                    <input id="registration_password_input" type="password"/>
                    <input id="registration_password_repeat_input" type="password"/>
                    <div id="registration_category_input">
                    <span></span>
                    </div>
                    <div id="registration_category_select">
                        <div class="registration_category_select"><span class="review">Обзорщик</span></div>
                        <div class="registration_category_select"><span class="letsplay">Летсплеер</span></div>
                        <div class="registration_category_select"><span class="vloger">Видеоблогер</span></div>
                        <div class="registration_category_select"><span class="motiondesign">Моушен-дизайнер</span></div>
                        <div class="registration_category_select"><span class="user">Пользователь</span></div>
                    </div>
                    <p>Я ОЗНАКОМИЛСЯ(ОЗНАКОМИЛАСЬ) С <a href="rs" class="new_local"><span class="span" style="cursor:pointer;"></span></a></p>
                    <div id="registration_rules_input">
                    </div>
                    <button id="registration_button">ОТПРАВИТЬ</button>
                </form>
            </section>
<?php
}