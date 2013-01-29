<div id="s_body">
	{include file=$M.ROOT|cat:"/_layout/header.tpl"}
	<div class="s_content_cont">
		<div class="bg_gradient{if $smarty.request.gradient eq 'off'} cancel{/if}">	 
		  <div class="s_wrap s_main_content_container">
		    <div class="s_column_main_right single">
		      <div class="page_ep_Object{if $M.BREAD_CRUMBS} bc{/if}">
			      <div class="page_{$O|@get_class}">
              
							{if !$M.HEADER_TITLE}
						  <ul class="s_breadcrumb">
								{section name="bread_crumbs" loop=$M.BREAD_CRUMBS}{assign var="b" value=$M.BREAD_CRUMBS[bread_crumbs]}
								<li><a title="{$b.name}" href="/{$b.url}"><i class="separator"></i><span>{$b.name|truncate:80:"...":false:true}</span></a></li>
								{/section}
							</ul>
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
							
							{if !$M.NOHEADER}
							<div class="header">
							  {assign var="file" value=$M.ROOT|cat:"/_pages/"|cat:$M.ID|cat:"/"|cat:$M.NAME|cat:"-header.tpl"}
							  {if $file|@file_exists}
							    {include file=$file}
							  {else}
							    <h1>{$M.HEADER_TITLE|default:$M.TITLE}</h1>
							  {/if}
							</div>
							{/if}
			    						
							<div class="ep_Object_cont_div">
								  {$M.PAGE_HTML}
							</div>
			      </div>
			    </div>
		    </div>
		  </div>
	  </div>
  </div>
  {include file=$M.ROOT|cat:"/_layout/footer.tpl"}
</div>