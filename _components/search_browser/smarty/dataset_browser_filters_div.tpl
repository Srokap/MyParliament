
  {if $dataset->fields}
	<h2>Sortowanie:</h2>
	
	<div class="s_browser_order">
	  {assign var="sort_order" value="DESC"}
	  <select name="o[]" class="main_select">
	  
	    {if $add_sort_fields}
      <optgroup label="{$add_sort_fields_label}">
      {section name="sort_fields" loop=$add_sort_fields}{assign var="f" value=$add_sort_fields[sort_fields]}
	    <option{if $f.selected}{assign var="sort_order" value=$f.direction} selected="selected"{/if} value="{$f.field}">{$f.tytul}</option>
	    {/section}
      </optgroup>
      
      <optgroup label="{$dataset->data.name}">
	    {/if}
	  
	    {section name="sort_fields" loop=$dataset->fields}{assign var="f" value=$dataset->fields[sort_fields]}
	    {if $f.can_order eq '1'}
	    <option{if $f.selected}{assign var="sort_order" value=$f.direction} selected="selected"{/if} value="{$f.field}">{$f.tytul}</option>
	    {/if}
	    {/section}
	    
	    {if $add_sort_fields}
	    </optgroup>
	    {/if}
	  </select>
	  <select name="o[]">
	    <option value="DESC"{if $sort_order eq 'DESC'} selected="selected"{/if}>malejąco</option>
	    <option value="ASC"{if $sort_order eq 'ASC'} selected="selected"{/if}>rosnąco</option>
	  </select>
	  <input class="mBtn blue s_browser_mbtn" type="submit" value="Sortuj" />
  </div>
  {/if}







	{if $dataset->data.fts_columns}
	<h2>{$dataset->data.fts_label}</h2>
	<ul class="s_browser_k_ul">
	  <li class="main">
	    <input name="k[]" class="s_text_input" type="text" value="{$k.0}" />
	    {$k_str}
	  </li>
	</ul>
	{/if}
	





  {if $filters}
	<div class="s_browser_filtry_ul_cont">
	  {section name="filters" loop=$filters}{assign var="f" value=$filters[filters]}
	  <h2>{$f.tytul}:</h2>
		<ul class="s_browser_filtry_ul">
	  <li class="filter_li" field="{$f.field}" selected="{if $f.selected}true{else}false{/if}"{if $f.selected} selectedValue="{$f.selected_value}"{/if}>
	    {if $f.selected}
	      <input type="hidden" name="w[]" value="{$f.field}" />
	      <input type="hidden" name="w[]" value="{$f.selected_operator}" />
	      <input type="hidden" name="w[]" value="{$f.selected_value}" />
	    {/if}
	    <ul class="s_browser_filtry_ul_results _LOADING"></ul>
	    <input style="display: none;" type="button" class="mBtn h first wszystkie_opcje s_browser_mbtn soft" value="Wszystkie opcje">
	  </li>
		</ul>
	  {/section}
	</div>
  {/if}
