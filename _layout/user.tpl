<div id="s_body">
	{include file=$M.ROOT|cat:"/_layout/header.tpl"}
	<div class="s_content_cont">
		<div class="bg_gradient{if $smarty.request.gradient eq 'off'} cancel{/if}">	 
		  <div class="s_wrap s_main_content_container">
		    <div class="s_column_main_left">
		      <div class="s_main_left_menu">
			      {include file=$M.ROOT|cat:"/_layout/user_menu.tpl"}
		      </div>
		    </div><div class="s_column_main_right">
		      {$M.PAGE_HTML}
		    </div>
		  </div>
	  </div>
  </div>
  {include file=$M.ROOT|cat:"/_layout/footer.tpl"}
</div>