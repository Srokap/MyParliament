{if $resend == 3}
<p>
	Wystapil ponownie problem z wysylka emaila.
	<a href="/zaloguj?tab=not_send&resend=1">Wyslij ponownie</a>
</p>
{elseif $resend == 2}
<p>
	Wkrótce otrzymasz email z instrukcjami by dokonczyć proces rejestracji
</p>
{else}
<p>
	Wystapil problem z wysylka emaila podczas rejestracji.
	<a href="/zaloguj?tab=not_send&resend=1">Wyslij ponownie</a>
</p>
{/if}