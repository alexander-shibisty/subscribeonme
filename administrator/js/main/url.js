$(function(){
	
	$('#menu ul li').click(function(){
		
		url_event('?' + this.id);
		
	});
	
	setInterval(function () {
	
	var url_addess = location.search;
	
	var url_regular = /^(\?((\w){0,10}))?(\?((\w){0,10}))?$/;
	
	var url_test = url_addess.match(url_regular);
	
		if (url_test[0] == '') {

				$('#horizont_menu').html("dsdsadsadasds");
			
		}
	
		else if(url_test[2] != '') {

				if($('#horizont_menu #base_menu').length == 0) {
				
					$.post("blocks/horizont_menu/" + url_test[2] + ".php",function(data){
			
						$('#horizont_menu').html(data);
					
					});	

				}
				
		}
		
				if (url_test[5] == '') {

				$('#contents').html("dsdsadsadasds");
			
				}
		
				else if(url_test[5] != '') {
							
								
							$.post("blocks/contents/" + url_test[5] + ".php", function(data){
											
											$('#contents').html(data);
											
											});
							
				}
	
	}, 100);

})