(function(window) {
    if(!window.scribd) {
        var getRandomInt = function(min, max)  {  
          return Math.floor(Math.random() * (max - min + 1)) + min;  
        };

        function Document(options) {

            this.params = function() {
               var params = {};
               return {
                 set: function (key, val) {
                    params[key] = val;
                 },
                 get: function(key) {
                    return params[key];
                 }
               };
            }();

            this.params.set('document_id', options.document_id);
            this.params.set('domain', "www.scribd.com"); // default domain if none set

            if (options.hasOwnProperty('access_key')){
              this.params.set('access_key', options.access_key);
            } else if (options.hasOwnProperty('secret_password')){
              this.params.set('secret_password', options.secret_password);
            }

            if (options.hasOwnProperty('upload_from_url')) {
              this.params.set('upload_from_url', options.upload_from_url);
            }
            if (options.hasOwnProperty('url')) {
              this.params.set('url', options.url);
            }
            if (options.hasOwnProperty('publisher_id')) {
              this.params.set('publisher_id', options.publisher_id);
            }

            this.__ensureEasyXDMLoad();

            this.__callQueue = [ ];                 // stores premature method calls for later replay, technically a stack (FILO)
            this.__listenerLookup = { };            // lookup[ eventType:String ] -> [ callback1:Function, callback2:Function ... ]
        };

        Document.prototype = {

            /* ---------------

            Private Methods

            ------------------ */

            // method that will fire off an event, whatever browser is used
            __fireEvent: function( eventType ) {
              var el = this.getElement();
              if (el.addEventListener){
                var ev = document.createEvent('HTMLEvents');
                ev.initEvent(eventType, true, false);
                el.dispatchEvent(ev);
              } else if (el.attachEvent){
                this.__handleEvent( eventType );
              }
            },

            // set up event handlers for the embeds
            __setupEvents: function() {
                var __this = this;

                // Event router for IE (which doesn't properly support custom events)
                window[ "_scribd_event_handler_" + this.params.get('embed_name') ] = function(eventType){ __this.__handleEvent(eventType) };

                //
                // setupJsApi -- attach event listeners
                //
                var onSetupJsApi = function(e)
                {
                    var e = e || {};      // In the case of IE, there will be no Event so we return an empty object
                    var target = null;
                    var el = __this.getElement();
                    if (e.srcElement && e.srcElement.getAttribute('id') === __this.params.get('embed_name')) {
                       target = e.srcElement;
                    } else if ( el && el.getAttribute('id') === __this.params.get('embed_name') ) {
                       target = el;
                    }
                    if (target) {
                        if (!__this.api) {
                          __this.api = target;
                        }
                        // Grab the next call on the queue, check to see if it's actionable, if not push onto a stack which will replace __callQueue
                        var i, method, callParams, rejectedCalls = [];

                        for (var i=0; i<__this.__callQueue.length; i++)
                        {
                          callParams = __this.__callQueue[i];
                          if (callParams[0] == "addEventListener") {  // Execute all listener calls
                            method = callParams.shift();
                            __this[method].apply( __this, callParams );
                          } else {
                            rejectedCalls.push( callParams ); // Send back to __callQueue
                          }
                        }
                        __this.__callQueue = rejectedCalls; // end callQueue
                    }
                }

                // This should be deprecated, but is here for backwards compatibility (and the iPaper reader only sends this event). Forward to docReady.
                var oniPaperReady = function(e)
                {
                    __this.__fireEvent('docReady');
                }

                //
                // iDocReady -- pump call queue
                //

                var onDocReady = function(e)
                {
                    var e = e || {};        // In the case of IE, there will be no Event so we return an empty object
                    var target = e.srcElement || __this.getElement();

                    if (target.getAttribute('id') == __this.params.get('embed_name')) {

                        if (__this.onReady){
                            __this.onReady();
                        }

                        // Grab the next call on the queue, check to see if it's actionable, if not push onto a stack which will replace __callQueue (rejectedCalls)
                        var i, method, callParams, rejectedCalls = [];
                        for (i=0; i<__this.__callQueue.length; i++) {
                          callParams = __this.__callQueue.pop();
                          if (callParams[0] != "addEventListener") {  // Execute all non-listener calls
                            method = callParams.shift();
                            if (typeof method != "function") alert(typeof method)
                            __this[ method ].apply( __this, callParams );
                          } else {
                            rejectedCalls.push( callParams ); // Send back to __callQueue
                          }
                        }
                        __this.__callQueue = rejectedCalls;
                    }
                }

                if (window.addEventListener){
                    window.addEventListener('iPaperReady', oniPaperReady, true);
                    window.addEventListener('docReady', onDocReady, true);
                    window.addEventListener('setupJsApi', onSetupJsApi, true);
                } else {
                    // No DOM 2 Support
                    __this.__addRoutedListener('iPaperReady', oniPaperReady);
                    __this.__addRoutedListener('docReady', onDocReady);
                    __this.__addRoutedListener('setupJsApi', onSetupJsApi);
                }
            },

            /* ---------------

            Note: Routed events are those which get routed through a globally defined method: window._scribd_event_handler_embedName()
            We define this method to allow message passing between iPaper and this particular scribd.Document instance. Only used
            for browsers which don't adhere to the DOM 2 event specification (IE).

            Workflow:
                1) Assign window._scribd_event_handler_embedName = this.__handleEvent, in this.write()
                2) Add any event listeners to this.__listenerLookup
                3) iPaper calls window._scribd_event_handler_embedName to trigger events, which get routed back through to this.__handleEvent
                4) Iterate through __listenerLookup, firing the appropriate callbacks

            ----------------- */

            __handleEvent: function( eventType ){
                var listeners = this.__listenerLookup[eventType] || [];
                for (var i=0; i<listeners.length; i++)
                {
                    listeners[i]();
                }
            },

            __addRoutedListener: function( eventType, callback ){

                if ( this.__listenerExists(eventType, callback) )
                    return;

                if (this.__listenerLookup[ eventType ]){
                    this.__listenerLookup[ eventType ].push(callback);
                } else {
                    this.__listenerLookup[ eventType ] = new Array( callback );
                }
            },

            __removeRoutedListener: function( eventType, callback ){
                var listeners = this.__listenerLookup[ eventType ];
                for (var i=0; i<listeners.length; i++ ){
                    if( listeners[i] == callback ){
                        listeners.splice(i, 1);
                    }
                }
            },

            __ensureEasyXDMLoad: function(){
                var easyXDM = document.getElementById('easyXDM');
                if (!easyXDM) {
                  var __this = this;
                  var easyXDM_script = document.createElement('script');
                  easyXDM_script.id = 'easyXDM';
                  easyXDM_script.src = 'http://' + this.params.get('domain') + '/javascripts/shared/vendor/easyXDM.js';
                  var head = document.getElementsByTagName('head')[0];
                  head.appendChild(easyXDM_script);
                }
            },

            __listenerExists: function( eventType, callback ){
                var listeners = this.__listenerLookup[ eventType ] || [];
                for ( var i=0; i<listeners.length; i++ ){
                    if (listeners[i] == callback) return true;
                }
                return false;
            },

            // jsonp -- to fetch data from the embeds controller and determine whether to write flash or html5

            __jsonp: function(url, callback){
              var head = document.getElementsByTagName('head')[0];
              var newScript = document.createElement('script');
              var callbackName = 'scribd_jsonp' + getRandomInt(0, 10000000);

              window[callbackName] = function(data){
                callback(data);
                window[callbackName] = undefined;
              };
              var newurl = url.replace(/(.*\?.*)(\?)/,'$1'+callbackName);
              newScript.src = newurl;
              head.appendChild(newScript);
              return newScript;
            },

            __uploadFromUrl: function() {
              url = ('https:' == document.location.protocol ? 'https://' : 'http://') + this.params.get('domain') + '/upload/auto?callback=?&urls='
                  + escape(this.params.get('url')) + '&from_jsapi=true';

              if (!this.params.get('public')) {
                 url += '&private=1';
              }
              if (this.params.get('publisher_id')) {
                url += '&scribd_publisher_id=' + this.params.get('publisher_id');
              }
              if (this.params.get('my_user_id')) {
                url += '&my_user_id=' + this.params.get('my_user_id');
              }
              if (this.params.get('extension')) {
                url += '&extension=' + this.params.get('extension');
              }
              if (this.params.get('title')) {
                url += '&title=' + this.params.get('title');
              }
              var __this = this;
              this.__jsonp(url, function(result){__this.__afterCreateDoc(result);});
            },

            // jsonp callback after a slurp for getDocFromUrl
            __afterCreateDoc: function(result) {
              if (result.success) {
                this.params.set('document_id', result.document_id);
                this.params.set('access_key', result.access_key);

                // reset the following params because if the 4gen doc isn't ready yet, we don't want the flash reader to re-slurp.
                this.params.set('upload_from_url', undefined);
                this.params.set('url', undefined);
                this.params.set('publisher_id', undefined);
                this.__getEmbedFormat();
              } else {
                this.getElement().innerHTML = '<span style="color:red;">Error: ' + result.message + '</span>';
              }
            },

            __getDefaultFormat: function() {

              // don't screw over pre-existing API embeds by automatically upgrading to html5 without them knowing.
              // If they don't specify a version or default embed format then default to flash.
              // starting from v2, default to html5

              if (this.params.get('default_embed_format') === undefined) {
                if (this.params.get('jsapi_version') === undefined || this.params.get('jsapi_version') < 2) {
                  this.params.set('default_embed_format', 'flash');
                } else {
                  this.params.set('default_embed_format', 'html5');
                }
              }
              return this.params.get('default_embed_format');
            },

            __getEmbedFormat: function() {
              url = ('https:' == document.location.protocol ? 'https://' : 'http://') + this.params.get('domain') + '/embeds/data/' + this.params.get('document_id') + '?callback=?';
              // Bonk is our affectionate name for the flash swf that replaces the old flash viewer.
              // It uses this API to determine whether or not we should show the HTML5 embed.
              // If this request is from a 'bonk', let the embed controller know
              url += '&host=' + location.hostname;

              if (this.params.get('bonk') === true) {
                url += '&bonk=true';
              }
              if (this.params.get('secret_password')) {
                url += '&secret_password=' + this.params.get('secret_password');
              }
              if (this.params.get('access_key')) {
                url += '&access_key=' + this.params.get('access_key');
              }
              default_format = this.__getDefaultFormat()
              if (default_format) {
                url += '&default_embed_format=' + default_format;
              }
              var __this = this;
              this.__jsonp(url, function(data){__this.__writeFormat(data);});

            },

            __writeFormat: function(jdata) {
              this.data = jdata.data;
              if (jdata.success === true && jdata.format === 'html5') {
                this.__writeHtml5(this.params.get('write_element_id'), this.params.get('replace'));
              } else if (jdata.success === true && jdata.format === 'flash') {
                  this.__writeFlash(this.params.get('write_element_id'), this.params.get('replace'));
              } else {
                // default to flash. TODO: display error?
                  this.__writeFlash(this.params.get('write_element_id'), this.params.get('replace'));
              }
            },

            __writeFlash: function(id, replace) {
              var element = this.getElement();
              if (element._cancel_bonk !== undefined){
                element._cancel_bonk();
                return;
              }
              var auto_width = element.offsetWidth;
              var view_mode = '';
              var flashVars = '';
              var embedHeight = '';

              // This quickswitch parameter is not documented, but I don't want to break anything
              // so I guess I will continue to support it, for flash at least =/
              var quickswitch = (this.params.get("quickswitch") == true);
              this.params.set('current_format', 'flash');

              if (quickswitch) {          
                 // create container at body level to avoid calling innerHTML on an element with an inline ancestor
                 var container = document.createElement('div');
                 container.style.width = "100%";
                 container.style.height = "100%";
                 document.body.appendChild(container);
              }

              if (this.params.get('width') && this.params.get('width') != "parent") {
                  auto_width = this.params.get('width');
              }
              if (this.params.get('mode')){
                  view_mode = this.params.get('mode');
                  flashVars += '&viewMode=' + escape(this.params.get('mode'));
              }

              if (this.params.get('height') != "parent") {
                   var auto_height = Math.round(auto_width * 11.0 / 8.5);
                   if (view_mode == 'slideshow')
                   {
                       auto_height = 35 + Math.round(auto_width * 3.0 / 4.0);
                   }

                   // Get height of page
                   var page_height = window.innerHeight != null
                           ? window.innerHeight
                           : document.documentElement && document.documentElement.clientHeight
                                   ? document.documentElement.clientHeight
                                   : document.body != null
                                           ? document.body.clientHeight
                                           : 0;

                   page_height -= 25; // some breathing room

                   // Bound the height
                   if (auto_height < 200) {
                       auto_height = 200;
                   }
                   if (auto_height > page_height) {
                       auto_height = page_height;
                   }

                   embedHeight = auto_height + "px";
              } else {
                   embedHeight = "100%";
              }

              var embedWidth = "100%";
              //var embedName = id + '_embed' + Math.round(Math.random() * 9e9);
              var srcString = "ScribdViewer";

              // port all of the options over from view.js

              // This defaults to true so we only need to handle explicit false cases
              // TODO: despite what the comments and documentation says, this doesn't actually DO anything....
              if (this.params.get('auto_size') !== true){
                  flashVars += '&auto_size=false';
              }

              if (this.params.get('height') && this.params.get('height') != "parent"){
                  embedHeight = this.params.get('height') + "px";
              }

              if (this.params.get('width') && this.params.get('width') != "parent"){
                  embedWidth = this.params.get('width') + "px";
              }

              // Params
              if (this.params.get('swf_name')){
                  srcString = this.params.get('swf_name');
              }

              if (this.params.get('disable_related_docs')){
                 flashVars += '&disable_related_docs=' + this.params.get('disable_related_docs');
              }

              if (this.params.get('page')){
                  flashVars += '&page=' + this.params.get('page');
              }

              if (this.params.get('extension')){
                 flashVars += '&extension=' + this.params.get('extension');
              }

              if (this.params.get('title')){
                  flashVars += '&title=' + escape(this.params.get('title'));
              }
              if (this.params.get('my_user_id')){
                  flashVars += '&my_user_id=' + this.params.get('my_user_id');
              }
              if (this.params.get('api_url')){
                  flashVars += '&api_url=' + this.params.get('api_url');
              }
              if (this.params.get('doctype')){
                  flashVars += '&doctype=' + this.params.get('doctype');
              }
              if (this.params.get('current_user_id')){
                  flashVars += '&current_user_id=' + this.params.get('current_user_id');
              }
              if (this.params.get('search_query')){
                  flashVars += '&search_query=' + escape(this.params.get('search_query'));
              }
              if (this.params.get('search_keywords')){
                  flashVars += '&search_keywords=' + escape(this.params.get('search_keywords'));
              }

              // what is this?
              if (this.params.get('transferCookie')==true){
                  flashVars += '&cookie=' + escape(document.cookie);
              }
              // and this?
              if (this.params.get('should_redirect')){
                  flashVars += '&should_redirect=' + this.params.get('should_redirect');
              }

              if (this.params.get('secret_password')){
                  flashVars += '&secret_password=' + this.params.get('secret_password');
              }

              if (this.params.get('public') == true){
                  flashVars += '&privacy=0';
              } else {
                  flashVars += '&privacy=1';
              }

              if (this.params.get('user_identifier')) {
                  flashVars += '&user_identifier=' + escape(this.params.get('user_identifier'));
              }
              if (this.params.get('secure_session_id')) {
                  flashVars += '&secure_session_id=' + escape(this.params.get('secure_session_id'));
              }
              if (this.params.get('signature')) {
                  flashVars += '&signature=' + this.params.get('signature');
              }
              if (this.params.get('docinfo')) {
                  //need to use encodeURIComponent for '+' and '/' in base64 encoding
                  flashVars += '&docinfo=' + encodeURIComponent(this.params.get('docinfo'));
              }
              if (this.params.get('useIntegratedUi')) {
                  flashVars += '&useIntegratedUi=' + this.params.get('useIntegratedUi');
              }

              // Document Attributes
              if (this.params.get('document_id')){
                  flashVars += '&document_id=' + this.params.get('document_id');
              }
              if (this.params.get('access_key')){
                  flashVars += '&access_key=' + this.params.get('access_key');
              }

              if (this.params.get('extension_id')){
                  flashVars += '&extension_id=' + this.params.get('extension_id');
              }
              if (this.params.get('url')){
                  flashVars += '&url=' + escape(this.params.get('url'));
              }
              if (this.params.get('publisher_id')){
                  flashVars += '&publisher_id=' + escape(this.params.get('publisher_id'));
              }

              var srcPath = "http://d1.scribdassets.com/";
              var protocol = "http://";

              if (this.params.get('use_ssl') === true) {
                  srcPath = "https://s3.amazonaws.com/documents.scribd.com/";
                  flashVars += "&use_ssl=true";
                  protocol = 'https://';
              }

              if (this.params.get('src_path')) {
                      srcPath = this.params.get('src_path');
              }
              if (this.params.get('hide_sample_banner')){
                  flashVars += '&hide_sample_banner=' + this.params.get('hide_sample_banner');
              }

              if (this.params.get('disable_resume_reading') == true){
                  flashVars += '&disable_resume_reading=true';
              }

              if (this.params.get('hide_full_screen_button') == true){
                  flashVars += '&hide_full_screen_button=true';
              }

              if (this.params.get('hide_disabled_buttons') == true){
                  flashVars += '&hide_disabled_buttons=true';
              }

              if (this.params.get('full_screen_type')){
                  flashVars += '&full_screen_type=' + this.params.get('full_screen_type');
              }

              if (this.params.get('custom_logo_image_url')) {
                  flashVars += '&custom_logo_image_url=' + escape(this.params.get('custom_logo_image_url'));
              }

              if (this.params.get('custom_logo_click_url')) {
                  flashVars += '&custom_logo_click_url=' + escape(this.params.get('custom_logo_click_url'));
              }

              flashVars += '&bonk=false';

               var embedString = Scribd_AC_RunActiveContent.Mod_AC_FL_RunContent(
                       'codebase', protocol + 'download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
                       'width', embedWidth,
                       'height', embedHeight,
                       'flashvars', flashVars,
                       'src', srcPath + srcString,
                       'quality', 'high',
                       'pluginspage', protocol + 'www.macromedia.com/go/getflashplayer',
                       'align', 'middle',
                       'play', 'true',
                       'loop', 'true',
                       'scale','showall',
                       'wmode', 'opaque',
                       'devicefont', 'false',
                       'id', this.params.get('embed_name'),
                       'bgcolor', '#ffffff',
                       'name', this.params.get('embed_name'),
                       'menu','true',
                       'allowFullScreen', 'true',
                       'allowScriptAccess','always',
                       'movie', srcPath + srcString,
                       'salign','');
               var flash_ok = Scribd_AC_RunActiveContent.DetectFlashVer(9,0,0);
               if (!flash_ok) {
                 embedString = '<div style="font-size:16px;width:300px;border:1px solid #dddddd;padding:3px">Hello, you have an old version of Adobe Flash Player. To use iPaper (and lots of other stuff on the web) you need to <a href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash">get the latest Flash player</a>.  </div>';
               }

               if(replace !== true) {

                 if(quickswitch) {
                    /* For QuickSwitch, we avoid calling innerHTML on an element that isn't
                    directly attached to the body. This avoids the IE issue where calling
                    innerHTML on a block element that has in its ancestry an inline element
                    will throw an exception */

                    // set container innerHTML, which is a direct child of body
                    container.innerHTML = embedString;

                    // delete all child nodes of element
                    if (element.hasChildNodes()) {
                        while (element.childNodes.length >= 1) {
                            element.removeChild(element.firstChild);
                        }
                    }

                    element.appendChild(container);

                 } else {
                   element.innerHTML = embedString;
                 }

               }
               else
               {
                   var span = document.createElement('span');
                   span.innerHTML = embedString;
                   element.parentNode.replaceChild(span,element);
               }

               this.__setupEvents();

            },

            __writeHtml5: function(id, replace) {
                this.params.set('current_format', 'html5');
                replace = replace || false;
                var el = this.getElement();
                if(!el){
                  throw 'Could not find element with id: ' + id;
                }

                var width, 
                    height, 
                    mode, 
                    out,
                    url_params = '';
                
                // If the width is not specified, we use the container's width
                width = this.params.get('width') ? this.params.get('width') : el.offsetWidth;
                
                if (this.params.get('mode')) {
                    mode = this.params.get('mode');
                    url_params += 'view_mode=' + mode + '&';
                }

                if(this.params.get('height')) {
                    height = this.params.get('height');
                } else {
                    if (mode === 'slideshow') {
                        height = 35 + Math.round(width * 3.0 / 4.0);
                    } else {
                        height = Math.round(width * 11.0 / 8.5);
                    }

                    // Get height of page
                    var page_height = window.innerHeight != null
                            ? window.innerHeight
                            : document.documentElement && document.documentElement.clientHeight
                                    ? document.documentElement.clientHeight
                                    : document.body != null
                                            ? document.body.clientHeight
                                            : 0;

                    page_height -= 25; // some breathing room

                    // Bound the height
                    if (height < 200) {
                        height = 200;
                    }
                    if (height > page_height) {
                        height = page_height;
                    }
                }

                /* url_params, domain, embed_url, this.params, width, height  */

                if (this.params.get('page')){
                    url_params += "start_page=" + this.params.get('page') + '&';
                }

                if (this.params.get('secret_password')){
                    url_params += "secret_password=" + escape(this.params.get('secret_password')) + '&';
                }else if (this.params.get('access_key')){
                    url_params += "access_key=" + escape(this.params.get('access_key')) + '&';
                }

                if (!this.params.get('bonk')){
                    url_params += "jsapi=true&";
                }

                var embed_url = ('https:' == document.location.protocol ? 'https://' : 'http://') + this.params.get('domain') +  "/embeds/" +
                                this.params.get('document_id') + "/content?" + url_params;
                this.params.set('embed_url', embed_url);

                if(replace){
                    this.__replaceWithIframe(el, width, height);
                } else {
                    if (easyXDM && easyXDM.Socket && easyXDM.stack) {
                      this.__insertIframe(el, width, height);
                    } else { // if easy XDM is not loaded yet, then load the iframe when it is ready.
                      var __this = this;
                      var interval_id = setInterval(function(){
                         if (easyXDM && easyXDM.Socket && easyXDM.stack) {
                            clearInterval(interval_id);
                            __this.__insertIframe(el, width, height);
                         }
                      }, 250); // 4 times a sec
                    }
                }
                this.__setupEvents();

            },

            __insertIframe: function(el, width, height){

                // if this is a JS API thing, set up easyXDM
                if (this.params.get('jsapi_version') !== undefined) {
                  this.params.set('zoom', 1);

                  el.innerHTML = "";
                  var __this = this;
                  this._socket = new easyXDM.Socket({
                     remote: this.params.get('embed_url'),
                     container: el,
                     onReady: function() {
                       var iframe = el.firstChild;
                       iframe.id = iframe.name = __this.params.get('embed_name');
                       iframe.setAttribute('class', 'scribd_iframe_embed');
                       iframe.setAttribute('data-auto-height', false);
                       iframe.setAttribute('scrolling', 'no');
                       iframe.frameBorder = 0;
                       __this.__setupApiForHtml5();
                     },
                     onMessage: function(message, origin) {
                       if (message) {
                         message = message.split(':');
                         if (message[0] === 'page') {
                            __this.params.set('page', message[1]);
                            __this.__fireEvent('pageChanged');
                         }
                         if (message[0] === 'docReady') {
                            // prevent race condition by making sure the event is set first
                            setTimeout( function() { __this.__fireEvent('docReady')}, 100 );
                         }
                         if (message[0] === 'zoom') {
                           __this.params.set('zoom', message[1]);
                           __this.__fireEvent('zoomChanged');
                         }
                       }
                     },
                     props: {
                       height: height,
                       width: width,
                       style: { border: "0" }
                     }
                  });

                // otherwise, just do a regular iframe
                } else {
                  out = '<iframe class="scribd_iframe_embed" src="' + this.params.get('embed_url');
                  out += '" id="' + this.params.get('embed_name');
                  out += '" name=' + this.params.get('embed_name');
                  out += '" data-auto-height="false" data-aspect-ratio="" scrolling="no" width="' + width;
                  out += '" height="' + height;
                  out += '" frameBorder="0" style="border:0;"></iframe>';
                  el.innerHTML = out;
                }
            },

            // this is only used for bonk, which would not be an API thing, so we'll leave the crazy XDM shit out of here.
            __replaceWithIframe: function(el, width, height){
                var i = document.createElement('iframe');
                i.className = 'scribd_iframe_embed';
                i.src = this.params.get('embed_url');
                i.setAttribute('data-auto-height', "false");
                i.setAttribute('data-aspect-ratio',"");
                i.scrolling="no";
                i.width=width;
                i.height=height;
                i.onload = "scribd_doc.__fireEvent('docReady');"
                i.frameBorder="0";
                i.style.border = "0";
                el.parentNode.replaceChild(i,el);
            },


            /* ---------------
                Public Methods
            ---------------- */


            write: function(id, replace) {

              // default to false
              if (replace === undefined) {
                 replace = false;
              }

              this.params.set('replace', replace);

              // if we are replacing, then we don't need to generate a unique name for the element.
              if (replace) { 
                this.params.set('embed_name', id);
              } else {
                this.params.set('write_element_id', id);
              }
              // unique identifier for this doc
              if (this.params.get('embed_name') === undefined) {
                 var name = 'scribd_' + Math.round(Math.random() * 9e9);
                 this.params.set('embed_name', name);
              }
              // if we have to upload the doc first, go ahead and do that before we add the embed *IF* we default to html5
              if (this.params.get('upload_from_url') && this.__getDefaultFormat() === 'html5') {
                this.__uploadFromUrl(); // if default format is flash we don't want to do this!!!
              } else {
                this.__getEmbedFormat();
              }
            },

            addParam: function(name, value) {
               this.params.set(name, value);
            },

            addEventListener: function( eventType, callback, optBubble ){
                if (this.api){
                    if (window.addEventListener){
                        if (this.api.isHtml5) {
                          var el = this.getElement();
                          el.addEventListener( eventType, callback, false );
                        } else {
                          this.api.parentNode.addEventListener( eventType, callback, false );
                        }
                    } else {
                        this.__addRoutedListener( eventType, callback );
                    }
                } else {
                    this.__callQueue.push(["addEventListener", eventType, callback, false]);
                }
            },

            removeEventListener: function( eventType, callback ){
                if (this.api){
                    if (window.addEventListener){
                        if (this.api.isHtml5) {
                          var el = this.getElement();
                          el.removeEventListener( eventType, callback, false );
                        } else {
                          this.api.removeEventListener( eventType, callback, false );
                        }
                    } else {
                        this.__removeRoutedListener( eventType, callback );
                    }
                } else {
                    this.__callQueue.push(["removeEventListener", eventType, callback]);
                }
            },

            getFormat: function() {
               return this.params.get('current_format');
            },

            // this isn't in the api doc, but it's useful.
            getElement: function () {
                var el = document.getElementById(this.params.get('embed_name'));
                if (!el) {
                  el = document.getElementById(this.params.get('write_element_id'));
                }
                return el;
            },

            // also not in the api doc. what is this for?
            grantAccess: function(user_identifier, secure_session_id, signature) {
                this.params.get('user_identifier') = user_identifier;
                this.params.get('secure_session_id') = secure_session_id;
                this.params.get('signature') = signature;
            },

            // api
            /*
              NOTE: 
              
              There's an open question about how we can implement the equivalent iPaper api object.
              Since the iframe is on a different domain, we run into non-trivial cross domain issues.
              We can get around that by using various techniques. A common one is to fiddle with the url hash
              param of the iframe, and the javascript in content.js can detect the hash changes.
              
              For example, api.setZoom could apply the following hash:
              
              #zoom=2
              
              And content.js would detect it and zoom to 2.
              
              There is also the problem of reading data from the embed, like with api.getZoom.
              This could also be solved via passing info through the hash, and the javascript
              on the embeder's page could detect the change. 
              
              However, there are performance issues with this, as polling is the only method
              that works consistently across browsers, and having multiple embeds on a page
              polling for hash change events is not desirable. 
              
            */
            __setupApiForHtml5: function() {
               var __this = this;
               this.api = {
                  isHtml5: true,
                  getPageCount: function() {
                     return __this.data.pages;
                  },
                  getPage: function() {
                     var page = __this.params.get('page');
                     if (page === undefined) { page = 1; }
                     return page;
                  },
                  setPage: function( pageNumber ) {
                     if (pageNumber > __this.data.pages) {
                       pageNumber = __this.data.pages;
                     } else if (pageNumber < 1) {
                       pageNumber = 1;
                     }
                     __this._socket.postMessage("page:" + pageNumber);
                  },
                  getDocumentId: function() {
                     return __this.params.get('document_id');
                  },
                  loadDocument: function( document_id, access_key ) {
                     __this.params.set('document_id', document_id);
                     __this.params.set('access_key', access_key);
                     __this.write(__this.params.get('write_element_id'), __this.params.get('replace'));
                  },
                  getViewMode: function() {
                     mode = __this.params.get('mode');
                     if (mode === undefined) { mode = __this.data.view_mode; } // get doc default view mode if no default is set through API
                     return mode;
                  },
                  getTitle: function() {
                     return __this.data.title;
                  },
                  getAuthorId: function() {
                     return __this.data.author_id;
                  },
                  getAuthorName: function() {
                     return __this.data.author_name;
                  },
                  getZoom: function() {
                     return __this.params.get('zoom');
                  },
                  setZoom: function( zoomFactor ) {
                     __this._socket.postMessage('zoom:' + zoomFactor);
                  },

                  // Functions that are NOT SUPPORTED for HTML5

                  // doesn't really work for flash anyway
                  loadDocumentFromUrl: function( url, publisher_id ) {
                     // stub
                  },
                  // Currently, getEmbedCode DOESN'T work for Flash, so we won't be supporting this.
                  getEmbedCode: function() {
                     // stub
                  },
                  getVerticalScroll: function() {
                     // stub
                  },
                  setVerticalScroll: function( scrollPosition ) {
                     // stub
                  },
                  getHorizontalScroll: function() {
                     // stub
                  },
                  setHorizontalScroll: function( scrollPosition ) {
                     // stub
                  },
                  getFullscreen: function() {
                     // stub
                  },
                  setFullscreen: function( fullscreen ) {
                     // stub
                  }
               };
               this.__fireEvent('setupJsApi');
            }
        };

        //////////////////////////////////////////////////////////////////////////////
        
        Document.getDoc = function(document_id, access_key) {
            return new Document({ document_id: document_id, access_key: access_key });
        };

        Document.getDocFromUrl = function(url, publisher_id) {
            return new Document({ url: url, publisher_id: publisher_id, upload_from_url: true })
        };

        // What does this do?
        Document.getDocFromUrlForExtension = function(url, extension_id) {
            // stub
        };
        
        window.scribd = {
            Document: Document,
            _api_version: 2
        };

        // Flash stuff
        var Scribd_AC_RunActiveContent = new function(){

            /* ------------------------
                AC_RunActiveContent

                Modified to return the embed string, rather than use document.write - modified functions prefixed with 'Mod_'
                Implied consent for use: http://www.adobe.com/devnet/activecontent/articles/devletter.html

            -------------------------- */

            // v1.7
            // Flash Player Version Detection
            // Detect Client Browser type
            // Copyright 2005-2007 Adobe Systems Incorporated.  All rights reserved.
            var isIE  = (navigator.appVersion.indexOf("MSIE") != -1) ? true : false;
            var isWin = (navigator.appVersion.toLowerCase().indexOf("win") != -1) ? true : false;

            var isOpera = (navigator.userAgent.indexOf("Opera") != -1) ? true : false;

            this.ControlVersion = function()
            {
                var version;
                var axo;
                var e;

                // NOTE : new ActiveXObject(strFoo) throws an exception if strFoo isn't in the registry

                try {
                    // version will be set for 7.X or greater players
                    axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");
                    version = axo.GetVariable("$version");
                } catch (e) {
                }

                if (!version)
                {
                    try {
                        // version will be set for 6.X players only
                        axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");

                        // installed player is some revision of 6.0
                        // GetVariable("$version") crashes for versions 6.0.22 through 6.0.29,
                        // so we have to be careful.

                        // default to the first public version
                        version = "WIN 6,0,21,0";

                        // throws if AllowScripAccess does not exist (introduced in 6.0r47)
                        axo.AllowScriptAccess = "always";

                        // safe to call for 6.0r47 or greater
                        version = axo.GetVariable("$version");

                    } catch (e) {
                    }
                }

                if (!version)
                {
                    try {
                        // version will be set for 4.X or 5.X player
                        axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.3");
                        version = axo.GetVariable("$version");
                    } catch (e) {
                    }
                }

                if (!version)
                {
                    try {
                        // version will be set for 3.X player
                        axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.3");
                        version = "WIN 3,0,18,0";
                    } catch (e) {
                    }
                }

                if (!version)
                {
                    try {
                        // version will be set for 2.X player
                        axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
                        version = "WIN 2,0,0,11";
                    } catch (e) {
                        version = -1;
                    }
                }

                return version;
            };

            // JavaScript helper required to detect Flash Player PlugIn version information
            this.GetSwfVer = function(){
                // NS/Opera version >= 3 check for Flash plugin in plugin array
                var flashVer = -1;

                if (navigator.plugins !== null && navigator.plugins.length > 0) {
                    if (navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"]) {
                        var swVer2 = navigator.plugins["Shockwave Flash 2.0"] ? " 2.0" : "";
                        var flashDescription = navigator.plugins["Shockwave Flash" + swVer2].description;
                        var descArray = flashDescription.split(" ");
                        var tempArrayMajor = descArray[2].split(".");
                        var versionMajor = tempArrayMajor[0];
                        var versionMinor = tempArrayMajor[1];
                        var versionRevision = descArray[3];
                        if (versionRevision === "") {
                            versionRevision = descArray[4];
                        }
                        if (versionRevision[0] == "d") {
                            versionRevision = versionRevision.substring(1);
                        } else if (versionRevision[0] == "r") {
                            versionRevision = versionRevision.substring(1);
                            if (versionRevision.indexOf("d") > 0) {
                                versionRevision = versionRevision.substring(0, versionRevision.indexOf("d"));
                            }
                        }
                        flashVer = versionMajor + "." + versionMinor + "." + versionRevision;
                    }
                }
                // MSN/WebTV 2.6 supports Flash 4
                else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.6") != -1) flashVer = 4;
                // WebTV 2.5 supports Flash 3
                else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.5") != -1) flashVer = 3;
                // older WebTV supports Flash 2
                else if (navigator.userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 2;
                else if ( isIE && isWin && !isOpera ) {
                    flashVer = this.ControlVersion();
                }
                return flashVer;
            };

            // When called with reqMajorVer, reqMinorVer, reqRevision returns true if that version or greater is available
            this.DetectFlashVer = function(reqMajorVer, reqMinorVer, reqRevision)
            {
                versionStr = this.GetSwfVer();
                if (versionStr == -1 ) {
                    return false;
                } else if (versionStr !== 0) {
                    if(isIE && isWin && !isOpera) {
                        // Given "WIN 2,0,0,11"
                        tempArray         = versionStr.split(" ");  // ["WIN", "2,0,0,11"]
                        tempString        = tempArray[1];           // "2,0,0,11"
                        versionArray      = tempString.split(",");  // ['2', '0', '0', '11']
                    } else {
                        versionArray      = versionStr.split(".");
                    }
                    var versionMajor      = versionArray[0];
                    var versionMinor      = versionArray[1];
                    var versionRevision   = versionArray[2];

                        // is the major.revision >= requested major.revision AND the minor version >= requested minor
                    if (versionMajor > parseFloat(reqMajorVer)) {
                        return true;
                    } else if (versionMajor == parseFloat(reqMajorVer)) {
                        if (versionMinor > parseFloat(reqMinorVer))
                            return true;
                        else if (versionMinor == parseFloat(reqMinorVer)) {
                            if (versionRevision >= parseFloat(reqRevision))
                                return true;
                        }
                    }
                    return false;
                }
            };

            this.AC_AddExtension = function(src, ext)
            {
              if (src.indexOf('?') != -1)
                return src.replace(/\?/, ext+'?');
              else
                return src + ext;
            };

            this.Mod_AC_Generateobj = function(objAttrs, params, embedAttrs)
            {
              var str = '';
              if (isIE && isWin && !isOpera)
              {
                str += '<object ';
                for (var i in objAttrs)
                {
                  str += i + '="' + objAttrs[i] + '" ';
                }
                str += '>';
                for (var i in params)
                {
                  str += '<param name="' + i + '" value="' + params[i] + '" /> ';
                }
                str += '</object>';
              }
              else
              {
                str += '<embed ';
                for (var i in embedAttrs)
                {
                  str += i + '="' + embedAttrs[i] + '" ';
                }
                str += '> </embed>';
              }

              return str;
            };

            this.Mod_AC_FL_RunContent = function(){
              var ret = this.Mod_AC_GetArgs( arguments, ".swf", "movie", "clsid:d27cdb6e-ae6d-11cf-96b8-444553540000", "application/x-shockwave-flash" );

              return this.Mod_AC_Generateobj(ret.objAttrs, ret.params, ret.embedAttrs);
            };

            this.Mod_AC_SW_RunContent = function(){
              var ret =
                this.Mod_AC_GetArgs
                (  arguments, ".dcr", "src", "clsid:166B1BCA-3F9C-11CF-8075-444553540000",
                   null
                );
              return this.Mod_AC_Generateobj(ret.objAttrs, ret.params, ret.embedAttrs);
            };

            this.Mod_AC_GetArgs = function(args, ext, srcParamName, classid, mimeType){
              var ret = {};
              ret.embedAttrs = {};
              ret.params = {};
              ret.objAttrs = {};
              for (var i=0; i < args.length; i=i+2){
                var currArg = args[i].toLowerCase();

                switch (currArg){
                  case "classid":
                    break;
                  case "pluginspage":
                    ret.embedAttrs[args[i]] = args[i+1];
                    break;
                  case "src":
                  case "movie":
                    args[i+1] = this.AC_AddExtension(args[i+1], ext);
                    ret.embedAttrs["src"] = args[i+1];
                    ret.params[srcParamName] = args[i+1];
                    break;
                  case "onafterupdate":
                  case "onbeforeupdate":
                  case "onblur":
                  case "oncellchange":
                  case "onclick":
                  case "ondblclick":
                  case "ondrag":
                  case "ondragend":
                  case "ondragenter":
                  case "ondragleave":
                  case "ondragover":
                  case "ondrop":
                  case "onfinish":
                  case "onfocus":
                  case "onhelp":
                  case "onmousedown":
                  case "onmouseup":
                  case "onmouseover":
                  case "onmousemove":
                  case "onmouseout":
                  case "onkeypress":
                  case "onkeydown":
                  case "onkeyup":
                  case "onload":
                  case "onlosecapture":
                  case "onpropertychange":
                  case "onreadystatechange":
                  case "onrowsdelete":
                  case "onrowenter":
                  case "onrowexit":
                  case "onrowsinserted":
                  case "onstart":
                  case "onscroll":
                  case "onbeforeeditfocus":
                  case "onactivate":
                  case "onbeforedeactivate":
                  case "ondeactivate":
                  case "type":
                  case "codebase":
                  case "id":
                    ret.objAttrs[args[i]] = args[i+1];
                    ret.embedAttrs[args[i]] = args[i+1];
                    break;
                  case "width":
                  case "height":
                  case "align":
                  case "vspace":
                  case "hspace":
                  case "class":
                  case "title":
                  case "accesskey":
                  case "name":
                  case "tabindex":
                    ret.embedAttrs[args[i]] = ret.objAttrs[args[i]] = args[i+1];
                    break;
                  default:
                    ret.embedAttrs[args[i]] = ret.params[args[i]] = args[i+1];
                }
              }
              ret.objAttrs["classid"] = classid;
              if (mimeType) ret.embedAttrs["type"] = mimeType;
              return ret;
            };

            // call callback function if defined
            // this is used so we make sure view.js is loaded before calling
            // other code that depends on it
            if(typeof scribd_view_callback != "undefined") {
                scribd_view_callback();
            }
          };
    }
})(window);
if(window._on_scribd_load !== undefined){
  var i;
  var fxs = window._on_scribd_load;
  window._on_scribd_load = undefined;
  for(i=0;i< fxs.length;i++){
    fxs[i]();
  }
}
