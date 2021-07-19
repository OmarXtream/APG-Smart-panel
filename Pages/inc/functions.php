<?php
function CountClientsGroup($sgroup) {
global $ts3_VirtualServer;
$servergroup = $ts3_VirtualServer->serverGroupClientList($sgroup);
foreach ($servergroup as $group) {
$result[] = array($group['client_nickname'], $group['client_unique_identifier']); 
}
if(isset($result)){
return count($result);
}else{
return '0';
}
}


function secure($str){

         return htmlspecialchars(addslashes(trim($str)));
         
}

?>