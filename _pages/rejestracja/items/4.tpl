{$i.date|kalendarzyk}
<div class="c">
  <p class="h">
	    
    {$i.poslowie_str}
    {if $i.poslowie_count eq 1}
      {assign var="posel_nid" value=$i.poslowie_nids.0}
      {assign var="posel" value=$aktualnosci.poslowie.$posel_nid}
      {if $posel.plec eq 'K'}zagłosowała{else}zagłosował{/if} niezgodnie z linią swojego klubu:
    {else}
      {if $i.kobiety}zagłosowały{else}zagłosowali{/if} niezgodnie z linią swoich klubów:
    {/if}
  
  </p>
  <a href="/glosowania/{$i.eid}?a={$posel.id}"><img src="/g/p.gif" class="ikonka" /></a>
  <div class="cc">
	  <p class="t"><a href="/glosowania/{$i.eid}?a={$posel.id}">{$i.title}</a></p>
	  
	  {section name="glosowania_poslowie" loop=$i.glosowania_poslowie}{assign var="gp" value=$i.glosowania_poslowie[glosowania_poslowie]}
      <div class="stats">
		    <div class="glosowania">
		      {section name="glosowania" loop=$gp.glosowania}
				    {assign var="data" value=$gp.glosowania[glosowania]}
				    {glosowanie data=$data}
				  {/section}
		    </div>
		  </div>
    {/section}
	  
	  
  </div>
</div>