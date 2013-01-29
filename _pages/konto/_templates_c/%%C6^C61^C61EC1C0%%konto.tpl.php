<?php /* Smarty version 2.6.19, created on 2013-01-22 15:15:15
         compiled from /Users/bona/Desktop/Work/OchParlament/_pages/konto/konto.tpl */ ?>
<h1>Ustawienia konta</h1>

<ul class="ep_Object_menu_ul tab_manager">
	<li class="<?php if ($this->_tpl_vars['act_tab'] == 'password'): ?>s<?php endif; ?>"><a href="#password">Zmiana hasła</a></li>
	<li class="<?php if ($this->_tpl_vars['act_tab'] == 'email'): ?>s<?php endif; ?>"><a href="#email">Zmiana E-mail</a></li>
	<li class="<?php if ($this->_tpl_vars['act_tab'] == 'username'): ?>s<?php endif; ?>"><a href="#username">Zmiana loginu</a></li>
	<li class="<?php if ($this->_tpl_vars['act_tab'] == 'remove'): ?>s<?php endif; ?>"><a href="#remove">Usunięcie konta</a></li>
</ul>

<div class="konto_container">
	
	
	<div class="tab_content" style="display: <?php if ($this->_tpl_vars['act_tab'] == 'password'): ?>block<?php else: ?>none<?php endif; ?>;">
		<a class="anchor" name="password">Zmiana hasło</a>
		<span class="msg<?php if ($this->_tpl_vars['msg_password']): ?> active<?php endif; ?>">Hasło do twojego konta zostało zmienione.</span>
		<form method="post" name="pass_form">
			<input type="hidden" value="<?php echo $this->_tpl_vars['auth_token']; ?>
" name="auth_token">
			<div class="row desc">
			  <p>Jeśli chcesz zmienić Twoje hasło do konta w serwisie Sejmometr, wpisz swoje aktualne hasło (ze względów bezpieczeństwa), a następnie nowe hasło w formularzu poniżej:
			</div>
			<div class="row">
				<label>Aktualne hasło:</label><input name="pass" type="password"/>
				<span class="required<?php if ($this->_tpl_vars['password_err'] == 'required'): ?> active<?php endif; ?>">Pole jest wymagane</span>
				<span class="required<?php if ($this->_tpl_vars['password_err'] == 'invalid'): ?> active<?php endif; ?>">Niepoprawne hasło</span>
			</div>
			<div class="row">
				<label>Nowe hasło:</label><input name="newpass" type="password"/>
				<span class="required<?php if ($this->_tpl_vars['newpassword_err'] == 'required'): ?> active<?php endif; ?>">Pole jest wymagane</span>
				<span class="required<?php if ($this->_tpl_vars['newpassword_err'] == 'invalid'): ?> active<?php endif; ?>">Niepoprawny format hasła</span>
			</div>
			<div class="row buttons">
				<input name="save_pass" class="mBtn blue" type="submit" value="Zmień hasło"/>
			</div>
		</form>
	</div>
	
	
	
	<div class="tab_content" style="display: <?php if ($this->_tpl_vars['act_tab'] == 'email'): ?>block<?php else: ?>none<?php endif; ?>;">
		<a class="anchor" name="email">Zmiana adresu e-mail</a>
		<span class="msg<?php if ($this->_tpl_vars['msg_email']): ?> active<?php endif; ?>">Adres e-mail został zmieniony.</span>
		<form method="post" name="emailform">
			<input type="hidden" value="<?php echo $this->_tpl_vars['auth_token']; ?>
" name="auth_token">
			<div class="row desc">
			  <p>Jeśli chcesz ustalić nowy adres e-mail, powiązany z Twoim kontem w serwisie Sejmometr - podaj nowy adres w polu poniżej. Ze względów bezpieczeństwa, prosimy Cię również o podanie aktualnego hasła do Twojego konta.</p>
			</div>
			<div class="row">
				<label>Nowy adres email:</label><input name="email" value="<?php echo $this->_tpl_vars['email']; ?>
