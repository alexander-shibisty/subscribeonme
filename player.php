<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
<style>

#player_size {
	bottom:0px;
	top:0px;
	left:0px;
	right:0px;
	position:fixed;
	background:#000;
	padding:0px;
}

video {
	position:fixed;
}

</style>
<script src="js/library/jQuery.js"></script>
<script>
$(function(){
	
	var player_window_width = $('#player_size').width();
	var player_window_height = $('#player_size').height();
	
	$('video').css({'width':player_window_width, 'height':player_window_height});
	
});
</script>
</head>

<body>
<section id="player_size">
    <video controls src="upload_video/eminem.mp4">
    </video>
</section>
</body>
</html>