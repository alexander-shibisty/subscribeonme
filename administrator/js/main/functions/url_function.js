function url_event (url) {
	
	var url_href = location.search;
	
		if (url_href != url && url != '?index') {
		
			window.history.pushState('', '', 'http://nklsite/administrator/index' + url);
			window.history.replaceState('', '', 'http://nklsite/administrator/index' + url);
	
		}
		
		else if (url == '?index') {
			
			window.history.pushState('', '', 'http://nklsite/administrator/index');
			window.history.replaceState('', '', 'http://nklsite/administrator/index');
		
		}
	
}