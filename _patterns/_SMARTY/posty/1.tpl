{assign var="meta" value=$t.meta}
<p style="margin: 0; padding: 0;">{$t.poslowie_fraza} udział w debacie:</p>

<div style="margin: 0; padding: 0;">
  <p style="margin: 5px 10px 10px; padding: 0;"><a style="color: #0083B8; font-weight: normal; text-decoration: none; font-size: 14px;" href="{$SITE_ADDRESS}/rozpatrywanie/{$t.c_id}">{$t.tytul}</a></p>
  <div style="margin: 0; padding: 0;">
    {section name="wystapienia" loop=$t.meta.wystapienia}{assign var="w" value=$t.meta.wystapienia[wystapienia]}
    
    <div style="margin-left: 20px;">
    {if $w.video eq '1'}
      <table border="0" cellpadding="0" cellspacing="0" style="margin: 7px;"><tr>
        <td style="font-size: 12px; vertical-align: top;"><a style="outline: none;" href="{$SITE_ADDRESS}/wystapienie/{$w.id}"><img src="{$SITE_ADDRESS}/resources/wystapienia/thumbs/{$w.id}ms.jpg" /></a></td>
        <td style="font-size: 12px; padding: 0 0 0 7px; vertical-align: top;"><p style="margin: 0; padding: 0;"><a style="color: #444; text-decoration: none;" href="{$SITE_ADDRESS}/wystapienie/{$w.id}">{$w.txt} <span style="color: #0083B8;">czytaj&nbsp;dalej&nbsp;&raquo;</span></a></p></td>
      </tr></table>
    {else}
      <p style="margin: 0; padding: 0;"><a style="color: #444; text-decoration: none;" href="{$SITE_ADDRESS}/wystapienie/{$w.id}">{$w.txt} <span style="color: #0083B8;">czytaj&nbsp;dalej&nbsp;&raquo;</span></a></p>
    {/if}
    </div>
    
      
      
      
    {/section}
  </div>
</div>