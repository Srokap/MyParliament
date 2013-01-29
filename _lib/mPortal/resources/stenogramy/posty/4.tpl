<p class="intro">{$posel.nazwa}Ważne głosowanie:</p>
<p class="tytul"><a href="/glosowanie/{$t.c_id}">{$t.tytul}</a></p>

{assign var="meta" value=$t.meta}
{if $meta}
<div class="meta wg">
  {s_glosowanie data=$meta}
</div>
{/if}