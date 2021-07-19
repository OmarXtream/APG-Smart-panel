<?php
if(isset($_GET['id']) and !empty($_GET['id']) and ctype_digit($_GET['id'])) {
        require_once("inc/data.php");


require_once("libraries/TeamSpeak3/TeamSpeak3.php");
                $ts3_VirtualServer = TeamSpeak3::factory("serverquery://". $config['teamspeak']['loginname'] .":". $config['teamspeak']['loginpass'] ."@". $config['teamspeak']['ip'] .":". $config['teamspeak']['queryport'] ."/?server_port=". $config['teamspeak']['serverport'] ."&nickname=". urlencode($config['teamspeak']['displayname']) ."");

$group = $ts3_VirtualServer->serverGroupGetById($_GET['id']);
$icon = $group->iconDownload();
$image = imagecreatefromstring($icon);

header('Content-Type: image/png');

imagesavealpha($image, true);

imagepng($image);

imagedestroy($image);
}


?>
 