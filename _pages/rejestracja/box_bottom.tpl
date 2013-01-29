<div class="_SIDE_DIV"> 
  <div class="_MENU">
    {section name="_MENU" loop=$_MENU}{assign var="m" value=$_MENU[_MENU]}
	    <a href="/start/{$m.id}"{if $m.selected} class="selected"{/if}>{$m.label}</a>
    {/section}
  </div>
</div>

<div class="_MAIN_DIV">
  {include file="tabs/"|cat:$_SUBPAGE|cat:".tpl"}
</div>