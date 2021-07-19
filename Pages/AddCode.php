<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

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
          <H3> Admins Controller</H3><small>Add Code</small>

		<!-- /top tiles -->	
		
		<div class="row" >
		<center><br>
<div class="row">

<?php
  $pdo = new PDO('mysql:host='.$host.';dbname='.$db1.';charset=utf8', ''.$user.'', ''.$pass.'');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST["submit"]) && isset($_POST["day"]) &&  isset($_POST["code"])&& isset($_POST["sgid"])){
	
	$day = (int)$_POST["day"];
        $code = secure($_POST['code']);
$sgid = $_POST["sgid"];
    $response = $pdo->prepare('SELECT * FROM cods');
    $response->execute();
    $cods = $response->fetchAll();
    $response->CloseCursor();
		
    foreach($cods as $cod) {

        if ($cod['code'] == $code) {
echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                      <center>          <strong>يوجد كود مطابق بالفعل !    <br>'.htmlspecialchars($code).'  </strong>
</center>
                                </div>
';
echo'<meta http-equiv="refresh" content="2; url=AddCode.php" />';
die;

}
}
if(isset($sgid)){
if($sgid == 'VIP'){
$sg = $VIP;
}
if($sgid == 'VIP Gift'){
$sg = $FreeVip;
}
if($sgid == 'Gold MemberShip'){
$sg = $GMemberShip;
}
if($sgid == 'Silver MemberShip'){
$sg = $SMemberShip;
}
if($sgid == 'Bronze MemberShip'){
$sg = $BMemberShip;
}
}
$startDate = time();
$endtime = date('Y-m-d H:i:s', strtotime('+'.$day.' day', $startDate));
//date('Y-m-d H:i:s');
try 
{

        $stmt= $pdo->prepare('INSERT INTO cods ( code, endtime, sgid, creation_date, dbid, admin) 
                             VALUES (:cd, :et, :sg, NOW(), :db, :ad)
                           ');
        $stmt->bindValue(':cd',"$code",PDO::PARAM_STR);
        $stmt->bindValue(':et',"$endtime",PDO::PARAM_STR);
        $stmt->bindValue(':sg', "$sg", PDO::PARAM_INT);
        $stmt->bindValue(':db', "0", PDO::PARAM_INT);
        $stmt->bindValue(':ad', "$dbid", PDO::PARAM_INT);


        $stmt->execute();        
        $stmt->CloseCursor();
} 
catch(PDOException $e)
{
  die('خطأ:'. $e->getMessage());
}

echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                      <center>          <strong>تم إنشاء الكود بنجاح !   <br>'.htmlspecialchars($code).'  </strong>
</center>
                                </div>
';

echo '<script language="javascript">';
echo "toastr.success('تم إنشاء الكود بنجاح !');";
echo '</script>';

}
?>
                <section class="panel">
                    <header class="panel-heading">
                      <center> <h2> إضافة كود جديد</h2>
                    </header>
                    <div class="panel-body"> 
                        <div class="row">
<hr>
<center>
     <form method="post">
<lebal> <strong>الرتبة </lebal>
<select name='sgid' class='form-control' >
<option name='VIP' value='VIP'>VIP</option>
<option name='VIP Gift' value='VIP Gift'>VIP Gift</option>
<option name='Gold MemberShip' value='Gold MemberShip'>Gold MemberShip</option>
<option name='Silver MemberShip' value='Silver MemberShip'>Silver MemberShip</option>
<option name='Bronze MemberShip' value='Bronze MemberShip'>Bronze MemberShip</option>

</select><br/>
<lebal><strong> الكود </lebal>

                                            <center><input type="text" class="form-control" placeholder="code" name="code"><br>
<lebal><strong> وقت إنتهاء الكود </lebal>

                                            <center><input type="number" class="form-control" placeholder="days" name="day"><br>



                                       
                            <center><button type="submit" name="submit" class="btn btn-primary start"><i class="glyphicon glyphicon-floppy-open"></i> إنشاء الكود</button>

                                <br><br>
<br>
<strong><span class="label label-warning">تنويه :</span> يتم إحتساب وقت الإنتهاء مباشرة بعد إنشاء الكود 
<br>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
<h2>قائمة الاكواد </h2>

                                        <th>الإنتهاء</th>
                                        <th>الإنشاء</th>
                                        <th>المنشىء</th>
                                        <th>المستخدم</th>
                                        <th>الحالة</th>
                                        <th>الكود</th>

                                    </tr>
                                </thead>

                                <tbody>


<?php
    $response = $pdo->prepare('SELECT * FROM cods');
    $response->execute();
    $codss = $response->fetchAll();
    $response->CloseCursor();
$Now = date('Y-m-d H:i:s');
foreach($codss as $cod){
$thecode = $cod['code'];
$user = $cod['dbid'];
$admin = $cod['admin'];
$end = $cod['endtime'];
$firstdate = $cod['creation_date'];
$adminname = $ts3_VirtualServer->clientGetNameByDbid("$admin");
echo'<tr>';
echo '<td><strong>'.$end.'</strong></td>';
echo '<td><strong>'.$firstdate.'</strong></td>';
echo '<td><strong>'.$adminname['name'].'</strong></td>';

if($user == '0'){

echo '<td><strong>لا يوجد</strong></td>';
}else{
$username = $ts3_VirtualServer->clientGetNameByDbid("$user");
echo '<td><strong>'.$username['name'].'</strong></td>';
}

if($Now >= $end){

echo '<td><span class="label label-info label-mini">إنتهى</span></td>';
}elseif($Now < $end and $user != '0'){
echo '<td><span class="label label-success label-mini">مفعل</span></td>';

}else{

echo '<td><span class="label label-danger label-mini">غير مفعل</span></td>';
}
echo '<td><strong>'.$thecode.'</strong></td>';

echo'</tr>';
echo'<br>';

}

?>
</table>
                                </tbody>
</center>


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
