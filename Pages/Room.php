<?php

require('inc/phphead.php');
require('inc/head.php');
require('inc/sidebar.php');

?>

        <!-- page content -->
		        <div class="right_col" role="main">
          <H3> Permanent Room</H3><small>إنشاء روم دائم</small>

		<!-- /top tiles -->	
		
		<div class="row" >
		<center><br>
<?php




if (isset($_POST['submit'])){
$RoomName = secure($_POST['RoomName']);
if (empty($RoomName)){
echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>         الرجاء وضع إسم  <strong>الغرفة  ! </strong></center> 
                                </div>
';
}else{
try{
$channels = $ts3_VirtualServer->channelList();
foreach($channels as $channel){
if ($channel == $RoomName){
echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>         لقد تم إستخدام هذا الإسم   <strong>من قبل  ! </strong></center> 
                                </div>
';
break;
}
}

$top_cid = $ts3_VirtualServer->channelCreate(array(
  "channel_name"          => "$RoomName",
  "channel_topic"          => "$nickname",
  "channel_codec"          => TeamSpeak3::CODEC_OPUS_VOICE,
  "channel_codec_quality"  => 0x05,
  "channel_flag_permanent" => TRUE,
  "cpid"                  => "$RoomsPlace",
));

$ts3_VirtualServer->clientGetByDbid($client_db)->move($top_cid);
$ts3_VirtualServer->clientGetByDbid($client_db)->poke("[B]تم إنشاء غرفة شخصية لك");
$ts3_VirtualServer->clientSetChannelGroup($client_db,$top_cid,$RoomOwner);
  $pdo = new PDO('mysql:host='.$host.';dbname='.$db1.';charset=utf8', ''.$user.'', ''.$pass.'');

        $stmt= $pdo->prepare('INSERT INTO rooms ( name, cdb, creation_date, chid) 
                             VALUES (:nem, :cdb, NOW(), :ch)
                           ');
        $stmt->bindValue(':nem',"$nickname",PDO::PARAM_STR);
        $stmt->bindValue(':cdb', "$client_db", PDO::PARAM_INT);
        $stmt->bindValue(':ch', "$top_cid", PDO::PARAM_INT);


        $stmt->execute();        
        $stmt->CloseCursor();








           }     catch (Exception $e) { 
                        echo '<div style="background-color:red; color:white; display:block; font-weight:bold;">QueryError: ' . $e->getCode() . ' ' . $e->getMessage() . '</div>';
                        die;
                        }




}
}

  $pdo = new PDO('mysql:host='.$host.';dbname='.$db1.';charset=utf8', ''.$user.'', ''.$pass.'');

    $response = $pdo->prepare('SELECT * FROM rooms');
    $response->execute();
    $rooms = $response->fetchAll();
    $response->CloseCursor();
		
    foreach($rooms as $check) {

        if ($check['cdb'] == $client_db) {

$hisroom = 1;

}
}



if(in_array($rank7,$ggids) || in_array($rank8,$ggids) || in_array($rank9,$ggids) || in_array($rank10,$ggids) || in_array($rank11,$ggids) || in_array($rank12,$ggids) || in_array($rank13,$ggids) || in_array($rank14,$ggids) || in_array($rank15,$ggids) || in_array($rank16,$ggids) || in_array($rank17,$ggids) || in_array($rank18,$ggids) || in_array($rank19,$ggids)|| in_array($rank20,$ggids)|| in_array($rank21,$ggids)|| in_array($rank22,$ggids)|| in_array($rank23,$ggids)|| in_array($rank24,$ggids)|| in_array($rank25,$ggids)|| in_array($rank26,$ggids)|| in_array($rank27,$ggids)|| in_array($rank28,$ggids)|| in_array($rank29,$ggids)|| in_array($rank30,$ggids)  and empty($hisroom))
{		 
echo'
     <form method="post">
                                            <center><input type="text" class="form-control" placeholder="إسم الغرفة" name="RoomName" required><br>


                                       
                            <center><button type="submit" name="submit" class="btn btn-primary start"><i class="glyphicon glyphicon-upload"></i> إنشاء الغرفة</button>

                                <br></center>';
}elseif(!empty($hisroom)){	
echo '                         <div class="panel panel-info">
                            <div class="panel-heading">
                                <header class="panel-title">
                                    <strong><center>للأسف </center></strong>
                                </header>
                            </div>
                            <div class="panel-body">
                              <h2>  لقد قمت بإنشاء روم شخصي مسبقا !</h2>
                            </div>
                        </div>
';

}else{
echo '                         <div class="panel panel-warning">
                            <div class="panel-heading">
                                <header class="panel-title">
                                    <strong><center>للأسف </center></strong>
                                </header>
                            </div>
                            <div class="panel-body">
                              <h2>  لا يمكنك إنشاء غرفة شخصية الرجاء مراجعة شروط الإنشاء  في قوانين السيرفر</h2>
                            </div>
                        </div>
';

}
?>



                  <div class="clearfix"></div>
                </div>
                




                </div>
                <!-- end of weather widget -->
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<?php
require('inc/footer.php');
?>
