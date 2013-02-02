<?
  $datasets = $this->DB->selectAssocs("SELECT name, base_alias, opis FROM api_datasets WHERE public='1'");  
  $this->SMARTY->assign('datasets', $datasets);