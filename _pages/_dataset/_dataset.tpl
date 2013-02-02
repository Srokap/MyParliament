<div class="aoverflow">
  <div class="lalign lfloat">
  
		<h1 class="dataset_name"><a class="hl" href="/{$dataset->data.base_alias}">{$dataset->data.name}</a></h1>
  
  </div><div class="ralign rfloat">
    
    <ul class="dataset_btns_ul">
      <li><input type="button" name="api" class="mBtn yellow api" value="API" /></li>
      <li><input type="button" name="rss" class="mBtn yellow rss" value="RSS" /></li>
    </ul>
  
  </div>
</div>
<div class="s_meta">{$dataset->data.opis}</div>
{dataset_browser dataset=$dataset request=$smarty.request}