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
          <H3> Admins Controller</H3><small>BroadCast</small>

		<!-- /top tiles -->	
		
		<div class="row" >
		<center><br>
<div class="row">
						<?php
if(isset($_POST['submit'])){
	
	if(empty($_POST['textm'])){
		
		
	} else {
		$textofmessage = $_POST['textm'];
		$pokee9 = $_POST['poke'];
		if($pokee9 == 1){
			
			
			if($_POST['nor1'] == 1){
				foreach ($ts3_VirtualServer->clientList() as $css) {
						// skip query clients
						if ($css["client_type"]) continue;
						// send test message if client build is outdated
						$logoeee = "[COLOR=#55557f]broadcast ".htmlspecialchars($client_info->client_nickname)." : ".$textofmessage." [/COLOR]";
						$newtextofmessage = substr($logoeee, 0, 100);
						$css->poke($newtextofmessage);

					}	
				
			} else {
				
				foreach ($ts3_VirtualServer->clientList() as $css) {
						// skip query clients
						if ($css["client_type"]) continue;
						// send test message if client build is outdated
						$css->poke($textofmessage);
					}
				
			}
		}
		$message9 = $_POST['message'];
		if($message9 == 1){			
			
			if($_POST['nor1'] == 1){
				foreach ($ts3_VirtualServer->clientList() as $css) {
						// skip query clients
						if ($css["client_type"]) continue;
						// send test message if client build is outdated
						$css->message("[B][COLOR=#55557f]broadcast from[/COLOR] [COLOR=#55aaff]".htmlspecialchars($client_info->client_nickname)."[/COLOR] [COLOR=#ff557f]:[/COLOR] [COLOR=#55aa7f] ".$textofmessage." [/COLOR][/B]");

					}	
				
			} else {
				foreach ($ts3_VirtualServer->clientList() as $css) {
						// skip query clients
						if ($css["client_type"]) continue;
						// send test message if client build is outdated
						$css->message($textofmessage);
					}
			
			}
		
		}

		$room9 = $_POST['room'];
		if($room9 == 1){						
			if($_POST['room'] == 1){
				
			try{
				foreach ($ts3_VirtualServer->channelList() as $channel) {
						// skip query clients
						// send test message if client build is outdated
						$channel->message("[B][COLOR=#55557f]broadcast from[/COLOR] [COLOR=#55aaff]".htmlspecialchars($client_info->client_nickname)."[/COLOR] [COLOR=#ff557f]:[/COLOR] [COLOR=#55aa7f] ".$textofmessage." [/COLOR][/B]");

					}
					
						}catch (Exception $e) {
        echo $e->getCode();

						}	
			} else {
					try{		
				foreach ($ts3_VirtualServer->channelList() as $channel) {
						// skip query clients
						// send test message if client build is outdated
						$channel->message($textofmessage);
						
					}
	

									}catch (Exception $e) {
        echo $e->getCode();

									}	
			}
		
		}		
		
	}

}

?>

                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">إرسال رسالة جماعية</h4>
                        </div>
                        <div class="modal-body">

                          <form method="post" role="form" action="">
						<div class="modal-body">
                          <div class="row">
							<div class="form-group form-material row">
							  <div class="col-sm-3">
								<label class="control-label" for="inputGrid1">عرض اسم المرسل</label>
								<input type="text" class="form-control" id="nor1" name="nor1" placeholder="تبي حط 1">
							  </div>
							  <div class="col-sm-3">
								<label class="control-label" for="inputGrid2">بوك</label>
								<input type="text" class="form-control" id="poke" name="poke" placeholder="تبي حط 1">
							  </div>
							  <div class="col-sm-3">
								<label class="control-label" for="inputGrid2">رسالة خاصة</label>
								<input type="text" class="form-control" id="message" name="message" placeholder="تبي حط 1">
							  </div>
							  <div class="col-sm-3">
								<label class="control-label" for="inputGrid2">كل الرومات</label>
								<input type="text" class="form-control" id="room" name="room" placeholder="تبي حط 1">
							  </div>							  
							</div>
                            <div class="form-group form-material row">
							  <div class="col-sm-9">
								<label class="control-label" for="inputGrid1">الرسالة</label>
								<input type="text" class="form-control" id="textm" name="textm" placeholder="محتوى الرسالة" required>
							  </div>
							</div>

                        <div class="modal-footer">
                          <center><button type="submit" name="submit" class="btn btn-primary">ارسال</button></center>
						  </form>
                        </div>

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
