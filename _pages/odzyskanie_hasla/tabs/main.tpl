<div class="recover_container">
	<h1>Odzyskiwanie hasla</h1>
	<form method="post">
		<input type="hidden" value="{$auth_token}" name="auth_token">
		<p>
			<label>Username lub email</label>
			<input name="username" value="{$username}" type="text"/>
			<span class="required{if $username_err == 'required'} active{/if}">Pole jest wymagane</span>
			<span class="invalid{if $username_err == 'invalid'} active{/if}">Brak uzytkownika o podanym Username lub email</span>
		</p>
		<p>
			<input name="save" type="submit" value="Odzyskaj"/>
		</p>
	</form>
</div>