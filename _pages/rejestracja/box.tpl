<div id="side_div">
  
  <div class="identity_div">
    <img class="avatar" src="https://graph.facebook.com/{$M.USER.fb_id}/picture">
    <p>{$M.USER.name}</p>
  </div>
  
  <div class="menu">
    {section name="menu" loop=$menu}{assign var="m" value=$menu[menu]}
	    <a href="/konto/{$m.id}"{if $m.selected} class="selected"{/if}>{$m.label}</a>
    {/section}
  </div>
  
</div>

<div id="main_div">
  {include file=$_SUBPAGE|cat:".tpl"} 
</div>