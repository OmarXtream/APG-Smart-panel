<?php
require('libraries/TeamSpeak3/TeamSpeak3.php');
require('inc/data.php');
                $ts3_VirtualServer = TeamSpeak3::factory("serverquery://". $config['teamspeak']['loginname'] .":". $config['teamspeak']['loginpass'] ."@". $config['teamspeak']['ip'] .":". $config['teamspeak']['queryport'] ."/?server_port=". $config['teamspeak']['serverport'] ."&nickname=Test");

date_default_timezone_set('Asia/Riyadh');
set_time_limit(4);
$boton = 1;
try{
TeamSpeak3::init();
$ts3 = $ts3_VirtualServer;
if($boton == '1'){
	$ts3->clientListReset();
	$ts3->channelListReset();
	foreach($ts3->clientList(array("client_type" => 0)) as $client)
				{
for($x = 0; $x <= 10; $x++){
$client->message($x);
sleep(1);
if($x == 10){
$client->message('بدات الفعاليه');
}
}
}
$ts3->logout();


			}

} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>