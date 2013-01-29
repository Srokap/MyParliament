function _FB_procces_auth_response(response) {
	  
  if (response.status === 'connected') {
    
    // the user is logged in and connected to your
    // app, and response.authResponse supplies
    // the user’s ID, a valid access token, a signed
    // request, and the time the access token 
    // and signed request each expire
    
    var uid = response.authResponse.userID;
    var accessToken = response.authResponse.accessToken;
    
    if( !_LOGGED || (_LOGGED && _LOGGED_TYPE=='sm') ) {
      show_login_loading_lb();
      location.reload();
    }
    
  } else if (response.status === 'not_authorized') {
    
    // the user is logged in to Facebook, 
    //but not connected to the app
    
    if( _LOGGED && _LOGGED_TYPE=='fb' ) {
      console.log('FB: not_authorized');
      location.reload();
    }
    
  } else {
    
    // the user isn't even logged in to Facebook.
    
    if( _LOGGED && _LOGGED_TYPE=='fb' ){
      console.log('FB: not logged');
      location.reload();
    }
  
  }
	
}


window.fbAsyncInit = function() {
  FB.init(_FB_INIT_DATA);
  FB.Canvas.setSize();
  FB.getLoginStatus( _FB_procces_auth_response );
  FB.Event.subscribe('auth.authResponseChange', _FB_procces_auth_response);
}





var _ADMIN;
var _fbOnLoginRedirection;
window._fbOnLogin = function(){
  $M.lightboxClose();
  show_login_loading_lb();
  if( Object.isFunction( window._fbOnLoginCallback ) ) window._fbOnLoginCallback();
  if( _fbOnLoginRedirection ) {
    location = 'http://sejmometr.pl/'+_fbOnLoginRedirection;
  } else {
    location.reload();
  }
}






function _google_maps_initialize() {
	if( $M )
	  $M.google_maps_initialize();
}




