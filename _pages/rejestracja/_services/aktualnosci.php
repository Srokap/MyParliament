<?
  function sm_pl( $posel ){
    return '<a href="/'.$posel['id'].'">'.$posel['nazwa'].'</a>';
  }



  $_poslowie = $this->DB->selectAssocs("SELECT id, nid, nazwa, plec FROM poslowie WHERE nid IN (SELECT posel_nid FROM obserwowani_poslowie WHERE user_id=".$this->USER['id'].")");
  $poslowie = array();
  foreach( $_poslowie as $p )
    $poslowie[ $p['nid'] ] = $p;
  
  
  
  
  
  
  
  
  $na_strone = 20;
  $strony_wychylenie = 7;
  $strona = (int) $_GET['str'];
  if( $strona<=0 ) $strona=1;
  $_str = $strona-1;
  $_limit_start = $_str*$na_strone;
  
  $tablica = $this->DB->selectAssocs("SELECT SQL_CALC_FOUND_ROWS typ_id, eid, title, `desc`, date, COUNT(*), GROUP_CONCAT(posel_nid) as 'poslowie_str' FROM poslowie_tablice WHERE posel_nid IN (SELECT posel_nid FROM obserwowani_poslowie WHERE user_id=".$this->USER['id'].") GROUP BY typ_id, eid ORDER BY date DESC LIMIT $_limit_start, $na_strone");
  
  $total = $this->DB->found_rows();
  $ilosc_stron = ceil($total/$na_strone);
  $strony_start = max(1, $strona - $strony_wychylenie+1);
  $elementy_start = $na_strone*($_str)+1;
  
  $paginacja = array(
    'total' => $total,
    'strona' => $strona,
    'na_strone' => $na_strone,
    'ilosc_stron' => $ilosc_stron,
    'strony_start' => $strony_start,
    'strony_koniec' => min($ilosc_stron+1, $strona + $strony_wychylenie),
    'elementy_start' => $elementy_start,
    'elementy_koniec' => min($elementy_start+$na_strone-1, $total),
  );
  
  
  
  
  
  
  

  
  $glosowania_data = array();
  $last_date = false;
  $last_typ_id = false;
  foreach( $tablica as &$t ) {
    
    $t['poslowie_nids'] = @explode( ',', $t['poslowie_str'] );
    $poslowie_nids = $t['poslowie_nids'];
    $t['poslowie_count'] = count( $poslowie_nids );
    
    if( $t['poslowie_count']>0 ) {
      
      $kobiety = true;
      foreach( $t['poslowie_nids'] as $nid )
        if( $poslowie[$nid]['plec']!='K' ) {
          $kobiety = false;
          break;
        }
      
      $t['kobiety'] = $kobiety;
      
      if( $t['poslowie_count']==1 ) {
        $str = sm_pl( $poslowie[ $poslowie_nids[0] ] );
      } elseif( $t['poslowie_count']==2 ) {
        $str = sm_pl( $poslowie[ $poslowie_nids[0] ] ).' i '.sm_pl( $poslowie[ $poslowie_nids[1] ] );
      } else {
        $last = array_pop( $poslowie_nids );
        foreach( $poslowie_nids as &$p )
          $p = sm_pl( $poslowie[$p] );
        $str = implode(', ', $poslowie_nids).' i '.sm_pl( $poslowie[ $last ] );
      }
    }
    
    $t['poslowie_str'] = $str;
    
    
    
    
    
    if( $t['date']!=$last_date || $last_typ_id=='5' ) $t['nd'] = true;
  
    $t['className'] = $_classes[ $t['typ_id'] ];
    
    // PROJEKTY
    if( $t['typ_id']=='1' ) {
      
      $t = array_merge( $t, $this->DB->selectAssoc("SELECT projekty.id, projekty.url_title, projekty.opis, projekty.tytul, druki.numer, projekty.autor_id, druki_autorzy.autor, druki.dokument_id FROM projekty JOIN druki ON projekty.druk_id=druki.id JOIN druki_autorzy ON projekty.autor_id=druki_autorzy.id WHERE projekty.id='".$t['eid']."'") );
    
    } elseif( $t['typ_id']=='4' ) {
      
      $glosowania_poslowie = array();
      foreach( $t['poslowie_nids'] as $p ) {
        $posel_id = $poslowie[ $p ]['id'];
        $glosowania = $this->DB->selectAssocs("SELECT glosowania.id, glosowania.numer, glosowania.czas, glosowania.typ_id, glosowania.tytul as '_tytul', glosowania.wynik as '_wynik', glosowania.z, glosowania.p, glosowania.w, glosowania.n, glosowania.frekwencja, glosowania.przewaga, glosowania_numerowane.akcept as 'numerowane' FROM (SELECT * FROM glosowania_glosy WHERE punkt_id='".$t['eid']."' AND nid=$p AND bunt='1') as glosowania_glosy JOIN glosowania ON glosowania_glosy.glosowanie_id=glosowania.id LEFT JOIN glosowania_numerowane ON glosowania.id=glosowania_numerowane.id WHERE glosowania.akcept='1' AND glosowania.typ_id!=2 AND glosowania.typ_id!=3 AND glosowania.typ_id!=9 AND glosowania.punkt_id='".$t['eid']."'");
        $glosowania_poslowie[] = array(
          'posel_id' => $posel_id,
          'glosowania' => $glosowania,
        );
      }
        
      $glosowania_data = array_merge( $glosowania_data, $glosowania );
      $t['glosowania_poslowie'] = $glosowania_poslowie;
    
    } elseif( $t['typ_id']=='5' ) {
      // $t = array_merge( $t, $this->DB->selectAssoc("SELECT posiedzenia_poslowie.ilosc_nieobecnosci, posiedzenia_poslowie.procent_nieobecnosci, posiedzenia_poslowie.nieobecnosc, posiedzenia_poslowie.ilosc_buntow, posiedzenia_mowcy.ilosc_wypowiedzi, posiedzenia_mowcy.ilosc_slow, posiedzenia.ilosc_glosowan FROM posiedzenia JOIN (SELECT * FROM posiedzenia_poslowie WHERE posel_id='$posel_id') AS posiedzenia_poslowie ON posiedzenia.id=posiedzenia_poslowie.posiedzenie_id LEFT JOIN (SELECT * FROM posiedzenia_mowcy WHERE autor_id='$posel_id') AS posiedzenia_mowcy ON posiedzenia.id=posiedzenia_mowcy.posiedzenie_id WHERE posiedzenia.id='".$t['eid']."'") );
      // $t['frekwencja'] = 100-$t['procent_nieobecnosci'];
      
    } elseif( $t['typ_id']=='3' ) {
  
      
      list( $debata_opis, $debata_typ_id ) = $this->DB->selectRow("SELECT opis, typ_id FROM punkty_wypowiedzi WHERE id='".$t['eid']."'");
      $t['debata_opis'] = $debata_opis;
      $t['debata_typ_id'] = $debata_typ_id;
      
      if( $debata_typ_id=='6' ) {
        
        $oswiadczenia_poslowie = array();
        foreach( $t['poslowie_nids'] as $p ) {
          $posel_id = $poslowie[ $p ]['id'];
          $oswiadczenia_poslowie[] = array(
            'posel_id' => $posel_id,
            'oswiadczenia' => $this->DB->selectAssocs("SELECT id, skrot FROM wypowiedzi WHERE punkt_id='".$t['eid']."' AND autor_id='".$posel_id."'"),
          );
        }
        
        $t['oswiadczenia_poslowie'] = $oswiadczenia_poslowie;
      }
      
    }
    
    
    
    
    
    $last_date = $t['date'];
    $last_typ_id = $t['typ_id'];
    
    
  }
    
  
  
  
  
  
  
  
  
  
  return array(
    'tablica' => $tablica,
    'paginacja' => $paginacja,
    'glosowania_data' => $glosowania_data,
    'poslowie' => $poslowie,
  );
  
?>