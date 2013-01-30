<div id="s_body">
	{include file=$M.ROOT|cat:"/_layout/header.tpl" admin=true}
	<div class="s_content_cont">
		<div class="bg_gradient{if $smarty.request.gradient eq 'off'} cancel{/if}">	 
		  <div class="s_wrap s_main_content_container">
		    <div class="s_main_content_container_inner">
		    <div style="width:200px; float:left;">
		    <ul>
		    	<li><a href="{$M.SITE_ROOT}admin/wizard">Wizard</a></li>
		    </ul>
		    </div>
		    <div style="margin-left:200px;">
		      {$M.PAGE_HTML}
		    </div>
		    </div>
		  </div>
	  </div>
  </div>
  {include file=$M.ROOT|cat:"/_layout/footer.tpl"}
</div>