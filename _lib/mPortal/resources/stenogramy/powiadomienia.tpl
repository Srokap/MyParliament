<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Sejmometr</title>
  </head>
  
  <body style="margin: 0; padding: 0; color: #444444;" dir="ltr">
      
    <table width="98%" border="0" cellspacing="0" cellpadding="40">
      <tr>
        <td bgcolor="#f7f7f7" width="100%" style="font-family: tahoma,'lucida grande',verdana,arial,sans-serif;">
        
          <table cellpadding="0" cellspacing="0" border="0" width="620" style="background-color: #FFFFFF;">
            <tr>
              <td style="background: #4e769e; color: #FFFFFF; font-weight: bold; font-family: 'lucida grande', tahoma, verdana, arial, sans-serif; padding: 4px 8px; vertical-align: middle; font-size: 16px; letter-spacing: -0.03em; text-align: left;">
                <a style="color:#FFFFFF; text-decoration: none;" href="http://sejmometr.pl"><span style="color:#FFFFFF">Sejmometr</span></a>
              </td>
            </tr>
            <tr>
              <td style="background-color: #FFFFFF; border-bottom: 1px solid #CCCCCC; border-left: 1px solid #CCCCCC; border-right: 1px solid #CCCCCC; vertical-align: top;" valign="top">
              
	              <div style="background-color: #FFFFFF; font-family: tahoma,'lucida grande',verdana,arial,sans-serif; padding: 15px; font-size: 12px;">
		              <div style="margin-bottom: 5px;">Witaj {$USER.name},</div>
		              <div>
		                <p>Oto aktywności subskrybowanych przez Ciebie posłów w dniu {$stenogram.data|data_slowna}</p>
		              </div>
		              
		              
		              
		              
		              <div>
									  {assign var="last_date" value=false}
									  {section name="tablica" loop=$tablica}
									    {assign var="t" value=$tablica[tablica]}
									    
									    <table border="0" cellpadding="0" cellspacing="0"><tr>
									      <td style="font-size: 12px; vertical-align: top; padding: 3px; width: 40px;">{if $last_date ne $t.date}<img src="http://sejmometr.pl/resources/cdateimg/{$t.date}.gif" />{/if}</td>
									      <td style="font-size: 12px; vertical-align: top; padding: 3px;"><div style="margin-bottom: 25px;">{include file="posty/"|cat:$t.typ_id|cat:".tpl" t=$t}</div></td>
									    </tr></table>
											
											{if $t.typ_id eq '3'}
											  {assign var="last_date" value="false"}
											{else}
											  {assign var="last_date" value=$t.date}
											{/if}
											
									  {/section}
									</div>
		              
		              
		              <div style="background-color: #EEE; padding: 10px; text-align: center; font-size: 13px; margin-bottom: 20px; margin-top: 10px;">
		                <a style="color: #0083B8; font-weight: normal; text-decoration: none;" href="http://sejmometr.pl/posiedzenia/{$posiedzenie.id}">Więcej informacji o posiedzeniu Sejmu nr {$posiedzenie.tytul_str} &raquo;</a>
		              </div>
								  
								  <div style="margin-bottom: 10px; margin: 0;"><a style="text-decoration: none; color: #0083B8;" href="mailto:redakcja@sejmometr.pl">Zespół Sejmometru</a></div>
							  </div>
								
						  </td>
						</tr>

				  </table>
				  
				</td>
		  </tr>
		</table>
		
	</body>
</html>