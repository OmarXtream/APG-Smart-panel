<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require('inc/phphead.php');
require('inc/head.php');
require('inc/sidebar.php');

?>

        <!-- page content -->
		        <div class="right_col" role="main">
          <H3>CodesSystem</H3><small>CodeAct</small>

		<!-- /top tiles -->	
		
		<div class="row" >
		<center><br>
<div class="row">

<?php
if(isset($_POST['submit']) && isset($_POST['code'])){
$code = $_POST['code'];
  $pdo = new PDO('mysql:host='.$host.';dbname='.$db1.';charset=utf8', ''.$user.'', ''.$pass.'');

    $response = $pdo->prepare('SELECT * FROM cods');
    $response->execute();
    $cods = $response->fetchAll();

    $response->CloseCursor();

$codeit = false;
    foreach($cods as $cod) {

if($cod['code'] == $code){
$codehis = $cod['code'];
$check = $cod['dbid'];
$prize = $cod['sgid'];
$TheEnd = $cod['endtime'];
$codeit = true;

}
if(isset($codehis)){
if($codehis == $code and $check == 0){
        $stmt = $pdo->prepare('UPDATE cods 
                SET dbid = :db
                WHERE code = :cd
                ');
        $stmt->bindValue(':cd', $code, PDO::PARAM_STR);
        $stmt->bindValue(':db', $client_db,  PDO::PARAM_INT);

        $stmt->execute();        

        $stmt->CloseCursor();
if(!in_array($prize,$ggids)){

$ts3->serverGroupClientAdd($prize, $client_db);
}
$rankname = $ts3->serverGroupGetById($prize);
echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                                 <center>     <strong>تم تفعيل الكود بنجاح ! لقد حصلت على :</strong> <br> <img src="icon.php?id='. $prize . '"> '.$rankname.'  <br>
                     <strong> تاريخ إنتهاء صلاحية الكود :<br> '.$TheEnd.' </strong>

                                </div>
</center>
';
echo '<script language="javascript">';
echo "toastr.success('تم تفعيل الكود بنجاح !');";
echo '</script>';

			break;

}else{
if($codehis == $code and $check != 0){
echo '<script language="javascript">';
echo "toastr.info('تم إستخدام هذا الكود من قبل !');";
echo '</script>';
			break;

}
}
}
}
	if($codeit !== true){

echo '<script language="javascript">';
echo "toastr.error('كود خاطىء !');";
echo '</script>';
}
}
?>
                <section class="panel">
                    <header class="panel-heading">
                      <center> <h2> ماهو الكود ؟ ومافائدته ؟ وكيف يتم الحصول عليه ؟</h2>
                    </header>
                    <div class="panel-body"> 
                        <div class="row">
                               <center> <p>الكود يا صاحبي ب كل اختصار هو عباره عن شفره او رمز يتم الحصول عليها في المسابقات والفعاليات <br>
                                     </p>ولكل كود جائزة قيمه يتم تحديدها او تكون مجهوله ^_^.<br>
<hr>
<center>
     <form method="post">
                                            <center><input type="text" class="form-control" placeholder="الكود" name="code"><br>


                                       
                            <center><button type="submit" name="submit" class="btn btn-primary start"><i class="glyphicon glyphicon-ok"></i> تفعيل الكود</button>

                                <br></center>


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
