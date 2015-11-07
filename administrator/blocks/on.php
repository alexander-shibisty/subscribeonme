<?php

require 'blocks/main/header.php';

?>
			<title>Главная - Панель администратора</title>
			<script src="js/main/header.js"></script>
            <script src="js/main/url.js"></script>
            <script src="js/chat/chat.js"></script>
            <script src="js/main/functions/url_function.js"></script>
		</head>

		<body>
        
        <div id="all">
        <noscript><p style="color:#F30;">Для корректной работы сайта нужен JavaScript</p></noscript>
        	<div id="admin_button">
        		<button id="admin_information">Открыть информацию</button>
        		<button id="admin_exit">Выйти</button>
        	</div>
        <header>
        </header>
		<?php

			require 'blocks/main/menu.php';

		?>
        
        <section id="main">
        
        	<section id="horizont_menu">
            
            </section>
            
            <section id="contents">
            
            </section>
        
       	</section>
        
        <?php
        
			require 'blocks/main/footer.php';
		
        ?>
        </div>    
            
		</body>
        
	</html>