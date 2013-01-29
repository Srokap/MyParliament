<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">  
    <head profile="http://www.w3.org/2005/10/profile">
    <script>
      {literal}
      function go(){
      {/literal}
        location = '{$redirection|default:"/"}';
      {literal}
      }
      window.fbAsyncInit = function(){
	      FB.init({appId: '144885868891893', status: true, cookie: true, xfbml: false});
	      go();
			};
			{/literal}
    </script>
  </head>
  <body style="text-align: center;">
    Logowanie... 
    <div id="fb-root"></div>  
    <script> 
			{literal}
		  (function() {
		    var e = document.createElement('script');
		    e.async = true;
		    e.src = document.location.protocol + '//connect.facebook.net/pl_PL/all.js';
		    document.getElementById('fb-root').appendChild(e);
		  }());
		  {/literal}
	  </script>
  </body>
</html>