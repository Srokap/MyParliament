<?
  return array(
    'posiedzenie' => $this->DB->selectAssoc("SELECT id, numer, data_tytul FROM posiedzenia WHERE pokazuj='1' ORDER BY numer+0 DESC LIMIT 1"),
    'projekty' => $this->DB->selectAssocs("SELECT projekty.id, druki.dokument_id, druki_autorzy.autor, druki.numer, projekty.tytul, projekty.opis, projekty.status_slowny, projekty.data_wplynal, projekty.url_title FROM projekty LEFT JOIN druki ON projekty.druk_id=druki.id LEFT JOIN druki_autorzy ON projekty.autor_id=druki_autorzy.id WHERE projekty.akcept='1' AND projekty.status!=0 ORDER BY projekty.data_wplynal DESC LIMIT 5"),
  );
?>