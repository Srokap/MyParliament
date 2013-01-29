{$i.date|kalendarzyk}
{if $i.debata_typ_id eq '6'}

  <div class="c">
	  <p class="h">
	    
	    {$i.poslowie_str}
	    {if $i.poslowie_count eq 1}
	      {assign var="posel_nid" value=$i.poslowie_nids.0}
	      {assign var="posel" value=$aktualnosci.poslowie.$posel_nid}
	      {if $posel.plec eq 'K'}złożyła{else}złożył{/if} oświadczenie:
	    {else}
	      {if $i.kobiety}złożyły{else}złożyli{/if} oświadczenia:
	    {/if}
	  
	  </p>
	  <a href="/wypowiedz/{$o.id}"><img src="/g/p.gif" class="ikonka" /></a>
	  <div class="cc">
	  
	    {section name="oswiadczenia_poslowie" loop=$i.oswiadczenia_poslowie}{assign var="op" value=$i.oswiadczenia_poslowie[oswiadczenia_poslowie]}
	      <div class="stats">
			    <a href="/{$op.posel_id}"><img class="avatar" src="/l/3/{$op.posel_id}.jpg" /></a>
			    {section name="oswiadczenia" loop=$op.oswiadczenia}{assign var="o" value=$op.oswiadczenia[oswiadczenia]}
			      <p>{$o.skrot} <a href="/wypowiedz/{$o.id}">czytaj dalej &raquo;</a></p>
			    {/section}
			  </div>
	    {/section}
	  
		  
	  </div>
	</div>

{else}

	<div class="c">
	  <p class="h">
	    
	    {$i.poslowie_str}
	    {if $i.poslowie_count eq 1}
	      {assign var="posel_nid" value=$i.poslowie_nids.0}
	      {assign var="posel" value=$aktualnosci.poslowie.$posel_nid}
	      {if $posel.plec eq 'K'}wzięła{else}wziął{/if} udział w debacie:
	    {else}
	      {if $i.kobiety}wzięły{else}wzięli{/if} udział w debacie:
	    {/if}
	  
	  </p>
	  <a href="/debata/{$i.eid}"><img src="/g/p.gif" class="ikonka" /></a>
	  <div class="cc">
		  <p class="t"><a href="/debata/{$i.eid}">{$i.title}</a></p>
		  <div class="stats">
		    <a href="/debata/{$i.eid}"><img class="baner" src="/resources/debaty/banery/{$i.eid}.jpg" /></a>
		    {if $i.debata_typ_id ne "2"}<p>{$i.debata_opis}</p>{/if}
		  </div>
	  </div>
	</div>
	
{/if}