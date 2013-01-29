<div id="s_body">
	{include file=$M.ROOT|cat:"/_layout/header.tpl"}
	<div class="s_content_cont">
		<div class="bg_gradient{if $smarty.request.gradient eq 'off'} cancel{/if}">	 
		  <div class="s_wrap s_main_content_container">
		    <div class="s_column_main_right single">
		      <div class="page_ep_Object{if $M.BREAD_CRUMBS} bc{/if}">
			      <div class="page_{$O|@get_class}">
							  
						  <ul class="s_breadcrumb">
								{section name="bread_crumbs" loop=$M.BREAD_CRUMBS}{assign var="b" value=$M.BREAD_CRUMBS[bread_crumbs]}
								<li><a title="{$b.name}" href="/{$b.url}"><i class="separator"></i><span>{$b.name|truncate:80:"...":false:true}</span></a></li>
								{/section}
							</ul>
							
							{if !$M.NOHEADER}
							<div class="header">							  
							  <h1><a class="hl" href="/{$O->_aliases.0}/{$O->data.id}">{$M.TITLE}</a></h1>
							</div>
							{/if}
							
						  {assign var="tpl_file" value=$M.ROOT|cat:"/_pages/"|cat:$M.ID|cat:"/"|cat:$M.NAME|cat:".tpl"}
						  {if $tpl_file|@file_exists}
						    {include file=$tpl_file}
						  {/if}

			        <div class="preheader" style="display: none;">
			          <div class="li_inner_controlls">
							    <ul class="__controlls">
							      {*
							      <li class="share"><i></i><span>udostępnij</span></li>
							      <li class="tagi"><i></i><span>tagi</span></li>
							      <li class="kolekcje"><i></i><span>kolekcje</span></li>
							      *}
							    </ul>
							  </div>
			        </div>
			        
			        <ul class="ep_Object_menu_ul">
							  {section name="OBJECT_TABS" loop=$M.OBJECT_TABS}{assign var="t" value=$M.OBJECT_TABS[OBJECT_TABS]}
							    <li class="{if $t.s} s{/if}{if $t.hidden} hidden{/if}"><a href="/{$M.DATASET_BASE_ALIAS}/{$O->id}/{$t.id}">{$t.name}</a></li>
							  {/section}
							</ul>
			    						
							<div class="ep_Object_cont_div">
								  <div class="object_tab_content{if $M.OBJECT_TAB.minimal eq '1'} minimal{/if}">
								  {$M.PAGE_HTML}
								  </div>
							</div>
			      </div>
			    </div>
		    </div>
		  </div>
	  </div>
  </div>
  {include file=$M.ROOT|cat:"/_layout/footer.tpl"}
</div>