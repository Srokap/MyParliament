{$i.date|kalendarzyk}
<div class="c">
  <p class="h">
	    
    {$i.poslowie_str}
    {if $i.poslowie_count eq 1}
      {assign var="posel_nid" value=$i.poslowie_nids.0}
      {assign var="posel" value=$aktualnosci.poslowie.$posel_nid}
      {if $posel.plec eq 'K'}zgłosiła{else}zgłosił{/if} interpelację:
    {else}
      {if $i.kobiety}zgłosiły{else}zgłosili{/if} interpelację:
    {/if}
  
  </p>
  <a href="/interpelacja/{$i.eid}"><img src="/g/p.gif" class="ikonka" /></a>
  <div class="cc">
	  <p class="t"><a href="/interpelacja/{$i.eid}">{$i.title}</a></p>
  </div>
</div>