<?php /* Smarty version 2.6.19, created on 2013-02-02 10:57:09
         compiled from /MAMP/GitHub/OchParliament/_pages/_dataset/_dataset.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'dataset_browser', '/MAMP/GitHub/OchParliament/_pages/_dataset/_dataset.tpl', 16, false),)), $this); ?>
<div class="aoverflow">
  <div class="lalign lfloat">
  
		<h1 class="dataset_name"><a class="hl" href="/<?php echo $this->_tpl_vars['dataset']->data['base_alias']; ?>
"><?php echo $this->_tpl_vars['dataset']->data['name']; ?>
</a></h1>
  
  </div><div class="ralign rfloat">
    
    <ul class="dataset_btns_ul">
      <li><input type="button" name="api" class="mBtn yellow api" value="API" /></li>
      <li><input type="button" name="rss" class="mBtn yellow rss" value="RSS" /></li>
    </ul>
  
  </div>
</div>
<div class="s_meta"><?php echo $this->_tpl_vars['dataset']->data['opis']; ?>
</div>
<?php echo sf_dataset_browser(array('dataset' => $this->_tpl_vars['dataset'],'request' => $_REQUEST), $this);?>