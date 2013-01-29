<li class="ep_Object {if $iteration is odd}odd{else}even{/if}{if $item->getDate()} _date{/if}">
  <div class="li_inner_controlls">
    <ul class="__controlls">
      {*
      <li class="kolekcje"><i></i><span>kolekcje</span></li>
      <li class="tagi"><i></i><span>tagi</span></li>
      <li class="share"><i></i><span>udostępnij</span></li>
      *}
    </ul>
  </div>
  {if $item->getDate()}
  <div class="li_inner_date">
    {$item->getDate()|kalendarzyk}
  </div>
  {/if}
  <div class="li_inner_content">
  
    {if $class eq 'ep_NIK_raport'}{assign var="class" value='ep_NIK_Raport'}{/if}
  
	  {assign var="file" value=$include_path|@cat:$class|@cat:".tpl"}
	  	  
	  {if $file|@file_exists}
	    {include file=$file}
	  {else}
	    {$item|@var_export}
	  {/if}
  </div>
  {assign var="hls" value=$item->layers.hl}
  {if $hls}
  <div class="li_hls">
    <ul>
    {section name="hls" loop=$hls}{assign var="h" value=$hls[hls]}
      <li>{$h}</li>
    {/section}
    </ul>
  </div>
  {/if}
</li>