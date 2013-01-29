<div class="recover_container">
	<h1>Odzyskiwanie hasla - Ustawienie nowego hasła</h1>
	<form method="post">
		<input type="hidden" value="{$auth_token}" name="auth_token">
		<p>
			<label>Nowe haslo:</label><input name="pass" type="password"/>
			<span class="required {if $pass_err == 'required'} active{/if}">Pole jest wymagane</span>
			<span class="invalid {if $pass_err == 'invalid'} active{/if}">Niepoprawne hasło</span>
		</p>
		<p>
			<input name="save" type="submit" value="Ustaw"/>
		</p>
	</form>
</div>