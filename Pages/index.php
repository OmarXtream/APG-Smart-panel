<?php

session_start();
require_once('../../Ranks/other/config.php');
require_once('../../Ranks/other/session.php');
require_once('../../Ranks/other/load_addons_config.php');

$addons_config = load_addons_config($mysqlcon,$lang,$dbname,$timezone,$logpath);

if(!isset($_SESSION['tsuid']) || isset($_SESSION['uuid_verified'])) {
	set_session_ts3($ts['voice'], $mysqlcon, $dbname, $language, $adminuuid);
}

$getstring = $_SESSION['tsuid'];
$searchmysql = 'WHERE uuid LIKE \'%'.$getstring.'%\'';

$dbdata = $mysqlcon->query("SELECT * FROM $dbname.user $searchmysql");
$dbdata_fetched = $dbdata->fetchAll();
$count_hours = round($dbdata_fetched[0]['count']/3600);
$idle_hours = round($dbdata_fetched[0]['idle']/3600);
$except = $dbdata_fetched[0]['except'];

if ($substridle == 1) {
	$activetime = $dbdata_fetched[0]['count'] - $dbdata_fetched[0]['idle'];
} else {
	$activetime = $dbdata_fetched[0]['count'];
}
$active_count = $dbdata_fetched[0]['count'] - $dbdata_fetched[0]['idle'];

krsort($grouptime);
$grpcount = 0;
$nextgrp = '';

foreach ($grouptime as $time => $groupid) {
	$grpcount++;
	$actualgrp = $time;
	if ($activetime > $time) {
		break;
	} else {
		$nextup = $time - $activetime;
		$nextgrp = $time;
	}
}
if($actualgrp==$nextgrp) {
	$actualgrp = 0;
}
if($activetime>$nextgrp) {
	$percentage_rankup = 100;
} else {
	$takedtime = $activetime - $actualgrp;
	$neededtime = $nextgrp - $actualgrp;
	$percentage_rankup = round($takedtime/$neededtime*100);
}

$stats_user = $mysqlcon->query("SELECT * FROM $dbname.stats_user WHERE uuid='$getstring'");
$stats_user = $stats_user->fetchAll();

if (isset($stats_user[0]['count_week'])) $count_week = $stats_user[0]['count_week']; else $count_week = 0;
$dtF = new DateTime("@0"); $dtT = new DateTime("@$count_week"); $count_week = $dtF->diff($dtT)->format($timeformat);
if (isset($stats_user[0]['active_week'])) $active_week = $stats_user[0]['active_week']; else $active_week = 0;
$dtF = new DateTime("@0"); $dtT = new DateTime("@$active_week"); $active_week = $dtF->diff($dtT)->format($timeformat);
if (isset($stats_user[0]['count_month'])) $count_month = $stats_user[0]['count_month']; else $count_month = 0;
$dtF = new DateTime("@0"); $dtT = new DateTime("@$count_month"); $count_month = $dtF->diff($dtT)->format($timeformat);
if (isset($stats_user[0]['active_month'])) $active_month = $stats_user[0]['active_month']; else $active_month = 0;
$dtF = new DateTime("@0"); $dtT = new DateTime("@$active_month"); $active_month = $dtF->diff($dtT)->format($timeformat);
if (isset($dbdata_fetched[0]['count'])) $count_total = $dbdata_fetched[0]['count']; else $count_total = 0;
$dtF = new DateTime("@0"); $dtT = new DateTime("@$count_total"); $count_total = $dtF->diff($dtT)->format($timeformat);
$dtF = new DateTime("@0"); $dtT = new DateTime("@$active_count"); $active_count = $dtF->diff($dtT)->format($timeformat);

$time_for_bronze = 50;
$time_for_silver = 100;
$time_for_gold = 250;
$time_for_legendary = 500;

$connects_for_bronze = 50;
$connects_for_silver = 100;
$connects_for_gold = 250;
$connects_for_legendary = 500;

$achievements_done = 0;

if($count_hours >= $time_for_legendary) {
	$achievements_done = $achievements_done + 4; 
} elseif($count_hours >= $time_for_gold) {
	$achievements_done = $achievements_done + 3;
} elseif($count_hours >= $time_for_silver) {
	$achievements_done = $achievements_done + 2;
} else {
	$achievements_done = $achievements_done + 1;
}
if($_SESSION['tsconnections'] >= $connects_for_legendary) {
	$achievements_done = $achievements_done + 4;
} elseif($_SESSION['tsconnections'] >= $connects_for_gold) {
	$achievements_done = $achievements_done + 3;
} elseif($_SESSION['tsconnections'] >= $connects_for_silver) {
	$achievements_done = $achievements_done + 2;
} else {
	$achievements_done = $achievements_done + 1;
}

function get_percentage($max_value, $value) {
	return (round(($value/$max_value)*100));
}



require('inc/phphead.php');
require('inc/head.php');
require('inc/sidebar.php');

