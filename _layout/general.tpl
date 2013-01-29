<div id="_TOPBAR"></div>
<div id="_MAIN_CONTAINER"{if $M.FULLSCREEN} class="FULLSCREEN"{/if}>
  
  <div id="_HEADER">
    <h1 id="_LOGO"><a href="/">OchParliament</a></h1>
    <div id="_TOP_NAV_RIGHT">
      <div id="_SEARCH_BAR">&nbsp;</div>
      <ul id="_SMALL_NAV_BAR">
        <li><span class="login">{$M.USER.name}</span></li>
        <li><a href="/admin">Panel</a></li>
        {include file="/_layout/liczniki_div.tpl"}
        <li><a href="{$M.logoutUrl}">Wyloguj</a></li>
      </ul>
    </div>
  </div>
  
  <div id="_CONTENT">
    <div id="_CONTENT_INNER">
      <div id="_COL_LEFT">
        <div id="_MENU">
          {$M.MENU_HTML}
        </div>
      </div>
      <div id="_COL_RIGHT">
        {$M.PAGE_HTML}
      </div>
    </div>
  </div>
    
</div>