" type="text"/>
				<span class="required<?php if ($this->_tpl_vars['email_err'] == 'required'): ?> active<?php endif; ?>">Pole jest wymagane</span>
				<span class="exists<?php if ($this->_tpl_vars['email_err'] == 'exists'): ?> active<?php endif; ?>">Email juz istnieje</span>
				<span class="invalid<?php if ($this->_tpl_vars['email_err'] == 'invalid'): ?> active<?php endif; ?>">Niepoprawny email</span>
			</div>
			<div class="row">
				<label>Aktualne hasło:</label><input name="pass" type="password"/>
				<span class="required<?php if ($this->_tpl_vars['email_pass_err'] == 'required'): ?> active<?php endif; ?>">Pole jest wymagane</span>
				<span class="required<?php if ($this->_tpl_vars['email_pass_err'] == 'invalid'): ?> active<?php endif; ?>">Niepoprawne hasło</span>
			</div>
			<div class="row buttons">
				<input name="save_email" class="mBtn blue" type="submit" value="Zmień adres e-mail"/>
			</div>
		</form>
	</div>

	<div class="tab_content" style="display: <?php if ($this->_tpl_vars['act_tab'] == 'username'): ?>block<?php else: ?>none<?php endif; ?>;">	
		<a class="anchor" name="username">Zmiana loginu</a>
		<span class="msg<?php if ($this->_tpl_vars['msg_username']): ?> active<?php endif; ?>">Login został zmieniony.</span>
		<form method="post" name="usernameform">
			<input type="hidden" value="<?php echo $this->_tpl_vars['auth_token']; ?>
" name="auth_token">
			<div class="row desc">
			  <p>Jeśli chcesz zmienić swój login do konta w serwisie podaj nowy login w polu poniżej. Ze względów bezpieczeństwa, prosimy Cię również o podanie aktualnego hasła do Twojego konta..</p>
			</div>
			<div class="row">
				<label>Nowy login:</label><input name="username" value="<?php echo $this->_tpl_vars['username']; ?>
" type="text"/>
				<span class="required<?php if ($this->_tpl_vars['username_err'] == 'required'): ?> active<?php endif; ?>">Pole jest wymagane</span>
				<span class="exists<?php if ($this->_tpl_vars['username_err'] == 'exists'): ?> active<?php endif; ?>">Login już instnieje</span>
				<span class="invalid<?php if ($this->_tpl_vars['username_err'] == 'invalid'): ?> active<?php endif; ?>">Niepoprawny login</span>
			</div>
			<div class="row">
				<label>Aktualne hasło:</label><input name="pass" type="password"/>
				<span class="required<?php if ($this->_tpl_vars['username_pass_err'] == 'required'): ?> active<?php endif; ?>">Pole jest wymagane</span>
				<span class="required<?php if ($this->_tpl_vars['username_pass_err'] == 'invalid'): ?> active<?php endif; ?>">Niepoprawne hasło</span>
			</div>
			<div class="row buttons">
				<input name="save_username" class="mBtn blue" type="submit" value="Zmień login"/>
			</div>
		</form>
	</div>
	
	
	
	<div class="tab_content" style="display: <?php if ($this->_tpl_vars['act_tab'] == 'remove'): ?>block<?php else: ?>none<?php endif; ?>;">
		<a class="anchor" name="remove">Usunięcie konta</a>
		<form method="post">
			<input type="hidden" value="<?php echo $this->_tpl_vars['auth_token']; ?>
" name="auth_token">
			<div class="row desc">
			  Uwaga. Usunięcie konta jest procesem nieodwracalnym. W przyszłości będziesz mógł zarejestrować nowe konto, używając tego samego adresu e-mail.
			</div>
			<div class="row">
				<label>Aktualne hasło:</label><input name="pass" type="password"/>
				<span class="required<?php if ($this->_tpl_vars['pass_err'] == 'required'): ?> active<?php endif; ?>">Pole jest wymagane</span>
				<span class="required<?php if ($this->_tpl_vars['pass_err'] == 'invalid'): ?> active<?php endif; ?>">Niepoprawne hasło</span>
			</div>
			<div class="row buttons">
				<input name="save_remove" class="mBtn red" type="submit" value="Usuń konto"/>
			</div>
		</form>	
	</div>
	
</div>
