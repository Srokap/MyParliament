function build_page(){
  $S('mPortal/pages/build', CURRENT_PAGE);
}

function build_engines(){
  $S('mPortal/pages/build_engines');
}

function build_all(){
  $S('mPortal/pages/build_all');
}

function new_service(){
  var args = $A(arguments);
  var service = args[0];
  var page = '';
  var access = '';
  
  if ( args.length==2 ) {
    if( Object.isString(args[1]) ) page = args[1];
    if( Object.isNumber(args[1]) ) access = args[1];
  } else if ( args.length==3 ) {
    page = args[1];
    access = args[2];
  }
  
  if( service ) {
    $S('mPortal/services/new', {id: service, page: page, access: access});
  }
  
}

var LICZNIKI = Class.create({
  initialize: function(data){
    this.data = data['data'];
    this.count = data['count'];
    this.toggleDiv = $('_LICZNIKI_TOGGLE').observe('click', this.toggle.bind(this));
    this.div = $('_LICZNIKI_DIV');
    this.ul = $('_LICZNIKI_UL');
    this.state = false;
    
    this.render();
    new PeriodicalExecuter(this.update.bind(this), 180);
  },
  toggle: function(){
    if( this.state ) { this.hide(); } else { if(this.count>0) { this.show(); } }
  },
  show: function(){
    this.update();
    this.toggleDiv.addClassName('selected');
    this.div.show();
    this.state = true;
    
    Event.observe(document, 'click', this.documentClick.bind(this));
  },
  documentClick: function(event){
    if( event.findElement('div')!=this.div ) { event.stop(); }
    if( event.findElement('a')==this.toggleDiv ) return false;
    this.hide();
    Event.stopObserving(document, 'click');
  },
  hide: function(){
    this.toggleDiv.removeClassName('selected');
    this.div.hide();
    this.state = false;
  },
  render: function(){
    $$('._licznik[licznik=wszystko]').invoke('update', this.count);
    this.ul.update('');
    for( var i=0; i<this.data.length; i++ ){
      var v = Number(this.data[i]['licznik']);
      $$('._licznik[licznik='+this.data[i]['id']+']').invoke('update', v);
      if(v>0) {
        this.ul.insert('<li><a href="/'+this.data[i]['href']+'"><span class="label">'+this.data[i]['nazwa']+'</span><span class="_licznik" licznik="'+this.data[i]['id']+'">'+this.data[i]['licznik']+'</span></a></li>');
      }
    }
  },
  update: function(){
    $S('liczniki/pobierz', function(data){
	    this.data = data['data'];
	    this.count = data['count'];
	    this.render();    
    }.bind(this));
  }
});
var $LICZNIKI;

$M.addInitCallback(function(){
  try{
    $LICZNIKI = new LICZNIKI($LICZNIKI_INITIAL_DATA); 
  }catch(e){}; 
});



var AdminEditableAdd = Class.create({
	initialize: function(){
		$$('._admin_editable_add').invoke('observe', 'click', this.addClick.bind(this));
		$$('._admin_editable_save').invoke('observe', 'click', this.saveClick.bind(this));
	},
	addClick: function( event ){
		var no_columns = event.currentTarget.readAttribute('_admin_no_columns');
		var parent = $( event.currentTarget ).up();
		var table = parent.down( 'table' );

		if( typeof table == 'undefined' ){
			table = new Element('table', {className: 'api_docs_table'}).update('<tr><th class="a">Nazwa</th><th class="b">Znaczenie</th></tr>');			
			parent.insert( table );
		}
		
		var new_row = new Element( 'tr', { 'class': 'new'} );
		for( var i=0; i<no_columns; i++ ){
			new_row.insert( new Element('td').update( new Element('textarea') ) );
		}
		
		table.insert( new_row );
	},
	saveClick: function( event ){
		var id = event.currentTarget.readAttribute('_admin_editable_add_id');
		var parent = $( event.currentTarget ).up();
		var table = parent.down( 'table' );

		if( typeof table == 'undefined' ){
			return false;
		}
		
		var params = $A();
		var trs = table.select('tr.new');

		for( var i=0; i<trs.length; i++ ) {
			var row_params = $A();
			texts = trs[i].select( 'td textarea' );

			for( var j=0; j<texts.length; j++ ) {
				row_params.push( $F( texts[j] ) );
			}

			params.push( row_params );
		}
		
		$S( 'admin_editable/update', {id: id, content: params}, this.onSave.bind(this, table) );
	},
	onSave: function( table, data  ){
		console.log(data);
		console.log(table);
		
		var trs = table.select('tr.new');

		for( var i=0; i<trs.length; i++ ) {
			var row = $A();
			var isError = false;
			
			texts = trs[i].select( 'td textarea' );

			for( var j=0; j<texts.length; j++ ) {
				if( data[i][j] ){
					texts[j].removeClassName('err');
				} else {
					texts[j].addClassName('err');
					isError = true;
				}
			}
			if( !isError ){
				this.saved( trs[i], data[i] );
			}
		}
		observe_admin_editable();
		
	},
	saved: function( row, data ){
		row.removeClassName('new');
		row = row.select( 'td textarea' );
		for( var i=0; i<row.length; i++ ) {
			var el_html = $F( row[i] );
			if( data != true ){
				if( el_html == '' ){
					el_html = 'null';
				}
				el_html = '<div ' + data[i] + '>' + el_html +  '</div>';
			}
			row[i].replace( el_html );
		}
	}
});



function observe_admin_editable(){
	$$('._admin_editable').invoke('stopObserving', 'click');
	$$('._admin_editable').invoke('observe', 'click', function(event){
		if( event.altKey ) {
			var textarea = event.findElement('textarea');
			var div = event.findElement('._admin_editable');
			var edit_id = div.readAttribute('_admin_editable_id');
				
			if( !textarea ){
				div.update('<textarea>' + div.innerHTML +'</textarea>');
				textarea = div.down( 'textarea' );
			} else {
				var params = {
						id: edit_id,
						content: $F(textarea),
				};
							
				$S('admin_editable/update', params, function(){
					div.update( params['content'] );
				});
			}
		}
	});
};
