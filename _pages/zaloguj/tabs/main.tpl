<h1>Logowanie</h1>

<div id="main_div">


	<div class="login_container">
		<h2>Zaloguj przez konto OchParliament:</h2>
		<form method="post">
			<input type="hidden" value="{$auth_token}" name="auth_token">
			<div class="s_login_cont_div">
				
				<span class="incorrect{if $incorrect} active{/if}">Nieprawidłowy username / email bądź hasło</span>
				
				<div class="row">
					<label>Username / Email:</label><input name="username" value="{$username}" type="text"/>
					<span class="required{if $username_err == 'required'} active{/if}">Pole jest wymagane</span>
				</div>
				
				<div class="row">
					<label>Haslo:</label><input name="pass" type="password"/>
					<span class="required{if $pass_err == 'required'} active{/if}">Pole jest wymagane</span>
				</div>
				
				<div class="row">
					<label>Zapamiętaj mnie:</label><input class="remember_input" type="checkbox" name="remember"{if $remember } checked="checked"{/if}>
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