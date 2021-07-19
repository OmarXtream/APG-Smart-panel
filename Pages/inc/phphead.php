<?php

session_start();
require("data.php");
require("functions.php");
require("db-connect.php");



require('libraries/TeamSpeak3/TeamSpeak3.php');


if (getenv('HTTP_CLIENT_IP')){
	$ip = getenv('HTTP_CLIENT_IP');
}else if(getenv('HTTP_X_FORWARDED_FOR')){
	$ip = getenv('HTTP_X_FORWARDED_FOR');
}else if(getenv('HTTP_X_FORWARDED')){
	$ip = getenv('HTTP_X_FORWARDED');
}else if(getenv('HTTP_FORWARDED_FOR')){
	$ip = getenv('HTTP_FORWARDED_FOR');
}else if(getenv('HTTP_FORWARDED')){
   $ip = getenv('HTTP_FORWARDED');
}else if(getenv('REMOTE_ADDR')){
	$ip = getenv('REMOTE_ADDR');
}
        $result = array();
        $verfied = "0";
        try {
                $ts3_VirtualServer = TeamSpeak3::factory("serverquery://". $config['teamspeak']['loginname'] .":". $config['teamspeak']['loginpass'] ."@". $config['teamspeak']['ip'] .":". $config['teamspeak']['queryport'] ."/?server_port=". $config['teamspeak']['serverport'] ."&nickname=". urlencode($config['teamspeak']['displayname']) ."");
$ts3 = $ts3_VirtualServer;
                foreach ($ts3->clientList() as $cl) {
                                        if ($cl->getProperty('connection_client_ip') == $ip) {
                                                $result[] = $cl->client_nickname;
                                                $client_info = $cl;
                                                $verfied++;
												$unid = $client_info["client_unique_identifier"];
$client_db = $client_info["client_database_id"];
$nickname = $cl->client_nickname;
$_SESSION['ggids'] = explode(",", $client_info["client_servergroups"]);

                $_SESSION['client_uid'] = $unid;
        $client_uid = $unid;
        $client_uid = $unid;
$client = $client_info;
$client_verified = $client;
$nicknames[] = $client["client_nickname"];
$nickname = $client["client_nickname"];
$description = $client["client_description"];
$totalconnections = $client["client_totalconnections"];
$platform = $client["client_platform"];
$country = strtolower($client["client_country"]);
$dbid = $client["client_database_id"];
$_SESSION ['ggids'] = explode(",", $client_verified["client_servergroups"]);
$uid = $client["client_unique_identifier"];
$ggids = explode(",", $client["client_servergroups"]);
$client_db = $client["client_database_id"];
                                }
                        }
                }      
                catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }
                if($verfied == "0"){
                //not in ts
{
require("Disconnected.php");

die;

}	;
                }


if(!in_array($Activated,$ggids)){
echo'
<html>
<head>
<title> Not Act </title>
</head>
<style>
html,body{
background-color:#D3D3D3;
}
</style>
<body>
<center><strong><h1> انت غير مفعل ! الرجاء الإنتظار حتى يتم تفعيلك </h1></strong></center>
</body>
</html>';
die;
}

?>