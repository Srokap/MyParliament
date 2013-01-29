<?
  $poslowie = $this->DB->selectAssocs("SELECT poslowie.id, poslowie.nid, poslowie.nazwa, klub as 'klub_id', TIMESTAMPDIFF(YEAR, poslowie.data_urodzenia, NOW()) as 'wiek', poslowie.plec, poslowie.wojewodztwo_id, wojewodztwa.przymiotnik_b, wojewodztwa.url_id, poslowie.wyksztalcenie, poslowie.zawod, druki_autorzy.autor as 'klub_nazwa' FROM obserwowani_poslowie JOIN poslowie ON obserwowani_poslowie.posel_nid=poslowie.nid LEFT JOIN wojewodztwa ON poslowie.wojewodztwo_id=wojewodztwa.id LEFT JOIN druki_autorzy ON poslowie.klub=druki_autorzy.id WHERE obserwowani_poslowie.user_id=".$this->USER['id']." ORDER BY poslowie.glosowania_fraza");
  
  return array(
    'poslowie' => $poslowie,
  );
?>