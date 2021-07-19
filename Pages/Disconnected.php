<?php
require("inc/data.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $servername; ?>  | Disconnected </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	  <link rel="shortcut icon" href="favicon.png" type="image/png" />

  </head>

  <body>


        <!-- /top navigation -->

        <!-- page content --><center>
<h1 class="page-header">You are Not Connect in TS3 | انت غير متصل بتيم سبيك</h1>


            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-10">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><center>You are Not Connect in TS3 | انت غير متصل بتيم سبيك </center></h2><img src='images/error1.png'/>
					                     <hr><center>
										 <span class="input-group-btn">
										 <a href="ts3server://<?php echo $serverdomain; ?>" title=" # اضغط لدخول سيرفر التيم سبيك ">
                      <center><button class="btn btn-default" type="button">Join Ts3 | دخول السيرفر</button><center>
                   </a>
				   </span>
										                      <span class="input-group-btn"/>
															  <a href="/" title=" # اضغط للعودة الى اللوحة الذكية ">">
                    	  <center><button   class="btn btn-default" type="button">Back To the Panel | العودة الى اللوحة</button><center>
						  </a>
                    </span>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <strong>Copyright &copy; 2016-2017 <a > <?php echo $servername; ?></a>.</strong> All rights
    reserved. <b style='color:#D3D3D3'> <small>Developed By <?php echo $servername; ?> Team
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  </body>
</html>