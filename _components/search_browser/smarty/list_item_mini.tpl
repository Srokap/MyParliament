<li class="ep_Object">
  <div class="li_inner_content">
	  {assign var="file" value=$include_path_mini|@cat:$class|@cat:".tpl"}
	  {if $file|@file_exists}
	    {include file=$file}
	  {else}
	    {assign var="file" value=$include_path|@cat:$class|@cat:".tpl"}
		  {if $file|@file_exists}
		    {include file=$file}
		  {else}
		    {assign var="file" value=$include_path|@cat:$class|@cat:".tpl"}
		    {$item|@var_export}
		  {/if}
	  {/if}
  </div>
</li>