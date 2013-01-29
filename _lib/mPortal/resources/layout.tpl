<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html{if $M.LAYOUT ne 'blank'} style="background: url('{$M.SITE_ROOT}g/_page_bg_pattern.gif') repeat scroll 0 0 #EEEEEE;"{/if}>
  <head profile="http://www.w3.org/2005/10/profile">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    {section name="META" loop=$M.META}
      <META {if $M.META[META][2]}PROPERTY{else}NAME{/if}="{$M.META[META][0]}" CONTENT="{$M.META[META][1]|escape}">
    {/section}
    
    <title>{if $M.FORCE_TITLE}{$M.FORCE_TITLE|@strip_tags}{else}{$M.TITLE|@strip_tags|escape} {if $M.TITLE}| {/if}{$M.DEFAULT_PAGE_TITLE|@strip_tags}{/if}</title>
    {if $M.REL.prev}<link rel="prev" href="{$M.REL.prev}" />{/if}
    {if $M.REL.next}<link rel="next" href="{$M.REL.next}" />{/if}
    
    {if $M.FORCE_ICON}<link rel="icon" type="image/png" href="{$M.SITE_ROOT}g/{$M.FORCE_ICON}.png" />{else}<link rel="icon" type="image/ico" href="{$SITE_ROOT}g/sejmometr_32_tecza_s.ico" />{/if}
    
    
    <link rel="stylesheet" href="{$M.SITE_ROOT}cssLibs/engine-{$M.STAMPS.engine_css}.css" type="text/css">
    
    {if $M.isAdmin}
      <link rel="stylesheet" href="{$M.SITE_ROOT}cssLibs/engine-admin-{$M.STAMPS.engine_admin_css}.css" type="text/css">
    {/if}
    
	  {section name=sheets loop=$M.CSSLIBS}<link rel="stylesheet" href="{$M.SITE_ROOT}cssLibs/{$M.CSSLIBS[sheets]}" type="text/css">{/section}
    {if $M.cssFile}<link rel="stylesheet" href="{$M.SITE_ROOT}css/{$M.ID}-{$M.STAMPS.css}.css" type="text/css">{/if}
    {if $M.cssInline}<style>{include file=$M.NAME|cat:"-inline.css"}</style>{/if}
    
    <!--[if IE 7]>
		<link rel="stylesheet" href="/css/ie7.css" type="text/css" />		
		<![endif]-->
    <!--[if IE 8]>
		<link rel="stylesheet" href="/css/ie8.css" type="text/css" />		
		<![endif]-->
    
    {section name=links loop=$M.LINKS}<link href="{$M.LINKS[links].href}" title="{$M.LINKS[links].title}" type="{$M.LINKS[links].type}" rel="{$M.LINKS[links].rel}">{/section}
    
    <script type="text/javascript">
      var CURRENT_PAGE = '{$M.ID}';
      var _LANG = '{$M.LANG}';
			var _PAGEDATA = {ldelim}'ID':'{$M.ID}', 'NAME':'{$M.NAME}'{if $M.goHomeOnLogin}, 'goHomeOnLogin': true{/if}{rdelim};
						
			var _LOGGED = {if $M.isLogged}true{else}false{/if};
			{if $M.isLogged}
			  var _LOGGED_TYPE = '{$M.USER.type}';
			{/if}
			
			{if $M.isAdmin}
			  var _ADMIN = true;			  
			{/if}
	  </script>
	  <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  </head>
  
  <body class="_layout_new {$M.LAYOUT}{if $M.BREAD_CRUMBS} bc{/if}{if $M.FULLSCREEN} _FULLSCREEN{/if}">
    <div id="fb-root"></div>

    {literal}
    
   
	  <!--[if IE 6]>
		<script type="text/javascript"> 
			/*Load jQuery if not already loaded*/ if(typeof jQuery == 'undefined'){ document.write("<script type=\"text/javascript\"   src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js\"></"+"script>"); var __noconflict = true; } 
			var IE6UPDATE_OPTIONS = {
				icons_path: "/ie6update/images/"
			}
		</script>
		<script type="text/javascript" src="/ie6update/ie6update.js"></script>
		<![endif]-->
		{/literal}
    <div id="_OVERLAY" style="display: none;"></div>
    
    
    {include file=$M.ROOT|cat:"/_layout/"|cat:$M.LAYOUT|cat:".tpl"}
    
    
    <div id="_LIGHTBOXES">
    </div>
    
    <script type="text/javascript">
      {literal}
      var _FB_INIT_DATA = {
		    appId      : '{/literal}{$M.FB_APP_ID}{literal}', // App ID
		    channelUrl : '//{$M.SITE_ADDRESS}/channel.html', // Channel File
		    status     : true, // check login status
		    cookie     : true, // enable cookies to allow the server to access the session
		    oauth      : true, // enable OAuth 2.0
		    xfbml      : true  // parse XFBML
		  };
		  {/literal}
    </script>
    
    {if $M.jsConfig || $M.disqus_url}
      <script type="text/javascript">
        {if $M.jsConfig}{include file=$M.NAME|cat:"-inline-config.js"}{/if}
        {if $M.disqus_url}
          {literal}var{/literal} disqus_shortname = 'ochparliament';
					{literal}var{/literal} disqus_identifier = '{$M.disqus_identifier|default:$M.disqus_url}';
					{literal}var{/literal} disqus_url = '{$SITE_ADDRESS}{$M.disqus_url}';
        {/if}
      </script>
    {/if}
    
    <script type="text/javascript" src="{$M.SITE_ROOT}jsLibs/engine-{$M.STAMPS.engine_js}.js"></script>
    {section name=EXTERNALJSSLIBS loop=$M.EXTERNALJSSLIBS}<script type="text/javascript" src="{$M.EXTERNALJSSLIBS[EXTERNALJSSLIBS]}"></script>{/section}
    
    {if $M.isAdmin}
      <script type="text/javascript" src="{$M.SITE_ROOT}jsLibs/engine-admin{if $smarty.request.DONT_MINIFY neq 1}-{$M.STAMPS.engine_admin_js}{/if}.js"></script>
    {/if}
    
    {section name=scripts loop=$M.JSLIBS}<script type="text/javascript" src="/jsLibs/{$M.JSLIBS[scripts]}"></script>{/section}
    {if $M.jsFile}<script type="text/javascript" src="{$M.SITE_ROOT}js/{$M.ID}-{$M.STAMPS.js}.js"></script>{/if}
    
    <script type="text/javascript">
			{if $M.jsInline}{include file=$M.NAME|cat:"-inline.js"}{/if}				
			
			{if $M.google_maps}
			{literal}
			var script = document.createElement("script");
		  script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyCWTe-IcZTMpn2HyG3OaTGKla7SY72ddx8&sensor=false&libraries=geometry&callback=_google_maps_initialize";
		  script.type = "text/javascript";
		  document.getElementsByTagName("head")[0].appendChild(script);
			{/literal}
			{/if}
			
			{literal}
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	  </script>
		<script type="text/javascript">try { var pageTracker = _gat._getTracker("UA-3303173-6"); pageTracker._trackPageview(); } catch(err) {}
		  {/literal}  
		</script>
		<div id="__LIGHTBOXES">
    </div>
  </body>
</html>