function addslashes(str) {
	str=str.replace(/\\/g,'\\\\');
	str=str.replace(/\'/g,'\\\'');
	str=str.replace(/\"/g,'\\"');
	str=str.replace(/\0/g,'\\0');
	return str;
}

function stripslashes(str) {
	str=str.replace(/\\'/g,'\'');
	str=str.replace(/\\"/g,'"');
	str=str.replace(/\\0/g,'\0');
	str=str.replace(/\\\\/g,'\\');
	return str;
}


function var_export(v){
  var r = '';
  for(k in v){
    r += k+': '+v[k]+"\n";
  }
  alert(r);
}

function cssToNumber(css){
  return Number( css.replace('px', '') ); 
}

function getScrollTop(){
  if(typeof pageYOffset!= 'undefined'){
	  //most browsers
	  return pageYOffset;
  }
  else {
	  var B= document.body; //IE 'quirks'
	  var D= document.documentElement; //IE with doctype
	  D= (D.clientHeight)? D: B;
	  return D.scrollTop;
  }
}

function setScrollTop(val){
  var t = getScrollTop();
  scrollBy(0, val-t);
}

function animScrollTop( stop_position  ){
	
	if( !stop_position )
	  stop_position = 0;
	
	var start_position = getScrollTop();
	new Effect.Tween(null, start_position, stop_position, {
		'duration': .3
	}, function(p){
	  setScrollTop( p );
	});;

}

function isIE(){
  return /msie/i.test(navigator.userAgent) && !/opera/i.test(navigator.userAgent);
}

function stripos(f_haystack, f_needle, f_offset) {
  var haystack = (f_haystack + '').toLowerCase();
  var needle = (f_needle + '').toLowerCase();
  var index = 0;

  if ((index = haystack.indexOf(needle, f_offset)) !== -1)
	  return index;
  
  return false;
}

Element.addMethods({
  makeVisible: function(element){
    return element.setStyle({visibility:'visible'});
  },
  makeHidden: function(element){
    return element.setStyle({visibility:'hidden'});
  },
  height_control: function(element){
    if( $M.heightController ) {
      return $M.heightController.resizeItem(element);
    }
  }
});

function isObject(obj){
  if( obj==null || Object.isUndefined(obj) ) { return false; }
  return (String(typeof(obj)).toUpperCase()=='OBJECT');
}

function sm_dopelniacz(){
  var args = $A(arguments);
  var count = Number( args[0] );
  var formA = String( args[1] );
  var formB = String( args[2] );
  var formC = String( args[3] );
  var formD = String( args[4] );


  var r;
  if( count==0) {return formD;}
  else if( count==1 ) {
    r = formA;
  } else if( count<5 ) {
    r = formB;
  } else if( count<22) {
    r = formC;
  } else {
    var d = count % 10;
    if( d<2 ) { r = formC; }
    else if( d<5 ) { r = formB; }
    else { r = formC; }
  }
  return count+'&nbsp;'+r;
}

var Height_Controller = Class.create({
  global_fix: 0,
  initialize: function(){
    this.resize();
    this.footer_height = $('_FOOTER') ? $('_FOOTER').getHeight() : 0;
    Event.observe(window, 'resize', this.resize.bind(this));
  },
  resize: function(){
    this.viewport_height = document.viewport.getHeight();
    $$('._height_controll').each( function(item){ this.resizeItem(item); }.bind(this) );
  },
  resizeArea: function(area){
    this.resizeItem( $(area) );
    $(area).select('._height_controll').each( function(item){ this.resizeItem(item); }.bind(this) );
  },
  resizeItem: function(item){
    var height_offset = Number( item.readAttribute('height_offset') );
    var height_factor = item.readAttribute('height_factor');
    if( height_factor===null ) height_factor = 1;

    var height = this.viewport_height*Number(height_factor) - item.cumulativeOffset()[1] - this.footer_height + height_offset - 20 + this.global_fix;
    return item.setStyle({height: height+'px'});
  }
});

var _mInput = Class.create({
  changed: false,
  initialize: function(el){
        
    this.el = $(el).observe('focus', this.on_focus.bind(this)).observe('blur', this.on_blur.bind(this)).observe('keypress', this.on_keypress.bind(this));
    this.default_value = this.el.readAttribute('default_value');
    this.changed = ( this.default_value != this.get_value() );
    if( this.changed )
      this.el.removeClassName('blured');
  },
  get_value: function(){
	  return $F(this.el).strip();
  },
  on_focus: function(event){
    this.el.removeClassName('blured');
    if( !this.changed ) this.el.value = '';
  },
  on_blur: function(event){
    if( !this.changed || !this.get_value() ) {
      this.el.value = this.default_value;
      this.changed = false;
      this.el.addClassName('blured');
    }
  },
  on_keypress: function(event){
    this.changed = true;
  }
});




var $_MPAGE = Class.create({
  lightboxCounter: 0,
  initialized: false,
  promo_poslowie: false,
	promo_poslowie_width: false,
	promo_poslowie_margin_left: false,
  overlay_lock: false,
  mInputs: false,
  _MAIN_SEARCH_DIV: false,
  initialize: function(){
 	  
 	  
    this._onInitCallbacks = $A();
    this._onMapInitCallbacks = $A();
    this._onMouseDownCallbacks = $A();
    this._s_btn_tooltips = $A();
    
    this._MAIN_SEARCH_DIV = $('_MAIN_SEARCH_DIV');
    if( this._MAIN_SEARCH_DIV ) {
	    this.search_div_status = $('_MAIN_SEARCH_DIV').visible();
	    
	    if( !this.search_div_status ) 
	      this._MAIN_MENU_SEARCH_BUTTON = $('_MAIN_MENU_SEARCH_BUTTON').observe('click', function(event){
		      event.stop();
		      this.search_div_toggle();
	      }.bind(this));
	    
    }
    
    this.mInputs = $A();
    
    this.heightController = new Height_Controller();
    
    $$('.mInput').each(function( input ){
	    var mInput = new _mInput( input );
	    this.mInputs.push( mInput );
    }.bind(this));
    
    
    (function(d){
		   var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
		   js = d.createElement('script'); js.id = id; js.async = true;
		   js.src = "//connect.facebook.net/pl_PL/all.js";
		   d.getElementsByTagName('head')[0].appendChild(js);
		 }(document));
			 
    document.observe('dom:loaded', this.onInit.bind(this));
    document.observe('mousedown', this.onMouseDown.bind(this));
    
    
    if( $('_USER_OPTIONS_A') ) {
	    $('_USER_OPTIONS_A').observe('click', function(event){
		    
		    event.stop();
		    $('_USER_LINKS_UL').toggleClassName('expanded');
		    $('_USER_LI').toggleClassName('expanded');
		    
	    });
	    
	    $$('.s_dodaj_do_kolekcji_btn').each(function(btn){
		    btn.addClassName('a').observe('click', this.on_do_kolekcji_btn_click.bind(this));
	    }.bind(this));
	    $$('.s_udostepnij_btn').each(function(btn){
		    btn.addClassName('a').observe('click', this.on_udostepnij_btn_click.bind(this));
	    }.bind(this));
    }
    
  },
  onMouseDown: function(event){
	  
	  /*
	  this._onMouseDownCallbacks.each(function(event, callback){
      callback(event);
    }.bind(this, event));
	  this._onMouseDownCallbacks = $A();
	  */
	  
	  if( this._s_btn_tooltips.length ) {
		  
		  var tooltip_div = event.findElement('.s_btn_tooltip');
		  if( !tooltip_div ) {
		    
		    for( var i=0; i<this._s_btn_tooltips.length; i++ )
		      this._s_btn_tooltips[i].remove();
		    $$('.s_dodaj_do_kolekcji_btn.active').invoke('removeClassName', 'active');
		    this._s_btn_tooltips = $A();
		  
		  }
		  
	  }
	  
  },
  on_do_kolekcji_btn_click: function(event){

	  var btn = event.findElement('.s_dodaj_do_kolekcji_btn');

	  var div = new Element('div', {className: 's_btn_tooltip'});
	  var ul = new Element('ul');
	  for( var i=1; i<=5; i++ ) {
		  var input = new Element('input', {type: 'button', value: 'Kolekcja '+i});
		  var li = new Element('li', {className: 'd'}).update(input).observe('click', function(btn, div, event){
			  
			  var li = event.findElement('li');
			  li.removeClassName('d').addClassName('b').up('.s_btn_tooltip').writeAttribute('disabled', '1');
			  li.i = 0;
			  
			  var pe = new PeriodicalExecuter(function(btn, li, div, pe){
				  
				  li.toggleClassName('c');
				  li.i++;
				  
				  if( li.i==5 ) {
					  pe.stop();
					  var index = this._s_btn_tooltips.indexOf( div );
					  div.remove();
					  btn.removeClassName('active');
					  this._s_btn_tooltips.splice( index, 1 );
				  }
				  
			  }.bind(this, btn, li, div), .1);
			  
		  }.bind(this, btn, div));
		  ul.insert(li);
	  }
	  div.update( ul );
	  	  
	  btn.addClassName('active').insert({before: div});
	  this._s_btn_tooltips.push( div );
	  
  },
  on_udostepnij_btn_click: function(event){
	  
	  
  },
  addInitCallback: function(callback){
    this._onInitCallbacks.push(callback);
  },
  addMapInitCallback: function(callback){
    this._onMapInitCallbacks.push(callback);
  },
  addMouseDownCallback: function( callback ){
	  this._onMouseDownCallbacks.push(callback);
  },
  _login_form_submit: function(form){
    form = $(form);
    var params = form.serialize(true);
    form.select('input').invoke('disable');
    form.down('._btns').addClassName('_LOADING').select('a').invoke('hide');
    $POST_SERVICE('mPortal/login', params, function(form, data){
      if( data ) {
        form.down('._login_status').removeClassName('error').update('Logowanie poprawne! Ładuję Twój profil...');
        
        _PAGEDATA['goHomeOnLogin']
        
        if( _fbOnLoginRedirection ) {
          location = 'http://sejmometr.pl/'+_fbOnLoginRedirection;
        } else {
        
          if( _PAGEDATA['goHomeOnLogin'] )
            location = 'http://sejmometr.pl';
          else
            location.reload();
        }
                
      } else {
        form.down('._login_status').addClassName('error').update('Nieprawidłowy login lub hasło. <a href="__SITE_ROOT__haslo">Zapomniałeś hasło?</a>');
        form.select('input').invoke('enable');
		    form.down('._btns').removeClassName('_LOADING').select('a').invoke('show');
      }
    }.bind(this, form));
  },
  onInit: function(){
    
    
    
    this.PAGE = _PAGEDATA;
    this.initialized = true;
    $$('html')[0].show();    
    $('_OVERLAY').observe('click', this.onOverlayClick.bind(this));
    
    
    /*
    if( $('left_menu_cont') )
		  this.lmc = new LEFT_MENU_CONTROLLER();
    */
    
    var column_left = $$('.s_column_main_left')[0];
    var column_right = $$('.s_column_main_right')[0];
    if( column_left && column_right && column_right.getHeight()<column_left.getHeight() ) {
	    column_right.setStyle({minHeight: column_left.getHeight()+'px'});
    }
    
    

    this._onInitCallbacks.each(function(callback){      
      try {
			  callback();
		  } catch(err) {
		    console.log('callback error: '+err);
		  }
    });
    
    
    
    
    
   
    
  },	
  getServiceParameters: function(args, method){ 
    var args = $A(args);
    if( args.length==0 ) { return false; }
    
    var service = args[0];
    var params = null;
    var successCallback = null;
    var failCallback = null;
    var method = (method=='post') ? 'post' : 'get';
    
    switch( args.length ) {
      case 2: {
        if( Object.isFunction(args[1]) ) { successCallback = args[1]; } else { params=args[1] }
        break;
      }
      case 3: {
        if( Object.isFunction(args[1]) ) {
          successCallback = args[1];
          failCallback = args[2];
        } else {
          params = args[1];
          successCallback = args[2];
        }
      }
      case 4: {
        var params = args[1];
        var successCallback = args[2];
        var failCallback = args[3];
      }
    }
    if( failCallback==null ) { failCallback=this._generalFailCallback; }
    var parameters = {'_PID': this.PAGE.ID};
    if( params ) { parameters['_PARAMS'] = Object.toJSON(params); }
    return {service: service, parameters: parameters, successCallback: successCallback, failCallback: failCallback, method: method};
  },
  service: function(args, method){   
    this._service( this.getServiceParameters(args, method) );   
  },
  pattern: function(args){
    this._pattern( this.getServiceParameters(args) );
  },
  _service: function(params){
    new Ajax.Request('__SITE_ROOT__service/'+params.service, {
		  method: params.method,
		  parameters: params.parameters,
		  onSuccess: function(service, successCallback, transport){
		    try{
		      var data = transport.responseText.evalJSON();
		    }catch(e){
		      // alert("service: "+service+"\n\n"+transport.responseText);
		      // return false;
		    }
		    successCallback(data);
		  }.bind(this, params.service, params.successCallback),
		  onFailure: function(failCallback){
		    failCallback();
		  }.bind(this, params.failCallback)
		});
  },
  _pattern: function(params){    
    new Ajax.Request('__SITE_ROOT__pattern/'+params.service, {
		  method: params.method,
		  parameters: params.parameters,
		  onSuccess: function(service, successCallback, transport){
		    try{
		      var html = transport.responseText;
		    }catch(e){
		      alert("pattern: "+service+"\n\n"+transport.responseText);
		      return false;
		    }
		    successCallback(html);
		  }.bind(this, params.service, params.successCallback),
		  onFailure: function(failCallback){
		    failCallback();
		  }.bind(this, params.failCallback)
		});
  },
  _generalFailCallback: function(){
    alert("Wystąpił błąd.\nPrzeładuj stronę i spróbuj jeszcze raz.");
  },
  lightboxShowLoading: function( id ){
	  
	  var div = this.getLightboxDiv( id );
	  if( div ) {
		  
		  div.down('.lightbox_bar').addClassName('loading');
		  
	  }
  },
  lightboxHideLoading: function( id ){
	  
	  var div = this.getLightboxDiv( id );
	  if( div ) {
		  
			div.down('.lightbox_bar').removeClassName('loading');
		  
	  }	  
  },
  addLightbox: function(div, params){
    
    var div = $(div);
    
    this.lightboxCounter++;
    var nopad = Boolean( params.nopad );
    var overflowhidden = Boolean( params.overflowhidden );
    var noclosebutton = Boolean( params.noclosebutton );
    
    
    var lbdiv_inner = '<div class="lightbox_bar"><p class="tytul">&nbsp;'+params.title+'</p>';
    if( !noclosebutton )
      lbdiv_inner += '<p class="x"><input type="button" value="X" /></p>';
    lbdiv_inner += '</div>';

    
    var content = new Element('div', {className: 'lightbox_content'});
    var lbdiv = new Element('div', {className: 'lightbox', lbid: this.lightboxCounter}).hide().insert( lbdiv_inner ).insert( div.wrap(content) );
    
    
    if( !params.width ) params.width = 500;
    if( !params.height ) params.height = 200;
    params.height = Math.min( params.height, document.viewport.getHeight()-50 );
    
    
    
    var content_width = params.width+20;
    
    /*
    if( nopad ) {
      lbdiv.addClassName('nopad');
      content_width += 30;
    }
    */
        
    if( overflowhidden )
      lbdiv.addClassName('overflowhidden');
    
    
    lbdiv.setStyle({marginLeft: '-'+Math.round(params.width/2)+'px'}).down('.lightbox_content').setStyle({width: content_width+'px'});
    lbdiv.setStyle({width: params.width+20+'px'});
    lbdiv.setStyle({marginTop: '-'+Math.round(params.height/2)-16+'px'}).down('.lightbox_content').setStyle({height: params.height+'px'});
    
    if( isIE() ) {
      $('_LIGHTBOXES').setStyle({marginTop: Math.round(params.height*.25)+16+'px'});
    } else {
      // new Draggable(lbdiv, {handle: 'lightbox_bar', starteffect: null, endeffects: null});
    }
    
    
    $('_LIGHTBOXES').insert( lbdiv );
    
    if( !noclosebutton )
	    lbdiv.down('.x input').observe('click', this.lightboxClose.bind(this));
    
    return this.lightboxCounter;
  },
  addLightboxShow: function(div, params){
    if( !params ) params = {};
    var lbid = this.addLightbox(div, params);
    this.lightbox(lbid, {beforeClose: params.beforeClose, afterClose: params.afterClose});
    return lbid;
  },
  lightbox: function(lbid, params){
    this.lbid = lbid;
    var div = this.getLightboxDiv(lbid);
    $('_OVERLAY').show();
    if( params ) {
	    this.beforeLightboxClose = params.beforeClose;
	    this.afterLightboxClose = params.afterClose;
    }
    div.show();
  },
  getLightboxDiv: function(lbid){
    return $('_LIGHTBOXES').down('.lightbox[lbid='+lbid+']');
  },
  onOverlayClick: function(){
    if( !this.overlay_lock )
	    this.lightboxClose();
  },
  lightboxClose: function(){
    if( this.lbid ) {
      if( Object.isFunction(this.beforeLightboxClose) ) this.beforeLightboxClose();
      var lbdiv = this.getLightboxDiv(this.lbid);
      lbdiv.hide();
    }
    this.beforeLightboxClose = false;
    this.lbid = false;
    $('_OVERLAY').hide();
    if( Object.isFunction(this.afterLightboxClose) ) this.afterLightboxClose(lbdiv);
    this.afterLightboxClose = false;
    // if( lbdiv ) lbdiv.remove();
  },
  google_maps_initialize: function() {
	  
	  this._onMapInitCallbacks.each(function(callback){
      callback();
    });
	  
  },
  search_div_down: function(){
	  
	  if( this._MAIN_SEARCH_DIV ) {
	    this.search_div_status = true;
	    this._MAIN_SEARCH_DIV.blindDown({duration: .3})
	  }
	  
  },
  search_div_up: function(){
	  
	  if( this._MAIN_SEARCH_DIV ) {
	    this.search_div_status = false;
	    this._MAIN_SEARCH_DIV.blindUp({duration: .3})
	  }
  },
  search_div_toggle: function(){
	  
	  if( this._MAIN_SEARCH_DIV ) {
	    if( this.search_div_status )
	      this.search_div_up();
	    else
	      this.search_div_down();
	  }
  }

});
var $M = new $_MPAGE();


var LEFT_MENU_CONTROLLER = Class.create({
	initialize: function(){
				
		this.body = $$('body')[0];
		this.footer = $$('.s_footer_div')[0];
		this.div = $('left_menu_cont');
		this.div_offset = this.div.cumulativeOffset()['top'];
		Event.observe(window, 'scroll', this.adjust.bind(this));
		Event.observe(window, 'resize', this.adjust.bind(this));
		this.adjust();		
	},
	adjust: function(){
				
		var x = document.viewport.getHeight() - this.div_offset - 26 + Math.min(0, this.body.getHeight() - getScrollTop() - document.viewport.getHeight() - this.footer.getHeight());
		this.div.setStyle({height: x+'px'});
		
	},
	log: function(x){
		$$('.s_user_li span')[0].update( x );
	}
});









function show_login_lb(){
  if( $M && $M.initialized ) {
    $M.lightbox('login', {});
    $$('._login_status').each(function(el){
      el.update('<a href="__SITE_ROOT__haslo">Zapomniałeś hasło?</a>');
    });
    $$('._login_lb').last().down('input').activate();
  }
}

function show_login_loading_lb(){
  if( $M && $M.initialized ) {
    $M.overlay_lock = true;
    $M.lightbox('login_loading', {});
  }
}

function show_logout_loading_lb(){
  if( $M && $M.initialized ) {
    $M.overlay_lock = true;
    $M.lightbox('logout_loading', {});
  }
}

function $SERVICE(){ return $M.service(arguments, 'get'); }
function $POST_SERVICE(){ return $M.service(arguments, 'post'); }
function $S(){ return $M.service(arguments, 'get'); }
function $P(){ return $M.pattern(arguments); }
function $PATTERN(){ return $M.pattern(arguments); }

function $ANCHOR(){
  var params = arguments[1] ? arguments[1] : {};
  params.href = params.href ? params.href : '#';
  params.onclick = params.onclick ? params.onclick : 'return false;';
  return new Element('a', params).update(arguments[0]);
}