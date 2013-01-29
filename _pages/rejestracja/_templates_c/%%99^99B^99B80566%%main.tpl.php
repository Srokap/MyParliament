<?php /* Smarty version 2.6.19, created on 2013-01-22 16:02:34
         compiled from tabs/main.tpl */ ?>
<h1>Rejestracja</h1>

<div id="main_div">


	<div class="login_container">
		<h2>Nie masz jeszcze konta? Dołącz do nas!</h2>
		<form method="post">
			<input type="hidden" value="<?php echo $this->_tpl_vars['auth_token']; ?>
" name="auth_token">
			<div class="s_login_cont_div">
				
				<span class="incorrect<?php if ($this->_tpl_vars['incorrect']): ?> active<?php endif; ?>">Nieprawidłowy username / email bądź hasło</span>
				
				<div class="row">
					<label>Username:</label><input name="username" value="<?php echo $this->_tpl_vars['username']; ?>
" type="text"/>
					<span class="required<?php if ($this->_tpl_vars['username_err'] == 'required'): ?> active<?php endif; ?>">Pole jest wymagane</span>
					<span class="exists<?php if ($this->_tpl_vars['username_err'] == 'exists'): ?> active<?php endif; ?>">Username już instnieje</span>
					<span class="invalid<?php if ($this->_tpl_vars['username_err'] == 'invalid'): ?> active<?php endif; ?>">Niepoprawna nazwa uzytkownika</span>
				</div>
				
				<div class="row">
					<label>Email:</label><input name="email" value="<?php echo $this->_tpl_vars['email']; ?>
" type="text"/>
					<span class="required<?php if ($this->_tpl_vars['email_err'] == 'required'): ?> active<?php endif; ?>">Pole jest wymagane</span>
					<span class="exists<?php if ($this->_tpl_vars['email_err'] == 'exists'): ?> active<?php endif; ?>">Email juz istnieje</span>
					<span class="invalid<?php if ($this->_tpl_vars['email_err'] == 'invalid'): ?> active<?php endif; ?>">Niepoprawny email</span>
				</div>
				
				<div class="row">
				  <label>Haslo:</label><input name="pass" type="password"/>
					<span class="required <?php if ($this->_tpl_vars['pass_err'] == 'required'): ?> active<?php endif; ?>">Pole jest wymagane</span>
					<span class="invalid <?php if ($this->_tpl_vars['pass_err'] == 'invalid'): ?> active<?php endif; ?>">Niepoprawne hasło</span>
				</div>
				
				<div class="row">
					<label>Zapamiętaj mnie:</label><input class="remember_input" type="checkbox" name="remember"<?php if ($this->_tpl_vars['remember']): ?> checked="checked"<?php endif; ?>>
				</div>
				
				<div class="row">
					<input class="mBtn green" name="save" type="submit" value="Zarejestruj się"/>
				</div>
				
				<div class="row links">
					<p><a href="/zaloguj">Masz już konto? Zaloguj się &raquo;</a></p>
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