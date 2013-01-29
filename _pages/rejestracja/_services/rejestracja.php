<?
  return array(
    'posiedzenie' => $this->DB->selectAssoc("SELECT id, numer, data_tytul FROM posiedzenia WHERE pokazuj='1' ORDER BY numer+0 DESC LIMIT 1"),
    'genders' => array('male'=>'Mężczyzna', 'female'=>'Kobieta'),
  );
?>