<?php /* Smarty version 2.6.19, created on 2013-02-02 13:34:28
         compiled from /MAMP/GitHub/OchParliament/_components/dataset_browser/smarty/list_item_classes/ep_MP.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', '/MAMP/GitHub/OchParliament/_components/dataset_browser/smarty/list_item_classes/ep_MP.tpl', 2, false),)), $this); ?>
<?php $this->assign('data', $this->_tpl_vars['item']->data); ?>
<?php $this->assign('href', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['M']['SITE_ROOT'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['item']->_aliases['0']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['item']->_aliases['0'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['data']['id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['data']['id']))); ?>


<div class="ep_MP">
	<div class="content_div">
	
	  <img style="float: left; width: 100px; margin-right: 10px;" src="/resources/w/mps/a/src/<?php echo $this->_tpl_vars['data']['id']; ?>
.jpg" />
	
		<p class="label">Member of parliament</p>
		<p class="tytul"><a href="<?php echo $this->_tpl_vars['href']; ?>
"><?php echo $this->_tpl_vars['data']['name']; ?>
</a></p>
	</div>
</div>