<?
  $datasets = $this->DB->selectAssocs("SELECT name, base_alias FROM api_datasets WHERE public='1'");  
  $this->SMARTY->assign('datasets', $datasets);