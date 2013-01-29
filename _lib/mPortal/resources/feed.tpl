<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
	<channel>
		<title>{$M.TITLE}</title>
		<link>{$M.SITE_ADDRESS}{$M.LINK}</link>
		<description>{$M.DESCRIPTION}</description>
		<language>pl</language>
		<image>
       <url>{$M.SITE_ADDRESS}g/logo_rss.png</url>
       <width>60</width>
       <height>49</height>
       <link>{SITE_ADDRESS}</link>
       <title>{$M.TITLE}</title>
    </image>

		
		{section name="items" loop=$M.ITEMS}{assign var="item" value=$M.ITEMS[items]}
			<item>
				<title><![CDATA[{$item.title}]]></title>
				<link>{$item.link}</link>
				<guid>{if $item.guid}{$item.guid}{else}{$item.link}{/if}</guid>
				<description><![CDATA[{$item.description}<br/><br/><a href="{$item.link}">Czytaj więcej &raquo;</a></p>]]></description>
				{if $item.pubDate}<pubDate>{$item.pubDate}</pubDate>{/if}
			</item>
		{/section}				
	</channel>
</rss>