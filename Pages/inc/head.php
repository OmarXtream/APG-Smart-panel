<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $servername; ?> | TeamSpeak Panel </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="css/check.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
  <link rel="shortcut icon" href="favicon.png" type="image/png" />
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/load.css" />
<script>
window.addEventListener("load", function(){
	var load_screen = document.getElementById("load_screen");
	document.body.removeChild(load_screen);
});
</script>

  </head>
                        <noscript>
                            <div class="alert alert-danger" role="alert">!عليك تفعيل الجافا سكربت آولا</div>
                        </noscript>

  <div id="load_screen">

<div id="wb_Image2" style="position:absolute;left:618px;top:303px;width:148px;height:63px;z-index:1;">
<img src="http://e.top4top.net/p_112w5nk1.gif" id="Image2" alt=""></div>

</div>


  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-asterisk"></i> <span><?php echo $servername; ?></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="<?php 
			  
			  if($client_info["client_flag_avatar"])
		{
			try{
				$download = $ts3_VirtualServer->transferInitDownload($client_info->getId(), 0, $client_info->avatarGetName());
				echo "avatar.php?ftdata=" . base64_encode(serialize($download)) ."";
			}catch (Exception $e) {	
				echo 'images/img.png';
			}
		}else{
			echo 'images/img.png';
		}
			  
			  ?>
" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo htmlspecialchars($client_info["client_nickname"]);?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
