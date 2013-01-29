{$i.date|kalendarzyk}
<div class="c">
  <p class="h">
	    
    {$i.poslowie_str}
    {if $i.poslowie_count eq 1}
      {assign var="posel_nid" value=$i.poslowie_nids.0}
      {assign var="posel" value=$aktualnosci.poslowie.$posel_nid}
      {if $posel.plec eq 'K'}wniosła{else}wniósł{/if} do Sejmu projekt:
    {else}
      {if $i.kobiety}wniosły{else}wnieśli{/if} do Sejmu projekt:
    {/if}
  
  </p>
  {if $i.dokument_id}<a class="dokument d" href="/projekt/{$i.eid},{$i.url_title}"><img class="d" dokument_id="{$i.dokument_id}" src="/d/3/{$i.dokument_id}.gif" /><span class="druk_nr">druk nr <b>{$i.numer}</b></span></a>{/if}
  <div class="cc projekt">
	  <p class="t"><a href="/projekt/{$i.eid},{$i.url_title}">{$i.title}</a></p>
	  <div class="autorstatus">
		  <p><span class="label">Autor: </span><span class="a">{$i.autor}</span></p>
	  </div>
	  <p>{$i.opis}</p>
  </div>
</div>