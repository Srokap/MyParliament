<div id="s_body">
	{include file=$M.ROOT|cat:"/_layout/header.tpl"} 	
	<div class="s_content_cont">
		<div class="bg_gradient{if $smarty.request.gradient eq 'off'} cancel{/if}">	 
		  <div class="s_wrap s_main_content_container">		
		    <div class="s_column_main_right single">
		      {if $M.BREAD_CRUMBS}
		      <div class="promo_display">
					  <ul class="s_breadcrumb">
							{section name="bread_crumbs" loop=$M.BREAD_CRUMBS}{assign var="b" value=$M.BREAD_CRUMBS[bread_crumbs]}
							<li><a title="{$b.name}" href="/{$b.url}"><i class="separator"></i><span>{$b.name|truncate:80:"...":false:true}</span></a></li>
							{/section}
						</ul>
			  </div>
			 {/if}					
					{$M.PAGE_HTML}
		    </div>
		  </div>
	  </div>
  </div>
  {include file=$M.ROOT|cat:"/_layout/footer.tpl"}
</div>