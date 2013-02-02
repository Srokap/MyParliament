var admin_editable_add;
$M.addInitCallback(function(){
  admin_editable_add = new AdminEditableAdd();
  observe_admin_editable();
  
  $$('.admin_div .info').invoke('observe', 'click', admin_info_click);
});


var admin_info_click = function( event ){
	
	var admin_div = event.findElement('.admin_div');
	
	var lb_div = new Element('div', {className: 'admin_lb_div'});
	$M.addLightboxShow(lb_div, {
		'title': 'Admin info',
		'width': 600,
		'height': 500
	});

	var base_alias = admin_div.readAttribute('base_alias');
	var className = 'ep_Druk';
	
	lb_div.update('<p class="title">To fill this dataset with data, code following scripts:</p><ul><li><p class="file">get_list</p><p class="path"><a target="_blank" href="/service/graber/' + base_alias + '/get_list">/_services/graber/' + base_alias + '/get_list.php</a></p><p class="desc">This script should return an array containg unique identifiers of objects in this dataset.</p></li><li><p class="file">get_item</p><p class="path"><a target="_blank" href="/service/graber/' + base_alias + '/get_item">/_services/graber/' + base_alias + '/get_item.php</a></p><p class="desc">This script gets a numeric id of an object in this dataset. It should download its data and put it in a database</p></li></ul><p class="title">You should also code following files:</p><ul><li><p class="file">' + className + '.tpl</p><p class="path">/_components/dataset_browser/smarty/list_item_classes/' + base_alias + '.tpl</p><p class="desc">This defines how objects will look like in a dataset browser</p></li><li><p class="file">' + className + '</p><p class="path">/_pages/_objects/' + className + '</p><p class="desc">This defines how object\'s page will look like</p></li></ul>');
	
}