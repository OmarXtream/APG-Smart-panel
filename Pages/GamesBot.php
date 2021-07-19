<?php
require('inc/phphead.php');
require('inc/head.php');
require('inc/sidebar.php');

?>

        <!-- page content -->
		        <div class="right_col" role="main">
          <H3> GamesBot</H3><small>بوت الألعاب</small>

		<!-- /top tiles -->	
		
		<div class="row" >
		<center>

<style>

[title]:hover:after {
  content: attr(title);
  padding: 4px 8px;
  color: #333;
  position: absolute;
  left: 0;
  top: 100%;
  z-index: 20;
  white-space: nowrap;
  -moz-border-radius: 5px;
  -webkit-border-radius: 5px;
  border-radius: 5px;
  -moz-box-shadow: 0px 0px 4px #222;
  -webkit-box-shadow: 0px 0px 4px #222;
  box-shadow: 0px 0px 4px #222;
  background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #eeeeee),color-stop(1, #cccccc));
  background-image: -webkit-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -ms-linear-gradient(top, #eeeeee, #cccccc);
  background-image: -o-linear-gradient(top, #eeeeee, #cccccc);
}
</style>
<?php 
if(isset($_POST['add'])){

// منع الاسبام
if(isset($_SESSION['Ad_G']) and $_SESSION['Ad_G'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! , الرجاء الإنتظار بين محاولاتك</strong></center> 
                                </div>
';
}else{
	$_SESSION['Ad_G'] = microtime(true)+5;
	
// منع الاسبام

	
				if($_SESSION['his'] >= $MAX_GAMES){
							echo'<center><div class="alert alert-danger media fade in">
                          <p><strong>عذراً!</strong> لقد تجاوزت الحد الأقصى  '.$featuerslimit.'</p>
                        </div></center> ';

						}else{	

$game = $_POST['idgame'];
$check = $ts3_VirtualServer->serverGroupGetById($game)->sortid;

if(in_array($check,$gamesids)){
$ts3_VirtualServer->clientGetByUid($uid)->addservergroup($game);
echo '<center>';

						  echo '<div class="alert dark alert-alt alert-success alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						    <a class="alert-link" href="javascript:void(0)"></a><strong><h5><strong>تم اضافة اللعبة
						</div>';

echo '</center>'; 

}
		}
}
}
if(isset($_POST['rm'])){

// منع الاسبام
if(isset($_SESSION['Rd_G']) and $_SESSION['Rd_G'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! , الرجاء الإنتظار بين محاولاتك</strong></center> 
                                </div>
';
}else{
	$_SESSION['Rd_G'] = microtime(true)+5;
	

// منع الاسبام
	


$game = $_POST['idgame'];
$check = $ts3_VirtualServer->serverGroupGetById($game)->sortid;
if(in_array($check,$gamesids)){

$ts3_VirtualServer->clientGetByDbid($dbid)->remservergroup($game);

echo '<center>';

						  echo '<div class="alert dark alert-alt alert-danger alert-dismissible" role="alert">
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						  </button>
						    <a class="alert-link" href="javascript:void(0)"></a><strong><h5><strong>تم إزالة اللعبة 
						</div>';

echo '</center>';

	}

}
}
?>
<?php 
            $iconosm = 0;
            
            $server_groups = $ts3_VirtualServer->serverGroupList();
            $servergroups = array();
            foreach($server_groups as $group) {
                if($group->type != 1) { continue; }
                if(in_array($group["sortid"], $gamesids)) {
                    $servergroups[] = array('name' => (string)$group, 'id' => $group->sgid, 'type' => $group->type);
                }
            } 
			$_SESSION['grupos'] = $servergroups;
        
            foreach($servergroups as $group) {      
                
                $miembros = $ts3_VirtualServer->serverGroupClientList($group["id"]);
                $estaengrupo = False;
                foreach($miembros as $m) {
                    if($m["client_unique_identifier"] == $uid) { 
                        $estaengrupo = True;
                    }                                   
                }
					$gameid = $group["id"];
					$gamename = $group["name"];
				    $icon_image = '<img src="image/'.$gameid.'.png"></img> ';
					

                if($estaengrupo) {
                     $iconosm++;			
			// Here Add 

echo'
                      <div class="col-md-4">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                  <img src="icon.php?id='.$gameid.'" alt="" class="img-circle img-responsive"> <h5 class="brief"><i><strong>'.$gamename.'</strong></i></h5>
                          </div><br><br><strong><h8> '.CountClientsGroup($gameid).' : عدد الاعبين  </h8></strong>
	<form method="post">
  <input type="hidden" name="idgame" value="'.$gameid.'">

                              <center><button type="submit" class="btn btn-danger " name="rm" title="اضغط هنا لإزالة اللعبة"> <strong> إزالة اللعبة </strong></button></center>
					                  </form> 

                          </div>
                        </div>
';
                } else {
//Here Remove
			echo'
                      <div class="col-md-4">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                  <img src="icon.php?id='.$gameid.'" alt="" class="img-circle img-responsive"> <h5 class="brief"><i><strong>'.$gamename.'</strong></i></h5>
                          </div><br><br><strong><h8> '.CountClientsGroup($gameid).' : عدد الاعبين</h8></strong>
	<form method="post">
  <input type="hidden" name="idgame" value="'.$gameid.'">

                              <center><button type="submit" class="btn btn-success " name="add" title="اضغط هنا لإضافة اللعبة"> <strong> إضافة اللعبة</strong></button></center>
					                  </form> 

                          </div>
                       
    </div>';

                }
			}
			
 $_SESSION['his'] = $iconosm;

?>

                        </div>

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
