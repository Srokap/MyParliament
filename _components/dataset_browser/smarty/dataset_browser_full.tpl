<div class="_s_browser {$dataset->data.base_alias}" base_alias="{$dataset->data.base_alias}" initw='{$dataset->get_init_wheres()|@json_encode}'>
  <div class="_performance" style="display: none;">
    <ul>
      {if $dataset->performance.data_query}<li><p class="l">data_query</p><p class="v">{$dataset->performance.data_query}</p></li>{/if}
      {if $dataset->performance.found_rows_query}<li><p class="l">found_rows_query</p><p class="v">{$dataset->performance.found_rows_query}</p></li>{/if}
      {if $dataset->performance.opening_files}<li><p class="l">opening_files</p><p class="v">{$dataset->performance.opening_files}</p></li>{/if}
      <li><p class="l">total</p><p class="v">{$dataset->performance.total}</p></li>
    </ul>
  </div>
	<div class="s_browser_filters_cont">
		<form class="s_browser_form" method="get" action="">
		<div class="s_browser_main_cont">
		  <div class="s_filters_cont">
			  <div class="s_browser_side_div">
		      {if $mode eq 'browse'}{include file=$ROOT|cat:"/_components/dataset_browser/smarty/dataset_browser_filters_div.tpl"}{/if}
		    </div>
		  </div><div class="s_browser_cont">
				<div class="s_browser">   
					  <div class="s_browser_cont_div">
					    <div class="s_brwoser_main_div">
					      {if $mode eq 'browse'}
								  <div class="aoverflow s_browser_bar">
							      <div class="lalign lfloat">
							        <p class="s_browser_counter">{$nav_str}</p>
							      </div><div class="ralign rfloat">
						          {if $dataset->fields}
											<div class="s_browser_order">
											  {assign var="sort_order" value="DESC"}
												<p class="sort_label">Sortowanie:</p>
											  <select name="o[]" class="main_select">
											  
											    {if $add_sort_fields}
										      <optgroup label="{$add_sort_fields_label}">
										      {section name="sort_fields" loop=$add_sort_fields}{assign var="f" value=$add_sort_fields[sort_fields]}
											    <option{if $f.selected}{assign var="sort_order" value=$f.direction} selected="selected"{/if} value="{$f.field}">{$f.tytul}</option>
											    {/section}
										      </optgroup>
										      
										      <optgroup label="{$dataset->data.name}">
											    {/if}
											  
											    {section name="sort_fields" loop=$dataset->fields}{assign var="f" value=$dataset->fields[sort_fields]}
											    {if $f.can_order eq '1'}
											    <option{if $f.selected}{assign var="sort_order" value=$f.direction} selected="selected"{/if} value="{$f.field}">{$f.tytul}</option>
											    {/if}
											    {/section}
											    
											    {if $add_sort_fields}
											    </optgroup>
											    {/if}
											  </select>
											  <select name="o[]">
											    <option value="DESC"{if $sort_order eq 'DESC'} selected="selected"{/if}>malejąco</option>
											    <option value="ASC"{if $sort_order eq 'ASC'} selected="selected"{/if}>rosnąco</option>
											  </select>
											  <input class="mBtn blue s_browser_mbtn" type="submit" value="Sortuj" />
										  </div>
										  {/if}
							      </div>
							    </div>
					        <div class="s_browser_pagination upper">{$pagination.str}</div>
						      <ul class="s_browser_results_ul{if $dataset->data.color_items ne '1'} nocoloring{/if}">
						        {section name="items" loop=$items}
						          {include file=$list_item_path class=$dataset->items_class item=$items[items] iteration=$smarty.section.items.iteration}
						        {/section}
						      </ul>
						      <div class="s_browser_pagination lower">{$pagination.str}</div>
					      {elseif $mode eq 'api'}
					        <div class="s_browser_inner api">
					          <p>Aby pobierać dane o elementach w tym zbiorze, użyj obiektu <i>ep_Dataset</i> o identyfikatorze <i>{$dataset->data.base_alias}</i>.</p>
					          <p>Przykład:</p>
					          <pre><code>
									    <p><span class="var">$dataset</span> = new <span class="function">ep_Dataset</span>(<span class="string">'{$dataset->data.base_alias}'</span>);</p>
									    <p><span class="var">${$dataset->data.base_alias}</span> = <span class="var">$dataset</span>-><span class="function">find_all();</span></p>
									  </code></pre>
									  
									  <p>Metoda <i>find_all()</i> zwróci w tym przypadku tablicę obiektów klasy <i>{$dataset->data.results_class}</i>. Każdy z tych obiektów będzie zawierał publiczną właściwość <i>data</i>, będącą tablicą asocjacyjną z następującymi kluczami:</p>
					          
					          <table class="api_keys_table" cellpadding="0" cellspacing="0" border="0">
					            <tr>
					              <th class="l">Klucz</th>
					              <th class="v">Znaczenie</th>
					            </tr>
					            {section name="rows" loop=$object_fields}{assign var="r" value=$object_fields[rows]}
					            <tr>
					              <td class="l">{$r.key}</td>
					              <td class="v">{if $r.key eq 'id'}{$r.desc|default:"Identyfikator obiektu w <i>ep_API</i>"}{elseif $r.key eq 'dokument_id'}{$r.desc|default:"Identyfikator dokumentu w <i>ep_API</i>"}{else}<p class="title">{$r.tytul}</p><p class="title">{$r.desc}</p>{/if}</td>
					            </tr>
					            {/section}
					          </table>
					          
					        </div>
					      
					      {elseif $mode eq 'rss'}
					        <div class="s_browser_inner rss">
					          <p>Możesz zaprenumerować informacje o nowych elementach w tym zbiorze. Oto link do kanału RSS:</p>
					          <input class="copy_content_input" type="text" readonly="readonly" value="http://rss.ochparliament.pl/{$dataset->data.base_alias}" />
					        </div>
					      {/if}
					    </div>
					  </div>
				</div>
			</div>
		</div>
	  </form>
	</div>
</div>