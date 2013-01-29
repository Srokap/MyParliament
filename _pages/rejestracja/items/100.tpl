{$i.date|kalendarzyk}
<div class="c">
  <p class="h">
	    
    {$i.poslowie_str}
    {if $i.poslowie_count eq 1}
      {assign var="posel_nid" value=$i.poslowie_nids.0}
      {assign var="posel" value=$aktualnosci.poslowie.$posel_nid}
      {if $posel.plec eq 'K'}zginęła{else}zginął{/if} 
    {else}
      {if $i.kobiety}zginęły{else}zginęli{/if} 
    {/if} w <a href="http://pl.wikipedia.org/wiki/Katastrofa_polskiego_Tu-154_w_Smole%C5%84sku" target="_blank">katastrofie smoleńskiej.</a>
  
  </p>
</div>