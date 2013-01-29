<div class="s_header_cont"> 
  <div class="s_main_menu_cont_div">
    <div class="s_wrap">
      <div class="s_ochparliament_icon_div"><a title="Strona startowa" href="{$M.SITE_ROOT}start"><img alt="Logo OchParliament" src="{$SITE_ROOT}g/p.gif" class="ochparliament_icon" /></a></div>
      <div class="s_menu_div aoverflow">
       <div class="ralign rfloat">
          
          {if $M.isLogged}
            <ul>
              {if $M.isAdmin }
		            <li><a href="{$M.SITE_ROOT}admin">Admin</a></li>
		          {/if}
		          <li id="_USER_LI" class="s_user_li{if $M.FRONT_MENU_SELECTED eq 'user'} s{/if}">
		            <a id="_USER_OPTIONS_A" href="{$M.SITE_ROOT}konto"><span>{$M.USER.name|default:"Ja"}</span><img src="{$SITE_ROOT}g/p.gif" /></a>
		            <ul id="_USER_LINKS_UL" class="_USER_LINKS_UL left">
				          <li class="h"><a href="{$M.SITE_ROOT}konto">Konto</a></li>
				          <li class="h"><a href="{$M.SITE_ROOT}logout">Wyloguj</a></li>
				        </ul>
		          </li>
		        </ul>	            
            
		      {else}
		        <ul>
		          <li class="h{if $M.FRONT_MENU_SELECTED eq 'zaloguj'} s{/if}"><a href="{$M.SITE_ROOT}zaloguj">Zaloguj</a></li>
		          <li class="h{if $M.FRONT_MENU_SELECTED eq 'rejestracja'} s{/if}"><a href="{$M.SITE_ROOT}rejestracja">Zarejestruj</a></li>
		        </ul>
          {/if}
          
        </div>
      </div>
	  </div>
  </div>
</div>