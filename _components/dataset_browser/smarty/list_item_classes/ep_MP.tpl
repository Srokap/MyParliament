{assign var="data" value=$item->data}
{assign var="href" value=$M.SITE_ROOT|cat:$item->_aliases.0|cat:"/"|cat:$data.id}


<div class="ep_MP">
	<div class="content_div">
	
	  <img style="float: left; width: 100px; margin-right: 10px;" src="/resources/w/mps/a/src/{$data.id}.jpg" />
	
		<p class="label">Member of parliament</p>
		<p class="tytul"><a href="{$href}">{$data.name}</a></p>
	</div>
</div>