<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0">
	<channel>

		<title>OchParliament - Blog</title>
		<description>To jest oficjalny blog redakcji portalu OchParliament</description>
		<link>{$M.SITE_ADDRESS}/rss/blog</link>
		<language>pl</language>
		<copyright>Fundacja ePaństwo</copyright>
		
		<image>
		   <url>{$M.SITE_ADDRESS}/g/logo_55.jpg</url>
		   <width>68</width>
		   <height>55</height>
		   <link>{$M.SITE_ADDRESS}/</link>
		   <title>OchParliament</title>
		</image>
		
		{section name="items" loop=$items}{assign var="item" value=$items[items]}
		<item>
		  <title>{$item.tytul|cdata}</title>
		  <link>{$M.SITE_ADDRESS}/blog/{$item.id},{$item.url_title}</link>
		  <description>{$item.opis|cdata}</description>
		  <guid>{$M.SITE_ADDRESS}/blog/{$item.id},{$item.url_title}</guid>
	  </item>
    {/section}
      
  </channel>
</rss>