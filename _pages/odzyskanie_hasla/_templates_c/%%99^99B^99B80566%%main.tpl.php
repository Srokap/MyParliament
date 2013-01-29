<?php /* Smarty version 2.6.19, created on 2013-01-22 16:07:47
         compiled from tabs/main.tpl */ ?>
<div class="recover_container">
	<h1>Odzyskiwanie hasla</h1>
	<form method="post">
		<input type="hidden" value="<?php echo $this->_tpl_vars['auth_token']; ?>
" name="auth_token">
		<p>
			<label>Username lub email</label>
			<input name="username" value="<?php echo $this->_tpl_vars['username']; ?>
" type="text"/>
			<span class="required<?php if ($this->_tpl_vars['username_err'] == 'required'): ?> active<?php endif; ?>">Pole jest wymagane</span>
			<span class="invalid<?php if ($this->_tpl_vars['username_err'] == 'invalid'): ?> active<?php endif; ?>">Brak uzytkownika o podanym Username lub email</span>
		</p>
		<p>
			<input name="save" type="submit" value="Odzyskaj"/>
		</p>
	</form>
</div>