{assign var="meta" value=$t.meta}
<p class="intro">{$t.poslowie_fraza} udział w debacie:</p>

<div class="subpunkt">
  <p class="tytul"><a href="/rozpatrywanie/{$t.c_id}">{$t.tytul}</a></p>
  <div class="wystapienia">
    {section name="wystapienia" loop=$t.meta.wystapienia}{assign var="w" value=$t.meta.wystapienia[wystapienia]}
    <div class="w{if $w.video eq '1'} video{/if}">
      
      {if $w.video eq '1'}<div class="img_div"><a href="/wystapienie/{$w.id}"><img src="/resources/wystapienia/thumbs/{$w.id}ms.jpg" /></a></div>{/if}
      <div class="txt_div"><a href="/wystapienie/{$w.id}">{$w.txt} <span>czytaj&nbsp;dalej&nbsp;&raquo;</span></a></div>
      
    </div>
    {/section}
  </div>
</div>