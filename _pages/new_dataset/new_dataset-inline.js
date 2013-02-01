var aliases = {$aliases|@json_encode}
var fields = {$fields|@json_encode}
{literal}
$M.addInitCallback(function(){
	   new WIZARD( aliases, fields ); 
});
{/literal}