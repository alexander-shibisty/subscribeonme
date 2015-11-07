$(function(){
	
	$('#admin_information').click(function(){
			
			if ($('#admin_information').text() == "Открыть информацию") {
			
				$('#admin_information').text('Скрыть информацию');
			
			}
			
			else {
			
				$('#admin_information').text('Открыть информацию');
				
			}
			
			if($('#information_list').length == 0) {
			
				$.post("blocks/pages/header.php",function(data){
			
					$('header').html(data);
				
					$('#information_list').animate({height: 'toggle'}, 100);
					
				
				});
			
			}
			
			else {
					
					$('#information_list').remove();
				
			}
			
	});
})