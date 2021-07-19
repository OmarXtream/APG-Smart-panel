<?php
require('inc/phphead.php');
require('inc/head.php');
require('inc/sidebar.php');

?>

        <!-- page content -->

		        <div class="right_col" role="main">
            <div class="clearfix"></div>

            <div class="row">

                <div class="row" id="home-content">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                              <center><h2><strong>  قائمة الكلانات</h2></strong></center><hr>
                            </header>
<?php
  $pdo = new PDO('mysql:host='.$host.';dbname='.$db1.';charset=utf8', ''.$user.'', ''.$pass.'');

if (isset($_POST['join']))
{
	if(!isset($_SESSION['spam']))
    $_SESSION['spam'] = microtime(true);
	
	if($_SESSION['spam'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! يرجى الانتظار بين محاولاتك‬‎ </strong></center> 
                                </div>
';

}else{
	$_SESSION['spam'] = microtime(true)+5.0;

$clid = $_POST['clid'];
$response = $pdo->prepare('SELECT *
FROM clans WHERE owdb = :db
           ');
$response->bindValue(':db', "$dbid", PDO::PARAM_INT);
$response->execute();
$response->CloseCursor();
if($response->rowCount() > 0 )
{
echo'
                                <div class="alert alert-warning alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                      <center>          <strong> انت تملك كلان بالفعل !   </strong>
</center>
                                </div>
';
}else{

$response = $pdo->prepare('SELECT *
FROM clans 
           ');
$response->execute();
$tops = $response->fetchAll();
$response->CloseCursor();

if($response->rowCount() > 0 )
{
    foreach($tops as $top) 
    {
        $group = $top['sgroup'];
if(in_array($client_db,$top['owdb'])){
}else{
if(in_array($group,$ggids)){
$ts3->serverGroupClientDel($group, $client_db);

}
if($group == $clid and !in_array($group,$ggids)){
        $id = (int)$top['id'];
        $name = htmlspecialchars($top['clanname']);
        $smallname = htmlspecialchars($top['smallname']);
        $ownercdb = (int)$top['owdb'];
        $stat = $top['status'];
        $tari5 = htmlspecialchars($top['creation_date']);
if($stat == 1){
$ts3->serverGroupClientAdd($group, $client_db);

$addname = $ts3->serverGroupGetById($group);
echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                      <center>          <strong>لقد قمت بالإنضمام إلى   <br> <img src="icon.php?id='. $group . '"> '.$addname.'</strong>
</center>
                                </div>
<meta http-equiv="refresh" content="2">

';
}
}
}
}
}
}
}
}

if (isset($_POST['out']))
{
	if(!isset($_SESSION['spam']))
    $_SESSION['spam'] = microtime(true);
	
	if($_SESSION['spam'] >= microtime(true)){
	echo'
                                <div class="alert alert-info alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                             <center>          <strong>عذراً! يرجى الانتظار بين محاولاتك‬‎ </strong></center> 
                                </div>
';

}else{
	$_SESSION['spam'] = microtime(true)+5.0;

$clid = $_POST['clid'];
$response = $pdo->prepare('SELECT *
FROM clans WHERE owdb = :db
           ');
$response->bindValue(':db', "$dbid", PDO::PARAM_INT);
$response->execute();
$response->CloseCursor();
if($response->rowCount() > 0 )
{
echo'
                                <div class="alert alert-warning alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                      <center>          <strong> انت تملك كلان بالفعل !   </strong>
</center>
                                </div>
';
}else{

$response = $pdo->prepare('SELECT *
FROM clans 
           ');
$response->execute();
$tops = $response->fetchAll();
$response->CloseCursor();

if($response->rowCount() > 0 )
{
    foreach($tops as $top) 
    {
        $group = $top['sgroup'];
        $ownercdb = (int)$top['owdb'];

if($group == $clid and in_array($group,$ggids) and !in_array($client_db,$ownercdb)){
        $id = (int)$top['id'];
        $name = htmlspecialchars($top['clanname']);
        $smallname = htmlspecialchars($top['smallname']);
        $stat = $top['status'];
        $tari5 = htmlspecialchars($top['creation_date']);
if($stat == 1){
$ts3->serverGroupClientDel($group, $client_db);

$addname = $ts3->serverGroupGetById($group);
echo'
                                <div class="alert alert-success alert-outline alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                      <center>          <strong>لقد قمت بالخروج من   <br> <img src="icon.php?id='. $group . '"> '.$addname.'</strong>
</center>
                                </div>
<meta http-equiv="refresh" content="2">

';
}
}
}
}
}
}
}
?>
                            <table class="table table-striped table-advance table-hover">
                                <thead> 
                                    <tr>
                                        <th><i class="fa fa-bullhorn"></i> اسم الكلان</th>
                                        <th class="hidden-phone"><i class="fa fa-group"></i> عدد الأعضاء</th>
                                        <th><i class="fa fa-bookmark"></i> الحالة</th>

                                    </tr>
                                </thead>
                                <tbody>
<?php


$response = $pdo->prepare('SELECT *
FROM clans 
           ');
$response->execute();
$tops = $response->fetchAll();
$response->CloseCursor();

if($response->rowCount() > 0 )
{
$mrkz = 0;
    foreach($tops as $top) 
    {
$mrkz++;
        $id = (int)$top['id'];
        $name = htmlspecialchars($top['clanname']);
        $smallname = htmlspecialchars($top['smallname']);
        $ownercdb = (int)$top['owdb'];
        $group = $top['sgroup'];
        $stat = $top['status'];
        $tari5 = htmlspecialchars($top['creation_date']);
$icon = $ts3_VirtualServer->serverGroupGetById($group)->iconDownload();
if (!empty($icon)){
$sicon = '<img src="icon.php?id='. $group . '">';
}

echo'

                                    <tr>
                                        <td class="hidden-phone">'.$sicon.'<strong>'.$name.'</strong></td>
                                        <td><span class="label label-info label-mini">'.CountClientsGroup($group).'</span>  </td>';
if($stat == 1){
echo'
<td><strong><span class="label label-success label-mini">مفتوح</span>
</strong></td>  <td>

<form method="post">
                             <input type="hidden" name="clid" value="'.$group.'">';
if(!in_array($group,$ggids)){
echo'
<button type="submit" name="join" class="btn btn-success btn-xs" title="الإنضمام إلى الكلان"><i class="fa fa-sign-in"></i></button></form>
</td>';
}else{
echo'
<button type="submit" name="out" class="btn btn-danger btn-xs" title="الخروج من الكلان"><i class="fa fa-sign-out"></i></button></form>

</td>
';
}

}elseif($stat == 2){
echo '<span class="label label-info label-mini">بدعوة فقط</span>';
}elseif($stat == 3){
echo'<span class="label label-danger label-mini">مغلق</span>';

}

                                  echo'</tr>';



echo'<br>';
    }
}
else
{
    echo '<h2 class="errors"> لا يوجد اي كلان حاليا  </h2><hr>';
}

?>
                                </tbody>
                            </table>
                    </div>


</div>
                </div>
              </div>
        <!-- /page content -->

<?php
require('inc/footer.php');
?>
