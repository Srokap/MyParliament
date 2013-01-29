<div class="s_browser min" base_alias="{$dataset->data.base_alias}">   
  <ul class="s_browser_results_ul{if $dataset->data.color_items ne '1'} nocoloring{/if}">
    {section name="items" loop=$items}
      {include file=$list_item_path class=$dataset->items_class item=$items[items] iteration=$smarty.section.items.iteration}
    {/section}
  </ul>
</div>