<div class="img_baner">
  
  <div class="top_div">
		<h1>Public Datasets</h1>
	</div>

</div>








{if $datasets}
<div class="sbox wszystkie _left">
  
	<div class="all_datasets_div">
	  <ul class="datasets_ul">
	    <li>
	      <div class="li_inner">
		      <p class="tytul"><a href="/bank_danych_lokalnych">Bank Danych Lokalnych</a></p>
		      <p class="opis">Największa w Polsce baza danych, opisująca sytuację ekonomiczno-społeczną kraju.</p>
	      </div>
	    </li>
	  {section name="datasets" loop=$datasets}{assign var="d" value=$datasets[datasets]}
	    <li>
	      <div class="li_inner">
		      <p class="tytul"><a href="/{$d->data.base_alias}">{$d->data.name}</a></p>
		      <p class="opis">{if $M.isAdmin}<div class="_admin_editable" _admin_editable_id="dane/dataset/{$d->data.base_alias}">{/if}{if $M.isAdmin && !$d->data.opis}null{else}{$d->data.opis}{/if}{if $M.isAdmin}</div>{/if}</p>
	      </div>
	    </li>
	  {/section}
	  </ul>
	</div>
  
</div>
{else}

  <p id="msg">You don't have any datasets yet</p>

{/if}


<p id="new_dataset_p"><a href="/new_dataset">Create new dataset &raquo;</a></p>