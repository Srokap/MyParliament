<div class="s_header_cont"> 
  <div class="s_main_menu_cont_div">
    <div class="s_wrap">
      <div class="s_menu_div aoverflow">
       
       <div class="lalgin lfloat">
        
        
       
			    <ul>
            {section name="front_menu" loop=$M.FRONT_MENU}{assign var="m" value=$M.FRONT_MENU[front_menu]}
		          <li{if $m.s} class="s"{/if}><a{if $m.dom_id} id="{$m.dom_id}"{/if} href="/{$m.url}">{$m.name}</a></li>
	          {/section}
	        </ul>

          
        </div><div class="ralign rfloat">
          
          {if $M.isLogged}
            <ul>
              {if $M.isAdmin }
		            <li><a href="{$M.SITE_ROOT}admin">Administration</a></li>
		          {/if}
		          <li id="_USER_LI" class="s_user_li{if $M.FRONT_MENU_SELECTED eq 'user'} s{/if}">
		            <a id="_USER_OPTIONS_A" href="{$M.SITE_ROOT}konto"><span>Account</span><img src="{$SITE_ROOT}g/p.gif" /></a>
		            <ul id="_USER_LINKS_UL" class="_USER_LINKS_UL left">
				          <li class="h"><a href="{$M.SITE_ROOT}konto">Preferences</a></li>
				          <li class="h"><a href="{$M.SITE_ROOT}logout">Logout</a></li>
				        </ul>
		          </li>
		        </ul>	            
            
		      {else}
		        <ul>
		          <li class="h{if $M.FRONT_MENU_SELECTED eq 'zaloguj'} s{/if}"><a href="{$M.SITE_ROOT}zaloguj">Sign in</a></li>
		          <li class="h{if $M.FRONT_MENU_SELECTED eq 'rejestracja'} s{/if}"><a href="{$M.SITE_ROOT}rejestracja">Sign up</a></li>
		        </ul>
          {/if}
          
        </div>
      </div>
	  </div>
  </div>
</div>