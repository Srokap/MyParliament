<div class="container">
	<p class="h lfloat"><a href="/posiedzenia/{$i.eid}?a={$posel.id}">Podsumowanie posiedzenia nr {$i.title}:</a></p>
	<p class="rfloat">{$i.desc}</p>
</div>
<div class="inner">
  <table class="info_table">
  {if $i.ilosc_glosowan gt 0}
    <tr><td class="l">Frekwencja</td><td class="v">{$i.frekwencja} %</td></tr>
  {/if}
  <tr><td class="l">Wypowiedzi</td><td class="v">{$i.ilosc_wypowiedzi|default:"0"}</td></tr>
  {if $i.ilosc_buntow gt 0}
    <tr><td class="l">Bunty</td><td class="v">{$i.ilosc_buntow}</td></tr>
  {/if}
  </table>
</div>