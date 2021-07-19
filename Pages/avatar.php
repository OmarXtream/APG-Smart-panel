<?php
error_reporting(E_ALL | E_STRICT);
require_once("libraries/TeamSpeak3/TeamSpeak3.php");
TeamSpeak3::init();
$ftdata = TeamSpeak3_Helper_Uri::getUserParam("ftdata");
try 
{
  if(!$ftdata = unserialize(base64_decode($ftdata)))
  {
    throw new Exception("unable to decode file transfer data");
  }
  TeamSpeak3::factory("filetransfer://" . $ftdata["host"] . ":" . $ftdata["port"])->download($ftdata["ftkey"], $ftdata["size"], TRUE);
}
catch(Exception $e)
{
  echo file_get_contents("images/img.png");
}
?>