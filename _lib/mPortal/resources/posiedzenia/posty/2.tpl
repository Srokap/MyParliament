<p class="intro">{$t.poslowie_fraza} przeciwko swoim klubom:</p>
<p class="tytul"><a href="/rozpatrywanie/{$t.c_id}">{$t.tytul}</a></p>

{assign var="meta" value=$t.meta}
{if $meta}
<div class="meta">
  
  {section name="glosowania" loop=$meta}{assign var="g" value=$meta[glosowania]}
    {s_glosowanie data=$g}
  {/section}
  
</div>
{/if}