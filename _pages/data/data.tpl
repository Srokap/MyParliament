<div class="img_baner">
  
  <div class="top_div">
		<h1>Public Datasets</h1>
	</div>

</div>








{if $datasets}
<div class="sbox wszystkie _left">
  
	<div class="all_datasets_div">
	  <ul class="datasets_ul">
	  {section name="datasets" loop=$datasets}{assign var="d" value=$datasets[datasets]}
	    <li>
	      <div class="li_inner">
		      <p class="tytul"><a href="/{$d.base_alias}">{$d.name}</a></p>
		      <p class="opis">{if $M.isAdmin}<div class="_admin_editable" _admin_editable_id="dane/dataset/{$d.base_alias}">{/if}{if $M.isAdmin && !$d.opis}null{else}{$d.opis}{/if}{if $M.isAdmin}</div>{/if}</p>
		      
		      {if $M.isAdmin}
		        <div class="admin_div" name="{$d.name}" base_alias="{$d.base_alias}" api_class="{$d.results_class}">
		          <input class="mBtn yellow info" type="button" value="Admin info" />
		        </div>
		      {/if}
		      
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