?>
        <!-- page content -->
			   <div class="right_col" role="main">
			   		     <MARQUEE onmouseover='this.stop()' onmouseout='this.start()' scrollAmount="3" scrollDelay=60 direction=right><->  <b><a href="#" title="اللوحة لا تزال تحت التطوير والبرمجة" target=_blank>الرجاء إبلاغنا عند اكتشاف اي عطل في اللوحة</a>  <->  </b><b><a  title="<?php echo $servername; ?>" target=_blank><?php echo $servername; ?>  تم إفتتاح السيرفر </a>  <->  </b><b><a href="#" title="<?php echo $servername; ?>" target=_blank>●   تتمنى لكم أسعد الأوقات .</a>  <->  </b><b><a href="#" title="#Mr.omar :المسؤول عن اللوحة " target=_blank# لاتزال اللوحة تحت التطوير والبرمجة) ..</a>   </b></marquee></td></tr></table>

		  <H3> الصفحة الرئيسية</H3><small>معلومات اللآعب</small>

		<!-- /top tiles -->	
		<div class="row" >
		
		                          <div class="col-md-6" >
                            <div class="panel panel-danger">
                              <div class="panel-heading">
                <h4 class="panel-title">
                  User information
                              </div>

                              <div class="panel-body">

<b><h style="font-size:16px">Nickname : <h style='color:#4BB2FC'><?php echo htmlspecialchars($client_info["client_nickname"]);?></h></h></b><br> 
						<b><h style="font-size:16px">your IP : <h style='color:#4BB2FC'><?php echo $client_info["connection_client_ip"];?></h></h></b><br> 						
						<b><h style="font-size:16px">Description : <h style='color:#4BB2FC'><?php echo htmlspecialchars($client_info["client_description"]);?></h></h></b><br> 
						<b><h style="font-size:16px">Total Connections : <h style='color:#4BB2FC'><?php echo $client_info["client_totalconnections"];?></h></h></b><br>
						<b><h style="font-size:16px">OS : <h style='color:#4BB2FC'><?php echo $client_info["client_platform"];?></h></h></b><br>
						<b><h style="font-size:16px">Country : <h style='color:#4BB2FC'><?php echo $client_info["client_country"];?></h></h></b><br>
						<b><h style="font-size:16px">Database ID : <h style='color:#4BB2FC'><?php echo $client_info["client_database_id"];?></h></h></b><br>
						<b><h style="font-size:16px">Unique Identifier : <h style='color:#4BB2FC'><?php echo $client_info["client_unique_identifier"];?></h></h></b></div>           </div>

		          	</div>
		<div class="row" >
		
		                          <div class="col-md-6" >
                            <div class="panel panel-danger">
                              <div class="panel-heading">
                <h4 class="panel-title">
                  Levels System | نظام اللفلات
                              </div>
							  
                              <div class="panel-body">

						<b><h style="font-size:16px">your Level  : <h style='color:#4BB2FC'>

                               <?php
							   $_SESSION['ggids'] = $ggids;
				  if(in_array($rank0,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank0 . '">';
				  echo "<h style='color:#ff0000'</h>0";
				  }
				  if(in_array($rank1,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank1 . '">';
				  echo "<h style='color:#ff0000'</h>1";

				  }
				  if(in_array($rank2,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank2 . '">';
				  echo "<h style='color:#ff0000'</h>2";

				  }
				  if(in_array($rank3,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank3 . '">';
				  echo "<h style='color:#ff0000'</h>3";

				  }
				  if(in_array($rank4,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank4 . '">';
				  echo "<h style='color:#ff0000'</h>4";

				  }
				  if(in_array($rank5,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank5 . '">';
				  echo "<h style='color:#ff0000'</h>5";
				  }
				  if(in_array($rank6,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank6 . '">';
				  echo "<h style='color:#ff0000'</h>6";
				  }
				  if(in_array($rank7,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank7 . '">';
				  echo "<h style='color:#ff0000'</h>7";
				  }
				  if(in_array($rank8,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank8 . '">';
				  echo "<h style='color:#ff0000'</h>8";
				  }
				  if(in_array($rank9,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank9 . '">';
				  echo "<h style='color:#ff0000'</h>9";
				  }
				  if(in_array($rank10,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank10 . '">';
				  echo "<h style='color:#ff0000'</h>10";
				  }
				  if(in_array($rank11,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank11 . '">';
				  echo "<h style='color:#ff0000'</h>11";
				  }
				  if(in_array($rank12,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank12 . '">';
				  echo "<h style='color:#ff0000'</h>12";
				  }
				  if(in_array($rank13,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank13 . '">';
				  echo "<h style='color:#ff0000'</h>13";
				  }
				  if(in_array($rank14,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank14 . '">';
				  echo "<h style='color:#ff0000'</h>14";
				  }
				  if(in_array($rank15,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank15 . '">';
				  echo "<h style='color:#ff0000'</h>15";
				  }
				  if(in_array($rank16,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank16 . '">';
				  echo "<h style='color:#ff0000'</h>16";
				  }
				  if(in_array($rank17,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank17 . '">';
				  echo "<h style='color:#ff0000'</h>17";
				  }
				  if(in_array($rank18,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank18 . '">';
				  echo "<h style='color:#ff0000'</h>18";
				  }
				  if(in_array($rank19,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank19 . '">';
				  echo "<h style='color:#ff0000'</h>19";
				  }
				  if(in_array($rank20,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank20 . '">';
				  echo "<h style='color:#ff0000'</h>20";
				  }
				  if(in_array($rank21,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>21";
				  }
				  if(in_array($rank22,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>22";
				  }
				  if(in_array($rank23,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>23";
				  }
				  if(in_array($rank24,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>24";
				  }
				  if(in_array($rank25,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>25";
				  }
				  if(in_array($rank26,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>26";
				  }
				  if(in_array($rank27,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>27";
				  }
				  if(in_array($rank28,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>28";
				  }
				  if(in_array($rank29,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>29";
				  }
				  if(in_array($rank30,$_SESSION['ggids'])){
				  echo "<h style='color:red'</h>MAX";
				  }




?>
</h></h></b><br> 	
					
						<b><h style="font-size:16px"> Next Level : <h style='color:#4BB2FC'>
                         <?php
				  if(in_array($rank0,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank1 . '">';
				  echo "<h style='color:#ff0000'</h>1";
				  }
				  if(in_array($rank1,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank2 . '">';
				  echo "<h style='color:#ff0000'</h>2";
				  }
				  if(in_array($rank2,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank3 . '">';
				  echo "<h style='color:#ff0000'</h>3";
				  }
				  if(in_array($rank3,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank4 . '">';
				  echo "<h style='color:#ff0000'</h>4";
				  }
				  if(in_array($rank4,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank5 . '">';
				  echo "<h style='color:#ff0000'</h>5";
				  }
				  if(in_array($rank5,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank6 . '">';
				  echo "<h style='color:#ff0000'</h>6";
				  }
				  if(in_array($rank6,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank7 . '">';
				  echo "<h style='color:#ff0000'</h>7";
				  }
				  if(in_array($rank7,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank8 . '">';
				  echo "<h style='color:#ff0000'</h>8";
				  }
				  if(in_array($rank8,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank9 . '">';
				  echo "<h style='color:#ff0000'</h>9";
				  }
				  if(in_array($rank9,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank10. '">';
				  echo "<h style='color:#ff0000'</h>10";
				  }
				  if(in_array($rank10,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank11 . '">';
				  echo "<h style='color:#ff0000'</h>11";
				  }
				  if(in_array($rank11,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank12 . '">';
				  echo "<h style='color:#ff0000'</h>12";
				  }
				  if(in_array($rank12,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank13 . '">';
				  echo "<h style='color:#ff0000'</h>13";
				  }
				  if(in_array($rank13,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank14 . '">';
				  echo "<h style='color:#ff0000'</h>14";
				  }
				  if(in_array($rank14,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank15 . '">';
				  echo "<h style='color:#ff0000'</h>15";
				  }
				  if(in_array($rank15,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank16 . '">';
				  echo "<h style='color:#ff0000'</h>16";
				  }
				  if(in_array($rank16,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank17 . '">';
				  echo "<h style='color:#ff0000'</h>17";
				  }
				  if(in_array($rank17,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank18 . '">';
				  echo "<h style='color:#ff0000'</h>18";
				  }
				  if(in_array($rank18,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank19 . '">';
				  echo "<h style='color:#ff0000'</h>19";
				  }
				  if(in_array($rank19,$_SESSION['ggids'])){
                                  echo'<img src="icon.php?id='. $rank20 . '">';
				  echo "<h style='color:#ff0000'</h>20";
				  }
				  if(in_array($rank20,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>21";
				  }
				  if(in_array($rank21,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>22";
				  }
				  if(in_array($rank22,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>23";
				  }
				  if(in_array($rank23,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>24";
				  }
				  if(in_array($rank24,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>25";
				  }
				  if(in_array($rank25,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>26";
				  }
				  if(in_array($rank26,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>27";
				  }
				  if(in_array($rank27,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>28";
				  }
				  if(in_array($rank28,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>29";
				  }
				  if(in_array($rank29,$_SESSION['ggids'])){
				  echo "<h style='color:#ff0000'</h>30";
				  }
				  if(in_array($rank30,$_SESSION['ggids'])){
				  echo "<h style='color:red'</h>MAX";
				  }
?>




</h></h></b><br> 
						<b><h style="font-size:16px">Time to Next Level  : <h style='color:#4BB2FC'>

                <div class="progress">
							<div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" aria-valuenow="<?PHP echo $percentage_rankup; ?>" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?PHP echo $percentage_rankup; ?>%;">
								<?PHP echo $percentage_rankup," %"; ?>
</div>
					</div>			  


</h></h></b><br>

		          	</div>

                    </li>
                  </ul>
                  <div class="clearfix"></div>
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
