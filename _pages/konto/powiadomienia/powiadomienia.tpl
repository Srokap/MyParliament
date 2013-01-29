<h1>Ustawienia powiadomień</h1>

<ul class="ep_Object_menu_ul tab_manager">
	<li class="{if $act_tab=='ustawienia_email'}s{/if}"><a href="#password">Wysyłanie e-maili</a></li>
</ul>

<div class="aktualnosci_container">

	<div class="tab_content" style="display: {if $act_tab=='ustawienia_email'}block{else}none{/if};">
		<span class="msg{if $msg_ustawienia_email} active{/if}">Ustawienia zostały zmienione.</span>
		<form method="post" name="pass_form">
			<input type="hidden" value="{$auth_token}" name="auth_token">
			<div class="row desc">
			  <p>Wysyłaj mi emaile z nowymi powiadomieniami</p>
			</div>
			<div class="row">
				<label><input type="radio" name="news_email_freq" value="0"{if $news_email_freq=="0"} checked="checked"{/if}/>nigdy</label>
			</div>
			<div class="row">
				<label><input type="radio" name="news_email_freq" value="1"{if $news_email_freq=="1"} checked="checked"{/if}/>najwyżej raz w tygodniu</label>
			</div>
			<div class="row">
				<label><input type="radio" name="news_email_freq" value="2"{if $news_email_freq=="2"} checked="checked"{/if}/>najwyżej raz dziennie</label>
			</div>
			<div class="row">
				<label><input type="radio" name="news_email_freq" value="3"{if $news_email_freq=="3"} checked="checked"{/if}/>natychmiast, gdy pojawi się nowe powiadomienie</label>
			</div>

			<div class="row buttons">
				<input name="save_ustawienia_email" class="mBtn blue" type="submit" value="Zapisz"/>
			</div>
		</form>
	</div>
	
</div>

