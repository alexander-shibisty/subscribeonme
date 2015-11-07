<nav id="menu">
<ul>
<li><a href="../index">На сайт</a></li>
<li id="index"><a>Главная</a></li>
<li id="video"><a>Видео</a></li>
<li id="news"><a>Новость</a></li>
<li id="blog"><a>Блог</a></li>
<li id="base"><a>Базы</a></li>
<li id="peaple"><a>Люди</a></li>
<li id="ad"><a>Реклама</a></li>
<li id="ban"><a>Бан</a></li>
<li id="stream"><a>Стримы</a></li>
<li id="rulles"><a>Правила</a></li>
<li id="teh"><a>Тех.Поддержка</a></li>
<li id="forum"><a>Форум</a></li>
<li id="autor"><a>Блог авторов</a></li>
<li id="setting"><a>Настройки</a></li>
</ul>

<section id="admin_chat">
	<div id="chat_panel">
    <img src="img/pre_arrow.png" />
    </div>
	<div id="chat_window">
    	<section id="admin_chat_message">
    <?php
	
	$admin_chat_query = mysql_query("SELECT admin_id, text FROM admin_chat ORDER BY id DESC LIMIT 0,20");
	
	while($admin_chat_result = mysql_fetch_array($admin_chat_query)){
		
		$admin_chat_login = mysql_query("SELECT login FROM admin WHERE id='".$admin_chat_result['admin_id']."'");
		$admin_chat_login_result = mysql_fetch_array($admin_chat_login);
		
		print ('<article>
			<b>'.$admin_chat_login_result['login'].':</b>
			'.$admin_chat_result['text'].'		
		</article>');
	
	}
	?>
		</section>
	<textarea></textarea>
    </div>
</section>

</nav>