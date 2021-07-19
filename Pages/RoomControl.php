<?php
require('inc/phphead.php');
require('inc/head.php');
require('inc/sidebar.php');

?>

        <!-- page content -->

		        <div class="right_col" role="main">
         <center><h3><strong>التحكم بالغرفة الخاصة بك</h3></strong><hr></center>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="">
                  <div class="x_content">
                    <div class="row">
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">

                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-bullhorn"></i></div>

                          <div class="count"><small>إسم الغرفة</small></div>

                          

                          <h4><strong><?php
echo $ts3_VirtualServer->channelGetById($client->cid)->channel_name;
?>
</h4>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-users"></i></div>

                          <div class="count"><small>اعضاء الغرفة</small></div>

                          <center><h2>
<?php
$ts3_VirtualServer->clientListReset();
$ts3_VirtualServer->channelListReset();
$mem = 0;
foreach($ts3_VirtualServer->channelGetById($client->cid)->clientList(array("client_type" => 0)) as $clientlist) {
$mem++;
}
echo "$mem  : عدد الأعضاء  ";
?>


</h2></center>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-info-circle"></i>
                          </div>
                          <div class="count"><small>رتبتك في الغرفة</small></div>

                          <h3><?php
echo $ts3_VirtualServer->channelGroupGetById($client->client_channel_group_id)->name;
?>
</h3>
                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-question-circle"></i>
                          </div>
                          <div class="count">نوع الغرفة</div>

                         <center><strong> <h3>
<?php
$hiss = $ts3_VirtualServer->channelGetById($client->cid); 
if($hiss->isSpacer()){
echo'╠ ♦  سبير ♦ ╣';
}elseif($hiss->getProperty('channel_flag_permanent') == 1){
echo'╠ ♦  دائم ♦ ╣';
}elseif($hiss->getProperty('channel_flag_semi_permanent') == 1){
echo'╠ ♦  شبه دائم ♦ ╣';
}else{
echo'╠ ♦  مؤقت ♦ ╣';
}
?>
</h3></strong></center>
                        </div>
                      </div>
                    </div>



		<!-- /top tiles -->	
		<div class="row" >


<?php
if(isset($_POST['rmid'])){
if($_POST['rmid'] == $dbid){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! لايمكنك إزالة صلاحياتك </strong></center> 
                                </div>
';
}else{
$cls = $ts3->channelGroupClientList(null,$client->cid,null);
foreach ($cls as $cl){
if($_POST['rmid'] == $cl['cldbid']){
$himrank = $cl['cgid'];
$himdb = $cl['cldbid'];
$your = $ts3_VirtualServer->channelGroupGetById($client->client_channel_group_id)->sortid;
$him = $ts3_VirtualServer->channelGroupGetById($himrank)->sortid;

}
}
if(isset($himdb)){
if(isset($himrank) and $your > $him){
echo '                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! لايمكنك إزالة رتبة مثل رتبتك او أعلى </strong></center> 
                                </div>
';
}else{
try{

$ts3_VirtualServer->clientGetByDbid($_POST['rmid'])->setChannelGroup($client->cid, $ChannelNoRank);
}catch(TeamSpeak3_Exception $e){

if($e->getCode() == 512){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! لايمكنك إزالة رتب شخص غير متصل في السيرفر الآن </strong></center> 
                                </div>
';
}
}
}
}
}
}
?>
<div class="table-responsive">
<table class="table table-striped table-vcenter">
<thead>
<tr>
<th class="text-center" style="width: 120px;"><i class="fa fa-user"></i></th>
<th>الأسم</th>
<th>الأيدنتي</th>
<th >الصلاحيات</th>
<th class="text-center" style="width: 100px;">تحكم</th>
</tr>
</thead>
<tbody>
<?php
			if (in_array($client->client_channel_group_id, $allowedcontrol)){

        try {

$cls = $ts3->channelGroupClientList(null,$client->cid,null);
foreach ($cls as $cl){
$info = $ts3_VirtualServer->clientInfoDb($cl['cldbid']);
$hisuid = $info["client_unique_identifier"];
$hisname = $info['client_nickname'];
$rankname = $ts3_VirtualServer->channelGroupGetById($cl['cgid'])->name;
$ts3_VirtualServer->clientListReset();
$ts3_VirtualServer->channelListReset();
if(!empty($cls)){
echo'

<tr>
<td class="text-center">
<img  src="images/user.png" >
</td>
<td class="font-w600">'.$hisname.'</td>
<td><input size="2" class="form-control input-sm" type="text" id="example-input-small" name="example-input-small" value="[URL=client://0/'.$hisuid.'~'.$hisname.']'.$hisname.'[/URL]" placeholder=".input-sm"></td>

<td>
<span class="label label-info">'.$rankname.'</span>
</td>
<td class="text-center">
<div class="btn-group">
<form method="post">
  <input type="hidden" name="rmid" value="'.$cl['cldbid'].'">
<button class="btn btn-xs btn-default"><i class="fa fa-times" title="إزالة "></i></button>
</form>
</div>
</td></tr>';
echo'<br>';

}
}		
              }  catch (Exception $e) { 
                        }
}else{
				echo "<h2><br><br><strong><center><p class='label label-danger'><i class='fa fa-times'></i> لا يمكنك التحكم بروم غير رومك</center><br>";
				echo "<strong><center><p class='label label-warning'><i class='fa fa-exclamation-triangle'></i>  لتحكم بالروم الخاص بك عليك دخول رومك</center><br></h2>";

}
?>

</tbody>
</table>
</div></div>
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
