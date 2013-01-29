<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>OchParliament</title>
  </head>
  
  <body style="margin: 0; padding: 0; color: #444444;" dir="ltr">
      
    <table width="98%" border="0" cellspacing="0" cellpadding="40">
      <tr>
        <td bgcolor="#f7f7f7" width="100%" style="font-family: tahoma,'lucida grande',verdana,arial,sans-serif;">
        
          <table cellpadding="0" cellspacing="0" border="0" width="620">
            <tr>
              <td style="background: #4e769e; color: #FFFFFF; font-weight: bold; font-family: 'lucida grande', tahoma, verdana, arial, sans-serif; padding: 4px 8px; vertical-align: middle; font-size: 16px; letter-spacing: -0.03em; text-align: left;">
              </td>
            </tr>
            <tr>
              <td style="background-color: #FFFFFF; border-bottom: 1px solid #CCCCCC; border-left: 1px solid #CCCCCC; border-right: 1px solid #CCCCCC; font-family: tahoma,'lucida grande',verdana,arial,sans-serif; padding: 15px;" valign="top">
              
	              <div style="font-size: 12px;">
		              <div style="margin-bottom: 5px;">Witaj {$USER.name},</div>
		              <div>
		                <p>Aby dokończyć rejestrację na portalu OchParliament przejdź na stronę <a href="#" style="text-decoration: none; color: #0083B8;">{$SITE_ADDRESS}start</a> i wklej poniższy kod do formularza <span style="color: #777;">(musisz być zalogowan{if $USER.plec eq "female"}a{else}y{/if})</span>:</p>
		              </div>
		              <div style="margin: 10px; overflow: auto; font-size: 17px; color: #555;">
		                <p>{$USER.email_pass}</p>
								  </div>
								  <div style="margin-bottom: 10px; margin: 0;"></div>
							  </div>
								
						  </td>
						</tr>

				  </table>
				  
				</td>
		  </tr>
		</table>
		
	</body>
</html>