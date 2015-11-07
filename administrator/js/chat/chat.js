$(function(){
	
	//setInterval('alert("прошла секунда")', 1000)

	$('#chat_panel').click(function(){

		if($('#chat_panel img').attr('src') == 'img/pre_arrow.png') {
			
			$('#chat_panel').html('<img src="img/pre_arrow_180.png" />');
		
		}
		
		else {
		
			$('#chat_panel').html('<img src="img/pre_arrow.png" />');	
		
		}
		
		$('#chat_window').animate({height: 'toggle'});
		
		$('#chat_window textarea').focus();
	
	});
	
	$('#chat_window textarea').keypress(function(e){
	     	   
			   if(e.keyCode==13){
				   
					var chat_text = $('#chat_window textarea').val();
	     	   	
				$.ajax({
					type: 'POST',
					url:"php/chat/chat.php",
					dataType:"json",
					data:
					{
						chat_text: chat_text,	
					},
					success:function(data){
					
						$('#admin_chat_message').prepend('<article><b>' + data.name + ':</b>' + chat_text + '</article>');
					
					}
				});
				
				$('#chat_window textarea').val('').focus();
	     	   
			   }
	});
	
})