<?
  $base_alias = $_PARAMS;

  $dataset = $_SERVER['M']->DB->selectAssoc("SELECT api_datasets.`name`, api_datasets.`results_class`, api_datasets.`base_alias`, api_aliases.`table`, api_datasets.limit_max, api_datasets.limit_default, api_datasets.fts_columns, api_datasets.fts_label, api_datasets.fts_mode, api_datasets.sort_field, api_datasets.sort_direct, api_datasets.color_items, api_aliases.id_key, api_datasets.stats_field, api_datasets.opis, api_datasets.browse_mode FROM api_datasets JOIN api_aliases ON api_datasets.`base_alias`=api_aliases.`alias` WHERE api_datasets.`base_alias`='$base_alias' LIMIT 1");
  
  if( isset($_SERVER['_FORCE_BROWSE_MODE']) )
    $dataset['browse_mode'] = $_SERVER['_FORCE_BROWSE_MODE'];
  
  if( !$dataset )
    return false;
  
  $fields = $_SERVER['M']->DB->selectAssocs("SELECT CONCAT(api_datasets_fields.alias, '.', api_datasets_fields.field) as 'field', api_datasets_fields.tytul, api_datasets_fields.can_order, api_datasets_fields.filter_id, api_datasets_fields.filter_params, api_datasets_fields.filter_ord, api_datasets_fields.parent_field FROM api_datasets_fields WHERE api_datasets_fields.base_alias='".$dataset['base_alias']."' ORDER BY api_datasets_fields.field='id' DESC, api_datasets_fields.field ASC");
  
  return array(
    'dataset' => $dataset,
    'fields' => $fields,
  );
?>