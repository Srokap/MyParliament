<?php
function smarty_function_sex($params, &$smarty) {  
  if( $_SESSION['Client']['sex']=='F' ) { return $params['f']; }
  else { return $params['m']; }
}
?> 