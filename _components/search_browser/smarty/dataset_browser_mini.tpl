<div class="s_browser mini {$dataset->name}">   
  <div class="s_brwoser_main_div">

	  <ul class="s_browser_results_ul mini nocoloring">
	    {section name="items" loop=$items}
	      {include file=$list_item_path class=$dataset->items_class item=$items[items] iteration=$smarty.section.items.iteration}
	    {/section}
	  </ul>
	      
  </div>
</div>