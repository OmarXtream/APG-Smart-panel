<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);


require('inc/phphead.php');
require('inc/head.php');
require('inc/sidebar.php');

?>

        <!-- page content -->

		        <div class="right_col" role="main">
         <center><h3><strong>التحكم بالكلان الخاص بك</h3></strong><hr></center>
            <div class="clearfix"></div>

            <div class="row">
<?php
  $pdo = new PDO('mysql:host='.$host.';dbname='.$db1.';charset=utf8', ''.$user.'', ''.$pass.'');

  $response = $pdo->prepare('SELECT * FROM clans WHERE owdb = :db');
$response->bindValue(':db', $dbid, PDO::PARAM_INT);
    $response->execute();
    $check = $response->fetch();
    $response->CloseCursor();
if($response->rowCount() == 0){

echo'
                        <div class="well well-warning">
                            <h3><center><strong>لا يوجد لديك صلاحيات ل دخول هذه الصفحه</h3>
</div></div></div>';
require('inc/footer.php');

die;

}else{
$clanname = $check['clanname'];
$clangroup = $check['sgroup'];

if(isset($_POST['send']) and isset($_POST['sendtext']) and isset($_POST['typesend'])){
try{
if($_POST['typesend'] == 'msg'){

$ts3->serverGroupGetByName($clangroup)->message($_POST['sendtext']);

}else{
foreach($ts3_VirtualServer->clientList(array("client_type" => 0)) as $clients) {
$ggid = explode(",", $clients["client_servergroups"]);

if(in_array($clangroup,$ggid)){

$clients->poke($_POST['sendtext']);
}
}
}

									}catch (Exception $e) {
echo $e->getMessage();

									}	


}


}
if(isset($_POST['kick']) and isset($_POST['kickmsg'])and isset($_POST['kickuser'])){
foreach($ts3->clientList() as $cls) {
$ggids = explode(",", $cls["client_servergroups"]);
if($cls["client_database_id"] == $_POST['kickuser'] and in_array($clangroup,$ggids)){
$theuser = $cls["client_database_id"];
$response = $pdo->prepare('SELECT *
FROM clans WHERE owdb = :db
           ');
$response->bindValue(':db', $theuser, PDO::PARAM_INT);
$response->execute();
$response->CloseCursor();
if($response->rowCount() > 0 )
{
echo'
                                <div class="alert alert-warning alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                      <center>          <strong> لا يمكنك طرد اونر الكلان !   </strong>
</center>
                                </div>
';
}else{

$ts3->serverGroupClientDel($clangroup, $theuser);
$ts3->clientGetByDbid($theuser)->message($_POST['kickmsg']);




}
}
}
}


?>

                <div class="row" id="home-content">
                        <!--work progress end-->
                <div class="row">

                

<div class="col-md-4">
        <div class="card profile-card-with-stats box-shadow-2" style="background-color:white">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><center><strong>إرسال رسالة لجميع اعضاء الكلان</h4></div>
                            <div class="card-block">
                          <div class="row">
<form method='post'>
<select name='typesend' class='form-control'>
<option name="poke" value="poke"> poke</option>
<br>
<option name="msg" value="msg"> msg</option>
</select>


							
</div>
	<br><input type="text" class="form-control" id="textm" name="sendtext" placeholder="محتوى الرسالة" required>
                       <br> <br> <center> <button type="submit" name="send" class="btn btn-primary">ارسال</button></center></form>

<br></br><hr>
                            </div>
                        </div></div></div>
                    </div>					  
					  
                   






<div class="col-md-4">
        <div class="card profile-card-with-stats box-shadow-2" style="background-color:white">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><center><strong>طرد عضو من الكلان</h4></div>
                            <div class="card-block">
                          <div class="row">

<form method='post'>
<select name='kickuser' class='form-control'>
<?php
foreach($ts3->clientList() as $cls) {
$ggids = explode(",", $cls["client_servergroups"]);
if(in_array($clangroup,$ggids)){
echo'<option name="'.$cls["client_database_id"].'" value="'.$cls["client_database_id"].'"> '.htmlspecialchars($cls["client_nickname"]).'</option>';
}
}
?>
</select>


							
	<br><input type="text" class="form-control" id="textm" name="kickmsg" placeholder="رسالة الطرد" required>
                       <br> <br> <center> <button type="submit" name="kick" class="btn btn-primary">طرد</button></center></form>

<br></br><hr>
                            
                     </div></div></div></div></div>









                </div>
              </div>
        <!-- /page content -->

<?php
require('inc/footer.php');
?>
