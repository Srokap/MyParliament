<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.sitemaps.org/schemas/sitemap-image/1.0" xmlns:video="http://www.google.com/schemas/sitemap-video/1.0">
	{section name="items" loop=$M.ITEMS}{assign var="item" value=$M.ITEMS[items]}
		<url>
			<loc>{$item.loc}</loc>
			{if $item.lastmod && $item.lastmod ne '0000-00-00'}<lastmod>{$item.lastmod}</lastmod>{/if}
			{if $item.changefreq}<changefreq>{$item.changefreq}</changefreq>{/if}
			{if $item.priority}<priority>{$item.priority}</priority>{/if}
			{if $item.video}
				<video:video>
	        {if $item.video.content_loc}<video:content_loc>{$item.video.content_loc}</video:content_loc>{/if}
          {if $item.video.thumbnail_loc}<video:thumbnail_loc>{$item.video.thumbnail_loc}</video:thumbnail_loc>{/if}
	        {if $item.video.title}<video:title>{$item.video.title}</video:title>{/if}
	        {if $item.video.description}<video:description>{$item.video.description}</video:description>{/if}
	      </video:video>
		  {/if}
		</url>
	{/section}
</urlset>