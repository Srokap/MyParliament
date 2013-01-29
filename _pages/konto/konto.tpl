<h1>Ustawienia konta</h1>

<ul class="ep_Object_menu_ul tab_manager">
	<li class="{if $act_tab=='password'}s{/if}"><a href="#password">Zmiana hasła</a></li>
	<li class="{if $act_tab=='email'}s{/if}"><a href="#email">Zmiana E-mail</a></li>
	<li class="{if $act_tab=='username'}s{/if}"><a href="#username">Zmiana loginu</a></li>
	<li class="{if $act_tab=='remove'}s{/if}"><a href="#remove">Usunięcie konta</a></li>
</ul>

<div class="konto_container">
	
	
	<div class="tab_content" style="display: {if $act_tab=='password'}block{else}none{/if};">
		<a class="anchor" name="password">Zmiana hasło</a>
		<span class="msg{if $msg_password} active{/if}">Hasło do twojego konta zostało zmienione.</span>
		<form method="post" name="pass_form">
			<input type="hidden" value="{$auth_token}" name="auth_token">
			<div class="row desc">
			  <p>Jeśli chcesz zmienić Twoje hasło do konta w serwisie OchParliament, wpisz swoje aktualne hasło (ze względów bezpieczeństwa), a następnie nowe hasło w formularzu poniżej:
			</div>
			<div class="row">
				<label>Aktualne hasło:</label><input name="pass" type="password"/>
				<span class="required{if $password_err == 'required'} active{/if}">Pole jest wymagane</span>
				<span class="required{if $password_err == 'invalid'} active{/if}">Niepoprawne hasło</span>
			</div>
			<div class="row">
				<label>Nowe hasło:</label><input name="newpass" type="password"/>
				<span class="required{if $newpassword_err == 'required'} active{/if}">Pole jest wymagane</span>
				<span class="required{if $newpassword_err == 'invalid'} active{/if}">Niepoprawny format hasła</span>
			</div>
			<div class="row buttons">
				<input name="save_pass" class="mBtn blue" type="submit" value="Zmień hasło"/>
			</div>
		</form>
	</div>
	
	
	
	<div class="tab_content" style="display: {if $act_tab=='email'}block{else}none{/if};">
		<a class="anchor" name="email">Zmiana adresu e-mail</a>
		<span class="msg{if $msg_email} active{/if}">Adres e-mail został zmieniony.</span>
		<form method="post" name="emailform">
			<input type="hidden" value="{$auth_token}" name="auth_token">
			<div class="row desc">
			  <p>Jeśli chcesz ustalić nowy adres e-mail, powiązany z Twoim kontem w serwisie OchParliament - podaj nowy adres w polu poniżej. Ze względów bezpieczeństwa, prosimy Cię również o podanie aktualnego hasła do Twojego konta.</p>
			</div>
			<div class="row">
				<label>Nowy adres email:</label><input name="email" value="{$email}" type="text"/>
				<span class="required{if $email_err == 'required'} active{/if}">Pole jest wymagane</span>
				<span class="exists{if $email_err == 'exists'} active{/if}">Email juz istnieje</span>
				<span class="invalid{if $email_err == 'invalid'} active{/if}">Niepoprawny email</span>
			</div>
			<div class="row">
				<label>Aktualne hasło:</label><input name="pass" type="password"/>
				<span class="required{if $email_pass_err == 'required'} active{/if}">Pole jest wymagane</span>
				<span class="required{if $email_pass_err == 'invalid'} active{/if}">Niepoprawne hasło</span>
			</div>
			<div class="row buttons">
				<input name="save_email" class="mBtn blue" type="submit" value="Zmień adres e-mail"/>
			</div>
		</form>
	</div>

	<div class="tab_content" style="display: {if $act_tab=='username'}block{else}none{/if};">	
		<a class="anchor" name="username">Zmiana loginu</a>
		<span class="msg{if $msg_username} active{/if}">Login został zmieniony.</span>
		<form method="post" name="usernameform">
			<input type="hidden" value="{$auth_token}" name="auth_token">
			<div class="row desc">
			  <p>Jeśli chcesz zmienić swój login do konta w serwisie podaj nowy login w polu poniżej. Ze względów bezpieczeństwa, prosimy Cię również o podanie aktualnego hasła do Twojego konta..</p>
			</div>
			<div class="row">
				<label>Nowy login:</label><input name="username" value="{$username}" type="text"/>
				<span class="required{if $username_err == 'required'} active{/if}">Pole jest wymagane</span>
				<span class="exists{if $username_err == 'exists'} active{/if}">Login już instnieje</span>
				<span class="invalid{if $username_err == 'invalid'} active{/if}">Niepoprawny login</span>
			</div>
			<div class="row">
				<label>Aktualne hasło:</label><input name="pass" type="password"/>
				<span class="required{if $username_pass_err == 'required'} active{/if}">Pole jest wymagane</span>
				<span class="required{if $username_pass_err == 'invalid'} active{/if}">Niepoprawne hasło</span>
			</div>
			<div class="row buttons">
				<input name="save_username" class="mBtn blue" type="submit" value="Zmień login"/>
			</div>
		</form>
	</div>
	
	
	
	<div class="tab_content" style="display: {if $act_tab=='remove'}block{else}none{/if};">
		<a class="anchor" name="remove">Usunięcie konta</a>
		<form method="post">
			<input type="hidden" value="{$auth_token}" name="auth_token">
			<div class="row desc">
			  Uwaga. Usunięcie konta jest procesem nieodwracalnym. W przyszłości będziesz mógł zarejestrować nowe konto, używając tego samego adresu e-mail.
			</div>
			<div class="row">
				<label>Aktualne hasło:</label><input name="pass" type="password"/>
				<span class="required{if $pass_err == 'required'} active{/if}">Pole jest wymagane</span>
				<span class="required{if $pass_err == 'invalid'} active{/if}">Niepoprawne hasło</span>
			</div>
			<div class="row buttons">
				<input name="save_remove" class="mBtn red" type="submit" value="Usuń konto"/>
			</div>
		</form>	
	</div>
	
</div>

