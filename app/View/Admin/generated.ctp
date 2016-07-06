    <div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
      <div class="container">
        <!-- Menu button for smallar screens -->
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="index.html" class="navbar-brand">ELIETS</a>
        </div>
        <!-- Site name for smallar screens -->
        <!-- Navigation starts -->
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
          <!-- Links -->
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img src="img/user.jpg" alt="" class="nav-user-pic img-responsive" /> Admin <b class="caret"></b>
              </a>
              <!-- Dropdown menu -->
              <ul class="dropdown-menu">
              <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
              <li><a href="#"><i class="fa fa-cogs"></i> Settings</a></li>
              <li><a href="login.html"><i class="fa fa-power-off"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
          <!-- Notifications -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Comment button with number of latest comments count -->
            <li class="dropdown dropdown-big">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="fa fa-comments"></i> Chats <span   class="badge badge-info">6</span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <!-- Heading - h5 -->
                  <h5><i class="fa fa-comments"></i> Chats</h5>
                  <!-- Use hr tag to add border -->
                  <hr />
                </li>
                <li>
                  <!-- List item heading h6 -->
                  <a href="#">Hi :)</a> <span class="label label-warning pull-right">10:42</span>
                  <div class="clearfix"></div>
                  <hr />
                </li>
                <li>
                  <a href="#">How are you?</a> <span class="label label-warning pull-right">20:42</span>
                  <div class="clearfix"></div>
                  <hr />
                </li>
                <li>
                  <a href="#">What are you doing?</a> <span class="label label-warning pull-right">14:42</span>
                  <div class="clearfix"></div>
                  <hr />
                </li>
                <li>
                  <div class="drop-foot">
                    <a href="#">View All</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Message button with number of latest messages count-->
            <li class="dropdown dropdown-big">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="fa fa-envelope-o"></i> Inbox <span class="badge badge-important">6</span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <!-- Heading - h5 -->
                  <h5><i class="fa fa-envelope-o"></i> Messages</h5>
                  <!-- Use hr tag to add border -->
                  <hr />
                </li>
                <li>
                  <!-- List item heading h6 -->
                  <a href="#">Hello how are you?</a>
                  <!-- List item para -->
                  <p>Quisque eu consectetur erat eget  semper...</p>
                  <hr />
                </li>
                <li>
                  <a href="#">Today is wonderful?</a>
                  <p>Quisque eu consectetur erat eget  semper...</p>
                  <hr />
                </li>
                <li>
                  <div class="drop-foot">
                    <a href="#">View All</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Members button with number of latest members count -->
            <li class="dropdown dropdown-big">
              <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                <i class="fa fa-user"></i> Users <span   class="badge badge-success">6</span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <!-- Heading - h5 -->
                  <h5><i class="fa fa-user"></i> Users</h5>
                  <!-- Use hr tag to add border -->
                  <hr />
                </li>
                <li>
                  <!-- List item heading h6-->
                  <a href="#">Ravi Kumar</a> <span class="label label-warning pull-right">Free</span>
                  <div class="clearfix"></div>
                  <hr />
                </li>
                <li>
                  <a href="#">Balaji</a> <span class="label label-important pull-right">Premium</span>
                  <div class="clearfix"></div>
                  <hr />
                </li>
                <li>
                  <a href="#">Kumarasamy</a> <span class="label label-warning pull-right">Free</span>
                  <div class="clearfix"></div>
                  <hr />
                </li>
                <li>
                  <div class="drop-foot">
                    <a href="#">View All</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>

    <!-- Main content starts -->
    <div class="content">
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="sidebar-dropdown"><a href="#">Navigation</a></div>
        <div class="sidebar-inner">
          <!--- Sidebar navigation -->
          <!-- If the main navigation has sub navigation, then add the class "has_submenu" to "li" of main navigation. -->
          <ul class="navi">
            <!-- Use the class nred, ngreen, nblue, nlightblue, nviolet or norange to add background color. You need to use this in <li> tag. -->

            <li class="nred"><a href="index.html"><i class="fa fa-desktop"></i> Dashboard</a></li>
            <!-- Menu with sub menu -->
            <li class="has_submenu nlightblue">
              <a href="#">
                <!-- Menu name with icon -->
                <i class="fa fa-th"></i> Widgets
                <!-- Icon for dropdown -->
                <span class="pull-right"><i class="fa fa-angle-right"></i></span>
              </a>
              <ul>
                <li><a href="widgets1.html">Widgets #1</a></li>
                <li><a href="widgets2.html">Widgets #2</a></li>
              </ul>
            </li>
            <li class="ngreen"><a href="charts.html"><i class="fa fa-bar-chart-o"></i> Charts</a></li>
            <li class="norange"><a href="ui.html"><i class="fa fa-sitemap"></i> UI Elements</a></li>
            <li class="has_submenu nviolet">
              <a href="#">
                <i class="fa fa-file-o"></i> Pages #1
                <span class="pull-right"><i class="fa fa-angle-right"></i></span>
              </a>
              <ul>
                <li><a href="calendar.html">Calendar</a></li>
                <li><a href="post.html">Make Post</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="register.html">Register</a></li>
                <li><a href="statement.html">Statement</a></li>
                <li><a href="error-log.html">Error Log</a></li>
                <li><a href="support.html">Support</a></li>
              </ul>
            </li>
            <li class="has_submenu nblue">
              <a href="#">
                <i class="fa fa-file-o"></i> Pages #2
                <span class="pull-right"><i class="fa fa-angle-right"></i></span>
              </a>
              <ul>
                <li><a href="error.html">Error</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="grid.html">Grid</a></li>
                <li><a href="invoice.html">Invoice</a></li>
                <li><a href="media.html">Media</a></li>
                <li><a href="profile.html">Profile</a></li>
              </ul>
            </li>
            <li class="nred current"><a href="forms.html"><i class="fa fa-list"></i> Forms</a></li>
            <li class="nlightblue"><a href="tables.html"><i class="fa fa-table"></i> Tables</a></li>
          </ul>
          <!--/ Sidebar navigation -->

          <!-- Date -->
          <div class="sidebar-widget">
            <div id="todaydate"></div>
          </div>
        </div>
      </div>
      <!-- Sidebar ends -->

      <!-- Main bar -->
      <div class="mainbar">
        <!-- Page heading -->
        <div class="page-head">
          <!-- Page heading -->
          <h2 class="pull-left">発行完了</h2>

          <div class="clearfix"></div>
        </div><!--/ Page heading ends -->
        <!-- Matter -->
        <div class="matter">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <!-- Table starts.  -->
                <div class="widget worange">
                  <div class="widget-head">
                    <div class="pull-left">以下の内容で決済画面を発行し、お客様へ送信しました</div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget-content">
                    <div class="table-responsive">
                      <table class="table table-bordered table-generated">
                        <tr>
                          <td class="col-md-3">NOWALL担当者</td>
                          <td class="col-md-9"><?=$sendData['Admin']['nowall-name'];?></td>
                        </tr>
                        <tr>
                          <td class="col-md-3">お名前</td>
                          <td class="col-md-9"><?=$sendData['Admin']['name'];?></td>
                        </tr>

                        <tr>
                          <td class="col-md-3">メールアドレス</td>
                          <td class="col-md-9"><?=$sendData['Admin']['email'];?></td>
                        </tr>

                        <tr>
                          <td class="col-md-3">決済金額</td>
                          <td class="col-md-9"><?=number_format($sendData['Admin']['amount'])."円";?>
                              <?php if($sendData['Admin']['day']) echo "(毎月)";
                                    else echo "(今月1回)";?>
                          </td>
                        </tr>

                        <tr>
                          <td class="col-md-3">決済内容</td>
                          <td class="col-md-9"><?=$sendData['Admin']['summary'];?></td>
                        </tr>
                        <tr>
                          <td class="col-xs-3 col-sm-3 col-md-3">決済URL</td>
                          <td class="col-xs-9 col-sm-9 col-md-9"><?=$sendData['Admin']['url'];?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <p>※メールが届かない場合、アドレス間違いや受信拒否されている可能性が
                あります。その場合は上記URLをお客様へ別途お伝えください。</p>
              </div>
            </div>
          </div>
        </div><!--/ Matter ends -->
      </div><!--/ Mainbar ends -->
      <div class="clearfix"></div>
    </div><!--/ Content ends -->

