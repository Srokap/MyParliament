<div class="s_browser">	      
  <form method="get" action="">
  	
    <p class="s_browser_counter">{$nav_str}</p>
	  
    <div class="s_brwoser_main_div">
            
      <div class="s_browser_order">
        {if $dataset->fields}
	      <p class="label">Sortowanie: </p>
	      {assign var="sort_order" value="DESC"}
	      <select name="o[]">
	        {section name="sort_fields" loop=$dataset->fields}{assign var="f" value=$dataset->fields[sort_fields]}
	        {if $f.can_order eq '1'}
	        <option{if $f.selected}{assign var="sort_order" value=$f.direction} selected="selected"{/if} value="{$f.field}">{$f.tytul}</option>
	        {/if}
	        {/section}
	      </select>
	      <select name="o[]">
	        <option value="DESC"{if $sort_order eq 'DESC'} selected="selected"{/if}>malejąco</option>
	        <option value="ASC"{if $sort_order eq 'ASC'} selected="selected"{/if}>rosnąco</option>
	      </select>
	      <input type="submit" value="Sortuj" />
	      {/if}
      </div>
      
    
    
    
      <div class="s_browser_pagination upper">{$pagination.str}</div>
      
      {if $items}
      <ul class="s_browser_results_ul{if $dataset->data.color_items ne '1'} nocoloring{/if}">
        {section name="items" loop=$items}
          {include file=$list_item_path class=$dataset->items_class item=$items[items] iteration=$smarty.section.items.iteration}
        {/section}
      </ul>
      {else}
      <p class="noresults">Brak wyników</p>
      {/if}
      
      <div class="s_browser_pagination lower">{$pagination.str}</div>
      
      
    </div>
	  
	  
  </form>
</div>