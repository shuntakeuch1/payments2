<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0">

    <title>
        <?=$title_for_layout; ?>
    </title>

    <link rel="shortcut icon" href="http://elite.sc/assets_front/images/favicon.ico">


    <!-- グラフ表示用 -->
    <?php if(($this->name == 'Adminpayments') && ($this->action == 'dashboard')): ?>
        <?=$this->Html->scriptStart(array('inline'=>false)); ?>

        var amount_t_arr = <?php echo json_encode($amount_t_arr, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
        var amount_l_arr = <?php echo json_encode($amount_l_arr, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

        var scaleSteps_c = <?=$scaleSteps_c; ?>;
        var scaleStepWidth_c = <?=$scaleStepWidth_c; ?>;
        var scaleStartValue_c = <?=$scaleStartValue_c; ?>;
        var scaleLabel_c = "<%=new Intl.NumberFormat().format(value) %> 円";


        var transaction_t_arr = <?php echo json_encode($transaction_t_arr, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
        var transaction_l_arr = <?php echo json_encode($transaction_l_arr, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

        var scaleSteps_t = <?=$scaleSteps_t; ?>;
        var scaleStepWidth_t = <?=$scaleStepWidth_t; ?>;
        var scaleStartValue_t = <?=$scaleStartValue_t; ?>;
        var scaleLabel_t = "<%=new Intl.NumberFormat().format(value) %>";

        <?=$this->Html->scriptEnd(); ?>
    <?php endif; ?>


    <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('../theme/css/bootstrap.min');
        echo $this->Html->css('../theme/css/jquery-ui');
        echo $this->Html->css('../theme/css/jquery.gritter');
        echo $this->Html->css('../theme/css/font-awesome.min');
        // echo $this->Html->css('../theme/css/style');
        echo $this->Html->css('../theme/css/widgets');

        echo $this->Html->css('Adminstyle');
        echo $this->Html->css('Admin');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
    ?>

</head>
<body>
    <div id="container">
        <div id="header">

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
                    <a class="navbar-brand"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> ELITES PAYMENTS</a>
                </div>
                <!-- Site name for smallar screens -->
                <!-- Navigation starts -->
                <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                    <!-- Notifications -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Members button with number of latest members count -->
                        <li>
                            <a>
                                <i class="fa fa-user"></i> <?=$currentUser['name'];?>
                            </a>
                        </li>

                        <!-- Use the class nred, ngreen, nblue, nlightblue, nviolet or norange to add background color. You need to use this in <li> tag. -->
                        <li class="has_submenu nlightblue open" id="slidemenu">
                            <a href="#">
                                <!-- Menu name with icon -->
                                <i class="fa fa-credit-card"></i> 課金関連メニュー
                                <!-- Icon for dropdown -->
                                <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                            </a>
                            <ul class="button-dropdown-menu" style="display: block">
                                <li><?=$this->Html->link('ダッシュボード',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'dashboard'));?>
                                </li>
                                <li><?=$this->Html->link('課金の履歴',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'charges'));?>
                                </li>
                                <li><?=$this->Html->link('顧客の一覧',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'customers'));?>
                                </li>
                                <li><?=$this->Html->link('定期課金の一覧',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'recursion'));?>
                                </li>
                                <li><?=$this->Html->link('イベントログ',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'events'));?>
                                </li>

                            </ul>
                        </li>

                        <li class="has_submenu norange open" id="slidemenu">
                            <a href="#">
                                <!-- Menu name with icon -->
                                <i class="fa fa-users"></i> 管理者メニュー
                                <!-- Icon for dropdown -->
                                <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                            </a>
                            <ul class="button-dropdown-menu" style="display: block">
                                <li><?=$this->Html->link('個別決済画面発行',
                                                        array('controller'=>'admin',
                                                        'action'=>'generate'));?>
                                </li>
                                <li><?=$this->Html->link('ユーザー管理',
                                                        array('controller'=>'adminusers',
                                                        'action'=>'#'));?>
                                </li>
                                <li><?=$this->Html->link('商材管理',
                                                        array('controller'=>'items',
                                                        'action'=>'index'));?>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-download"></i> 入金情報
                            </a>
                        </li>

                        <li>
                            <a href="/payments/adminusers/logout">
                                <i class="fa fa-sign-out"></i> ログアウト
                            </a>
                        </li>
                    </ul>
                </nav>
              </div>
            </div>

        </div>
        <div id="content">

    <!-- Main content starts -->
    <div class="content">
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- <div class="sidebar-dropdown"><a href="#">Navigation</a></div> -->
        <div class="sidebar-inner">
          <!--- Sidebar navigation -->
          <!-- If the main navigation has sub navigation, then add the class "has_submenu" to "li" of main navigation. -->
          <ul class="navi">
            <!-- Use the class nred, ngreen, nblue, nlightblue, nviolet or norange to add background color. You need to use this in <li> tag. -->
            <li class="has_submenu nlightblue sidemargin open">
                <a href="#">
                    <!-- Menu name with icon -->
                    <i class="fa fa-credit-card"></i> 課金関連メニュー
                    <!-- Icon for dropdown -->
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <ul style="display: block">
                    <li><?=$this->Html->link('ダッシュボード',
                                            array('controller'=>'adminpayments',
                                            'action'=>'dashboard'));?>
                    </li>
                    <li><?=$this->Html->link('課金の履歴',
                                            array('controller'=>'adminpayments',
                                            'action'=>'charges'));?>
                    </li>
                    <li><?=$this->Html->link('顧客の一覧',
                                            array('controller'=>'adminpayments',
                                            'action'=>'customers'));?>
                    </li>
                    <li><?=$this->Html->link('定期課金の一覧',
                                            array('controller'=>'adminpayments',
                                            'action'=>'recursion'));?>
                    </li>
                    <li><?=$this->Html->link('イベントログ',
                                            array('controller'=>'adminpayments',
                                            'action'=>'events'));?>
                    </li>
                </ul>
            </li>

            <li class="has_submenu norange open">
                <a href="#">
                    <!-- Menu name with icon -->
                    <i class="fa fa-users"></i> 管理者メニュー
                    <!-- Icon for dropdown -->
                    <span class="pull-right"><i class="fa fa-angle-right"></i></span>
                </a>
                <ul style="display: block">
                    <li><?=$this->Html->link('個別決済画面発行',
                                            array('controller'=>'admin',
                                            'action'=>'generate'));?>
                    </li>
                    <li><?=$this->Html->link('ユーザー管理',
                                            array('controller'=>'adminusers',
                                            'action'=>'index'));?>
                    </li>
                    <li><?=$this->Html->link('商材管理',
                                            array('controller'=>'items',
                                            'action'=>'index'));?>
                    </li>
                </ul>
            </li>
          </ul>
          <!--/ Sidebar navigation -->


        </div>
      </div>
      <!-- Sidebar ends -->

            <?php echo $this->Flash->render(); ?>

            <?php echo $this->fetch('content'); ?>


      <div class="clearfix"></div>
    </div><!--/ Content ends -->


        </div>
        <div id="footer">


        </div>
    </div>

        <!-- Javascript files -->
        <!-- jQuery -->
        <?php echo $this->Html->script('../theme/js/jquery'); ?>
        <?php echo $this->Html->script('../theme/js/bootstrap.min');?>
        <?php echo $this->Html->script('../theme/js/jquery-ui.min');?>
        <?php echo $this->Html->script('../theme/js/jquery.gritter.min');?>
        <?php echo $this->Html->script('../theme/js/respond.min');?>
        <?php echo $this->Html->script('../theme/js/html5shiv');?>
        <?php echo $this->Html->script('admincustom');?>
        <?php echo $this->Html->script('Chart.min');?>
        <?php echo $this->Html->script('Chart.option');?>
</body>
</html>
