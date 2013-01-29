var TabManager = Class.create({
	
	initialize: function( css ){
		this.active_class_tab = 's';
		this.tabs_class = css;
		
		$$( this.tabs_class + ' li a').invoke('observe', 'click', this.tab_click.bind(this));
	},
	
	tab_click: function( event ){
		event.stop();
		this.hide_all();
		this.show_current( event.currentTarget.readAttribute('href') );
		return false;
	},
	
	hide_all: function(){
		$$( this.tabs_class + ' li').invoke( 'removeClassName', this.active_class_tab );
		$$('.tab_content').invoke('setStyle', {display: 'none'} );
	},
	
	show_current: function( name ){
		$$('a[name="'+name.replace("#","")+'"]')[0].up().setStyle({display: 'block'});
		$$('a[href="'+name+'"]')[0].up().addClassName( this.active_class_tab );
	}
});

var tabManager;
$M.addInitCallback(function(){
	tabManager = new TabManager( '.ep_Object_menu_ul' );
});
