{if $M.OBJECT_TAB.type eq 'dataset'}
  {dataset_browser dataset=$M.OBJECT_TAB.dataset request=$smarty.request}
{elseif $M.OBJECT_TAB.type eq 'file'}
  {assign var="file" value=$M.ROOT|cat:"/_pages/"|cat:$M.ID|cat:"/tabs/"|cat:$M.OBJECT_TAB.id|cat:".tpl"}
  {include file=$file}
{else}
  {assign var="file" value=$M.ROOT|cat:"/_pages/"|cat:$M.ID|cat:"/"|cat:$M.NAME|cat:".tpl"}
  {include file=$file}
{/if}