<div class="_search_browser">
	<div class="facelet_cont">
	
	
	  <div class="s_browser_side_div">
	  
	    {if $search->tabs}
	    <ul>
		    <li>
			    <p class="label">Filtruj wyniki:</p>
			    <ul class="facet_ul">
			        <li {if !$search->dataset}class="selected"{/if}>
			          <a href="/szukaj?q={$search->q|escape:"html"}&o={$smarty.get.o}">Wszystko</a>
			        </li>
			      {section name="facets" loop=$search->tabs}{assign var="f" value=$search->tabs[facets]}
			        <li{if $f.dataset eq $search->dataset} class="selected"{/if}>
			          <a href="?q={$search->q|escape:"html"}&d={$f.dataset}&o={$smarty.get.o}">{$f.name}&nbsp;<span>(<b>{$f.count}</b>)</span></a>
			        </li>
			      {/section}
			    </ul>
		    </li>
	    </ul>
	    {/if}  
	    
	  </div>
	
	
	</div>
</div>