<i class="gradient top"></i>
<ul class="ep_Object_menu_ul">
  {section name="OBJECT_TABS" loop=$M.OBJECT_TABS}{assign var="t" value=$M.OBJECT_TABS[OBJECT_TABS]}
    <li{if $t.s} class="s"{/if}><a href="/{$M.DATASET_BASE_ALIAS}/{$O->id}/{$t.id}">{$t.name}</a></li>
  {/section}
</ul>
<i class="gradient bottom"></i>