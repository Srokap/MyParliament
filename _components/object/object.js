function download_btn_click( doc_id ){
	document.location="http://sejmometr.pl/doc/" + doc_id;
}

function _fix_object_layout(){
	
	var md = $$('._obj_main_div_a');
	var sd = $$('._obj_side_div_a');
	
	if( md && sd ) {
		
		md = md.first();
		sd = sd.first();
		
		if( md && sd ) {
			
			var mh = md.getHeight();
			var sh = sd.getHeight();
			
			if( sh<mh )
			  sd.setStyle({minHeight: mh+'px'});
			
		}
		
	}	
	
}

_fix_object_layout();
$M.addInitCallback( _fix_object_layout );

