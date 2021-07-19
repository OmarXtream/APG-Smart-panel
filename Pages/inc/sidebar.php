            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>لوحة التيم سبيك الذكية</h3>
                <ul class="nav side-menu">
                  <li><a href='index'><i class="fa fa-home"></i> Home | الرئيسية</a></li>
                  <li><a><i class="fa fa-user"></i> Settings | الإعدادات <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
		<li><a href="GamesBot"><i class="fa fa-gamepad"></i>GamesBot | بوت الألعاب</a></li>
		<li><a href="features"><i class="fa fa-lock"></i>Addons | بوت الخصائص</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Rooms Settings | الغرف <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
        <li><a href="Room"><i class="fa fa-shield"></i> Permanent Room | روم دائم</a></li>
         <li><a href="RoomControl"><i class="fa fa-edit"></i>Control Panel | لوحة التحكم </a>
                    </ul>
                  </li>
               
                  
                  <li><a href="Top"><i class="fa fa-pie-chart"></i> Top | التوب </a>
                  <li><a href="CodeAct"><i class="fa fa-bullseye"></i> Code Redeam | تفعيل الاكواد </a>

                  </li>
               
                  <li><a><i class="fa fa-users"></i>Clans System <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
        <li><a href="Clans"><i class="fa fa-list"></i> قائمة الكلانات</a></li>
         <li><a href="ClanControl"><i class="fa fa-edit"></i>التحكم بالكلان </a>
                    </ul>
                  </li>
                 <li><a id='error'><i class="fa fa-user-plus"></i> V.I.P <span class="label label-success pull-right">Coming Soon</span></a></li> 


<?php 
if(array_intersect($codsmanager,$ggids)){
echo'
                  <li><a><i class="fa fa-cogs"></i>Admins Controller <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
        <li><a href="AddCode"><i class="fa fa-cog"></i> Code generator</a></li>
        <li><a href="Search"><i class="fa fa-cog"></i> Search information</a></li>
        <li><a href="A-broadcast"><i class="fa fa-cog"></i> BroadCast</a></li>';
}
if(array_intersect($clanmanager,$ggids)){
echo'
        <li><a href="ClanCreate"><i class="fa fa-cog"></i> Clans Create</a></li>
';



echo'
                    </ul>
                  </li>';
}
?>

				 </ul>

              </div>

            </div>
            <!-- /sidebar menu -->
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="">
                <span class="glyphicon glyphicon-certificate" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="">
                <span class="glyphicon glyphicon-certificate" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="">
                <span class="glyphicon glyphicon glyphicon-certificate" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="">
                <span class="glyphicon glyphicon-certificate" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/Special.jpg" alt=""> <?php echo $servername; ?>
                    
                  </a>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge bg-green">2</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/Special.jpg" alt="Profile Image" /></span>
                        <span>
                          <span><?php echo $servername; ?></span>
                          <span class="time">#Mr.omar</span>
                        </span>
                        <span class="message">
                                  اللوحة تحت التطوير والبرمجة
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/Special.jpg" alt="Profile Image" /></span>
                        <span>
                          <span><?php echo $servername; ?></span>
                          <span class="time">#Mr.omar</span>
                        </span>
                        <span class="message">
                          تم إفتتاح اللوحة بنجاح 
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>هنا تجد جميع الإشعارات والأخبار</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
					  </div>
					 
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
  <script type="text/javascript">

  $(document).ready(function() {
    $('#error').click(function() {
       toastr.warning('لا يوجد لديك صلاحيات ل دخول هذه الصفحه');
    });
  });
</script>

        <!-- /top navigation -->
