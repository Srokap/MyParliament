<?php /* Smarty version 2.6.19, created on 2013-01-29 10:18:47
         compiled from tabs/main.tpl */ ?>
<h1>Logowanie</h1>

<div id="main_div">


	<div class="login_container">
		<h2>Zaloguj przez konto OchParliament:</h2>
		<form method="post">
			<input type="hidden" value="<?php echo $this->_tpl_vars['auth_token']; ?>
" name="auth_token">
			<div class="s_login_cont_div">
				
				<span class="incorrect<?php if ($this->_tpl_vars['incorrect']): ?> active<?php endif; ?>">Nieprawidłowy username / email bądź hasło</span>
				
				<div class="row">
					<label>Username / Email:</label><input name="username" value="<?php echo $this->_tpl_vars['username']; ?>
" type="text"/>
					<span class="required<?php if ($this->_tpl_vars['username_err'] == 'required'): ?> active<?php endif; ?>">Pole jest wymagane</span>
				</div>
				
				<div class="row">
					<label>Haslo:</label><input name="pass" type="password"/>
					<span class="required<?php if ($this->_tpl_vars['pass_err'] == 'required'): ?> active<?php endif; ?>">Pole jest wymagane</span>
				</div>
				
				<div class="row">
					<label>Zapamiętaj mnie:</label><input class="remember_input" type="checkbox" name="remember"<?php if ($this->_tpl_vars['remember']): ?> checked="checked"<?php endif; ?>>
				</div>
				
				<div class="row">
					<input class="mBtn green" name="save" type="submit" value="Zaloguj się"/>
				</div>
				
				<div class="row links">
					<p><a href="/odzyskanie_hasla">Zapomnialeś hasło?</a></p>
					<p><a href="/rejestracja">Nie masz jeszcze konta? Zarejestruj się &raquo;</a></p>
				</div>
				
			</div>
		</form>
	</div>
	
	
	
	<div class="fb_containter">
	
	  <h2>Zaloguj przez konto w serwisie Facebook:</h2>
	  
	  
	  <div class="fb_containter_inner">
	  <div class="fb-login-button" data-show-faces="true" data-width="400" data-max-rows="3" scope="email" size="large"></div>
	  </div>
	
	</div>
	
	
</div>