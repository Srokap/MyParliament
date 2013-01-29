{assign var="data" value=$item->data}

<div class="ep__Dataset">
  <p class="nazwa"><a href="/{$data.base_alias}">{$data.name}</a></p>
  <div class="desc">
    <p>{$data.opis}</p>
    <p><span class="l">Liczba elementów w zbiorze:</span> <span class="v">{$data.count|number_format:0:",":" "}</span></p>
  </div>
  {*<p class="zrodlo"><span>Źródło:</span> {$data.zrodlo}</p>*}
  <div class="buttons_ul">
    <ul>
      <li><a class="mBtn blue g browse" href="/{$data.base_alias}"><i></i><span>Przeglądaj</span></a></li>
      {*<li><a class="mBtn g stats" href="/{$data.base_alias}/statystyki"><i></i><span>Statystyki</span></a></li>*}
      <li><a class="mBtn blue g api" href="/{$data.base_alias}"><i></i><span>API</span></a></li>
      {*<li><a class="mBtn g rss" href="/{$data.base_alias}/rss"><i></i><span>RSS</span></a></li>*}
    </ul>
  </div>
</div>