<?php
require('inc/phphead.php');
require('inc/head.php');
require('inc/sidebar.php');
if(!array_intersect($codsmanager,$ggids)){
echo'<meta http-equiv="refresh" content="0; url=index">';
die;
}

?>

        <!-- page content -->
		        <div class="right_col" role="main">
          <H3> Admins Controller</H3><small>Client Searcher</small>

		<!-- /top tiles -->	
		
		<div class="row" >
		<center><br>
<div class="row">
	<form method="post">
                  <select  style="width:50%; size="20 class="js-select2 form-control select2-hidden-accessible" name="type" style="width: 100%;">
                  <option value="UID">ايدي العضو</option>
                  <option value="DB">رقم العضو</option>
                </select><br>

		<input class="form-control" style="width:50%; size="20 type="text" placeholder="قم بوضع أيدي العضو أو رقم العضو" size="30" name="user" required><br>
	 	<input style="width:20%; " class="btn btn-success waves-effect waves-light m-b-5" type="submit" name="submit" value="البحث">
	 </form>
	 <br>
	 <div id="dta"></div>
<?php 

if(isset($_POST['submit']) and isset($_POST['user']) and isset($_POST['type'])){
$target = htmlspecialchars(addslashes(trim($_POST['user'])));
$type = $_POST['type'];


$con = new mysqli($host, $user, $pass, $db);
if($type == 'UID'){
$sql = "SELECT * FROM user WHERE uuid='$target' LIMIT 1";
$run = $con->query($sql)->fetch_assoc();
$hisdb = $run["cldbid"];

}elseif($type == 'DB'){
$sql = "SELECT * FROM user WHERE cldbid='$target' LIMIT 1";
$run = $con->query($sql)->fetch_assoc();
$hisdb = $run["cldbid"];

}else{
echo'<META HTTP-EQUIV="refresh" CONTENT="1">';
echo 'Something goes Wrong !';
die;
}

if(!empty($hisdb)){
$lastseen = $run["lastseen"];
$status = $run["online"];
if($status == '1'){
$hisstatus = "<p style='color:green'> Online</p>";
}else{
$hisstatus = "<p style='color:red'> Offline </p>";
}
$system = $run["platform"];

				$cl = $ts3_VirtualServer->clientInfoDb($hisdb);
$name = $cl['client_nickname'];
$hisdes = $cl['client_description'];
$uerid = $cl['client_database_id'];
$IP = $cl['client_lastip'];
 $lastconnect = gmdate("Y-m-d\ h:i:s\ ",$lastseen);
echo"
<h3 style='background-color:#e6f0ff'>
 <div class='tag tag-success'>! Information Founded</div> <br><br>
<div style='background-color:#e6f0ff'>
UserName : ".htmlspecialchars($name)." <br>
Description : ".htmlspecialchars($hisdes)." <br>
id : $uerid <br>
UserIP : $IP <br>
UserLastSeen = $lastconnect <br>
Status :  $hisstatus  
UserIP : $IP <br>
PlatForm : $system <br>
";
try{
$banlist = $ts3_VirtualServer -> banlist();
  foreach ($banlist as $row)
  {
if($row['lastnickname'] == $name){
echo"<div class='tag tag-danger'>محظور من دخول السيرفر !</div>";


}
}
           }     catch (Exception $e) { 
                        }

echo'</div>';
echo'</div>';

echo'</h3>';



}else{

echo"<h3><div class='tag tag-danger'>لم يتم العثور على العضو</div></h3>";
}
}

?>

 <br><br><br><br>

                  <div class="clearfix"></div>
                </div>
                                </div>
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
