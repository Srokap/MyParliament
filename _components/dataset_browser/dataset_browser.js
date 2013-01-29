var DatasetBrowser = Class.create({
	
	initialize: function( div ){
		
		this._fv = false;
		this.div = $(div);
		if( !this.div )
		  return false;
		
		this.base_alias = this.div.readAttribute('base_alias');
		
		if( this.div.readAttribute('initw') )
		  this.init_wheres = this.div.readAttribute('initw').evalJSON();
		
		this.form = this.div.down('.s_browser_form');

		this.filters_div = this.div.down('.s_browser_filtry_ul_cont');
		this.filters_div.down('.filter_div.visible').addClassName('first');
		// this.filters_div.appear({duration: 1});

		if( this.filters_div ) {
		  this.activate_filter_divs();
		  this.activate_filters();
		}


	},
	
	activate_filter_divs: function(){
	
	  var filter_divs = this.filters_div.select('.filter_div');
	  for( var i=0; i<filter_divs.length; i++ ) {
		  
		  var filter_div = filter_divs[i];
		  filter_div.down('h2').observe('click', function(event){
			  this.on_filter_div_click( event.findElement('.filter_div') );
		  }.bind(this));
		  
	  }
		
	},
	
	on_filter_div_click: function( filter_div ){
	
	  if( filter_div.hasClassName('a') )
	    return false;
	  
		var ul = filter_div.down('.s_browser_filtry_ul');
		if( ul ) {
			
			if( filter_div.hasClassName('expanded') ) {
				
				filter_div.addClassName('a').removeClassName('expanded');
				ul.blindUp({duration: .3, afterFinish: this.on_filter_div_click_finish_animation.bind(this, filter_div)});
				
			} else {
				
				filter_div.addClassName('a').addClassName('expanded');
				ul.blindDown({duration: .3, afterFinish: this.on_filter_div_click_finish_animation.bind(this, filter_div)});
				
			}
			
		} 
	},
	
	on_filter_div_click_finish_animation: function(filter_div, state, event){
		
		filter_div.removeClassName('a');
		  
	},
	
	activate_filters: function(){
	  
	  var params = this.form.serialize( true );
	  delete params['o[]'];
	  // delete params['w[]'];
	  
	  
	  if( this.init_wheres ) {
		  
		  var w = $A();
		  
		  for( var i=0; i<this.init_wheres.length; i++ ) {
		    w.push( this.init_wheres[i][0] );
		    w.push( this.init_wheres[i][1] );
		    w.push( this.init_wheres[i][2] );
		  }
		  
		  
		  if( params['w[]'] )
			  for( var i=0; i<params['w[]'].length; i++ )
			    w.push( params['w[]'][i] );
		    
		  params['w[]'] = w;
		  
	  } 	  
	  
	  console.log(params);
	  
	  var fields = $A();
		var filter_lis = this.filters_div.select('.filter_li');
		
		for( var i=0; i<filter_lis.length; i++ )
			fields.push( filter_lis[i].readAttribute('field') );
			
		$S('datasets_browser/get_filters', {
			base_alias: this.base_alias,
			params: params,
			fields: fields
		}, this.on_get_filters.bind(this));
	},
	
	toHref: function(params){
		
		var parts = $A();
		for( key in params ) {
			
			var value = params[key];
			
			if( Object.isArray(value) ) {
		    for( var i=0; i<value.length; i++ )
		      if( key.endsWith('[]') )
		        parts.push( key+'='+escape(value[i]) );
		      else
		        parts.push( key+'[]='+escape(value[i]) );
		        
			} else parts.push( key+'='+escape(value) );
			
		}
		
		return '?'+parts.join('&');
		
	},
	
	on_get_filters: function(data){
		
		
		
		
		this.filters_data = data;
		this.filters_div.select('.filter_li ul').invoke('removeClassName', '_LOADING');
		var filter_lis = this.filters_div.select('.filter_li');

		
		  
		
		for( var i=0; i<filter_lis.length; i++ ) {
			
			var filter_li = filter_lis[i];
			var filter_h = filter_li.down('input.h');
	    
			
			
			var filter_selected = filter_li.readAttribute('selected')=='true';
      
			var field = filter_lis[i].readAttribute('field');
			var preset = field.split('.')[0];
			var ul = filter_lis[i].down('ul').addClassName('__' + preset + '_ul');
			var filter_data = data['filters'][field];
			
			
			

			// filter_h.value = filter_h.readAttribute('label').'';
			filter_h.observe('click', this.filter_more_btn_click.bind(this));

			
			
			
			
			
			
			var length = filter_selected ? filter_data.length : Math.min( filter_data.length, 10 );
			for( var f=0; f<length; f++ ) {
				
				if( filter_selected ) {
				  
				  if( filter_data[f][0]==filter_li.readAttribute('selectedValue') ) {
					  
					  var params = this.form.serialize( true );
						if( !Object.isArray( params['w[]'] ) )
						  params['w[]'] = $A();
						
						var nw = $A();						
						var wheres_count = Math.floor( params['w[]'].length/3 );
						
						for( var w=0; w<wheres_count; w++  ) {
							// alert( params['w[]'][ w*3 ]+' '+field );
							if( params['w[]'][ w*3 ]!=field ) {
								
								nw.push( params['w[]'][ w*3 ] );
								nw.push( params['w[]'][ w*3+1 ] );
								nw.push( params['w[]'][ w*3+2 ] );
								
							}
						}
						
						params['w[]'] = nw;

						
						var href = this.toHref( params );
					  
					  // var href = '#';
					  
					  
					  
					  var li = this.get_filter_item('selected', filter_data[f], preset, href);						
						ul.show().insert( li );
				  }
				  
				} else {
				
				  if( f<5 ) {

						var params = this.form.serialize( true );
						if( !Object.isArray( params['w[]'] ) )
						  params['w[]'] = $A();
						
						params['w[]'].push( field );
						params['w[]'].push( '=' );
						params['w[]'].push( filter_data[f][0] );
						
						var href = this.toHref( params );
						
						var li = this.get_filter_item('regular', filter_data[f], preset, href);						
						ul.insert( li );
					
					}
				
				}
				
			}
			
			if( filter_selected || length>5 ) {
			  var inp = filter_lis[i].down('input.wszystkie_opcje');
			  inp.show();
			}
			  
			
			
		}
		
		
		
	},
	get_filter_item: function(mode, filter_data, preset, href){
		
		
		var li = new Element('li', {className: '__' + preset});

    switch( preset ) {
	    
	    
	    
	    
	    
	    
	    case 'instytucje': {
		    		    
		    switch( mode ) {
			
					case 'regular': {
						var a = new Element('a', {href: href}).update( '<div class="container_div"><div class="avatar_div"><img src="/resources/podmioty/a/6/' + filter_data[0] + '.png" /></div><div class="content_div"><p class="title">' + filter_data[1]+'</p></div><p class="stats">'+filter_data[2]+' projektów</p></div>' );
						li.update( a );
						break;
					}
					
					case 'selected': {
						var a = new Element('a', {href: href, className: 'selected'}).update( '<i></i> <span class="fname">'+filter_data[1]+'</span>' );
						li.update( a );
						break;
					}
					
				}
		    a.addClassName('pad');

		    
		    break;
	    }
	    
	    
	    
	    
	    
	    
	    default: {
		    
		    
		    switch( mode ) {
			
					case 'regular': {
						var a = new Element('a', {href: href}).update( filter_data[1]+' <span class="fcount">(<b>'+filter_data[2]+'</b>)</span>' );
						li.update( a );
						break;
					}
					
					case 'selected': {
						var a = new Element('a', {href: href, className: 'selected'}).update( '<i></i> <span class="fname">'+filter_data[1]+'</span>' );
						li.update( a );
						break;
					}
					
				}	
		    
		    
	    }
	    
    }
		
		
		
		return li;
		
	},
	filter_more_btn_click: function(event){
		
		
		var li = event.findElement('.filter_li');
		var field = li.readAttribute('field');
		var h = li.down('input.h');
		var div = new Element('div');
		
		var results_div = new Element('div', {className: 'results_div'});
		results_div.setStyle({height: '269px'});
		for( var i=0; i<this.filters_data['filters'][ field ].length; i++ ) {
		  
		  
		  var params = this.form.serialize( true );
			if( !Object.isArray( params['w[]'] ) )
			  params['w[]'] = $A();
			
			params['w[]'].push( field );
			params['w[]'].push( '=' );
			params['w[]'].push( this.filters_data['filters'][ field ][i][0] );
			
			var href = this.toHref( params );
			
			
		  
		  
		  
		  var f = this.filters_data['filters'][ field ][i];
		  if( f ) {
				var a = new Element('a', {href: href}).update( f[1]+' <span>(<b>'+f[2]+'</b>)</span>' );
				this.filters_data['filters'][ field ][i][10] = a;
				results_div.insert( a );
			}
		}
		
		var search_input = new Element('input', {type: 'text', className: 's_text_input'});
		search_input.setStyle({width: '500px'}).observe('keyup', function(field, search_input, results_div, event){
		  
		  new PeriodicalExecuter(function(field, search_input, results_div, pe){
		    pe.stop();
			  this.filter_results( $F(search_input), search_input, field, results_div );
		  }.bind(this, field, search_input, results_div), .35);
		  
		}.bind(this, field, search_input, results_div));
		div.insert( results_div );
		div.insert( search_input );
		
		
		$M.addLightboxShow(div, {title: h.value, height: 300});
		search_input.activate();
		
	},
	
	filter_results: function(v, search_input, field, results_div){
	  var _v = $F( search_input );
		if( v==_v && ( !this._fv || this._fv!=v ) ) {
		  
		  // alert( 'filter '+v );
		  
		  for( var i=0; i<this.filters_data['filters'][ field ].length; i++ ) {
			  
			  var p = stripos( this.filters_data['filters'][ field ][i][1], v );
			  // alert( i+'  '+this.filters_data['filters'][ field ][i][1]+' - '+v+' - '+p );
			  if( p===false )
			    this.filters_data['filters'][ field ][i][10].hide();
			  else
			    this.filters_data['filters'][ field ][i][10].show();
			  
		  }
		  this._fv = v;
		}
	}

});

var _datasets_browsers = $A();
$M.addInitCallback(function(){
  var divs = $$('._s_browser');
  for( var i=0; i<divs.length; i++ )
		_datasets_browsers.push( new DatasetBrowser( divs[i] ) );
});