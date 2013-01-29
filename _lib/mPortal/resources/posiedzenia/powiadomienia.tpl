<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Sejmometr</title>
  </head>
  
  <body style="margin: 0; padding: 0; color: #444444;" dir="ltr">
      
    <table width="98%" border="0" cellspacing="0" cellpadding="40">
      <tr>
        <td bgcolor="#f7f7f7" width="100%" style="font-family: tahoma,'lucida grande',verdana,arial,sans-serif;">
        
          <table cellpadding="0" cellspacing="0" border="0" width="820" style="background-color: #FFFFFF;">
            <tr>
              <td style="background: #4e769e; color: #FFFFFF; font-weight: bold; font-family: 'lucida grande', tahoma, verdana, arial, sans-serif; padding: 4px 8px; vertical-align: middle; font-size: 16px; letter-spacing: -0.03em; text-align: left;">
                <a style="color:#FFFFFF; text-decoration: none;" href="http://sejmometr.pl"><span style="color:#FFFFFF">Sejmometr</span></a>
              </td>
            </tr>
            <tr>
              <td style="background-color: #FFFFFF; border-bottom: 1px solid #CCCCCC; border-left: 1px solid #CCCCCC; border-right: 1px solid #CCCCCC; vertical-align: top;" valign="top">
              
	              <div style="background-color: #FFFFFF; font-family: tahoma,'lucida grande',verdana,arial,sans-serif; padding: 15px; font-size: 14px;">
		              <div style="margin-bottom: 5px;">Witaj {$USER.name},</div>
		              <div>
		                <p>Zakończyło się <a href="http://sejmometr.pl/posiedzenia/{$posiedzenie.id}" style="color: #0083B8; font-weight: normal; text-decoration: none;">posiedzenie Sejmu nr <span style="color: #D33;">{$posiedzenie.tytul_str}</span></a>. Oto niektóre tematy, którymi zajmowali się posłowie:</p>
		              </div>
		              
		              
		              <div>
		              {section name="tematy" loop=$tematy}
		                {assign var="temat" value=$tematy[tematy].temat}
		                {assign var="items" value=$tematy[tematy].projekty}
		                
		                <p style="font-size: 22px; margin: 20px 0 0;">{$temat.tytul}</p>
		              
		                <div class="items">
										  {section name="items" loop=$items}{assign var="i" value=$items[items]}
										    <div style="padding: 10px 10px 30px; margin-bottom: 10px; border-bottom: 1px solid #CCC;">
										        
								          <p style="padding: 0; margin: 0; font-size: 12px;">{$i.typ_prefix} </p> 
											    <p style="padding: 5px; margin: 0;"><a style="font-size: 14px; color: #0083B8; font-weight: normal; text-decoration: none;" href="http://sejmometr.pl/projekt/{$i.url}">{$i.m_tytul|truncate:200} {if $i.druki_str}<span style="font-size: 12px; color: #444;">{$i.druki_str}</span>{/if}</a></p>
										      
										      <table width="100%" cellpadding="0" cellspacing="0" style="padding: 10px;"><tr>
											      <td style="vertical-align: top; width: 110px">
												      
												      <img src="http://sejmometr.pl/s_dokumenty/thumbs/b/{$i.dokument_id}.png" class="m_avatar" />
												      
											      </td><td style="vertical-align: top; font-size: 12px;">
												      
												      <div class="opis" style="font-size: 15px;">{$i.opis_skrot}</div>
										          
										          <table width="100%;" cellpadding="0" cellspacing="0" style="padding: 10px;"><tr>
											          <td style="vertical-align: top; width: 45px;">
											            {if $i.autorzy_avatar_ids.0.0 || $i.reprezentant_id}
													        <div class="avatars_div">
													          {if $i.autorzy_avatar_ids.0.0}
													            <img src="http://sejmometr.pl/resources/autorzy/avatars/{$i.autorzy_avatar_ids.0.0}_a.png" alt="{$i.autorzy_avatar_ids.0.1}" />
													          {/if}{if $i.reprezentant_id && $i.mowca_avatar eq '1'}
													            <img class="m_avatar" src="http://sejmometr.pl/mowcy/a/3/{$i.reprezentant_id}.jpg" alt="{$i.reprezentant_nazwa}" />
													          {/if}
													        </div>
													        {/if}
											          </td><td style="vertical-align: top; font-size: 12px;">
											            <div class="autor"><b>Status:</b> {$i.status_str}</div>
													        {if $i.autorzy_str}<div class="autor"><b>Autor:</b> {$i.autorzy_str}</div>{/if}
													        {if $i.status_id eq '10'}<div class="autor"><b>Data wniesienia:</b> {$i.data_start|data_slowna}</div>{/if}
											          </td>
										          </tr></table>
										          
										          
											        
											        <table style="margin-top: 10px;" width="100%;" cellpadding="0" cellspacing="0"><tr>
													      <td style="vertical-align: top; font-size: 12px; width: 255px; text-align: right;">
													        <a href="http://sejmometr.pl/punkt/{$i.punkt_id}"><img class="m_avatar" src="http://sejmometr.pl{if $i.wystapienie_video eq '1'}/resources/wystapienia/thumbs/{$i.wystapienie_id}b.jpg{else}/g/debata_baner_1.jpg{/if}" /></a>
													      </td><td style="vertical-align: top; font-size: 14px; text-align: left; padding-left: 10px;">
														      <div style="padding: 0; margin: 0;">
												            <p style="padding: 0; margin: 0 0 5px;">{$i.punkt_stats_str}</p>
												            <p style="padding: 0; margin: 0 0 5px;"><b>{$i.wynik_tytul}</b></p>
												          </div>
												          <p style="padding: 0; margin: 0 0 5px;" class="buttons"><a style="color: #0083B8; font-weight: normal; text-decoration: none;" title="{$i.punkt_nr_str} {$i.punkt_tytul}" class="_BTN blue" href="http://sejmometr.pl/punkt/{$i.punkt_id}">Więcej informacji &raquo;</a></p>
													      </td>
												      </tr></table>
											        

												      
											      </td>
										      </tr></table>
										      
										      
										      
										      
										      
										      
										    </div>
										  {/section}
										</div>
		              
		              
		              {/section}
		              </div>

		              
		              
		              
		              <div style="padding: 20px; text-align: center; font-size: 16px; margin-bottom: 20px; margin-top: 10px;">
		                <a style="color: #0083B8; font-weight: normal; text-decoration: none; font-size: 14px;" href="http://sejmometr.pl/posiedzenia/{$posiedzenie.id}">Więcej informacji o posiedzeniu Sejmu nr {$posiedzenie.tytul_str} &raquo;</a>
		              </div>
								  
								  <div style="font-size: 12px; margin-bottom: 10px; margin: 0; text-align: center;"><a style="text-decoration: none; color: #0083B8;" href="mailto:redakcja@sejmometr.pl">Zespół Sejmometru</a></div>
							  </div>
								
						  </td>
						</tr>

				  </table>
				  
				</td>
		  </tr>
		</table>
		
	</body>
</html>