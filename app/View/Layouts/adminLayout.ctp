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

            var lineChartData_c = {
            labels : ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15',
                       '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],

            // labels : ['1', '', '3', '', '5', '', '7', '', '9', '', '11', '', '13', '', '15',
            //          '', '17', '', '19', '', '21', '', '23', '', '25', '', '27', '', '29', '', '31'],

            datasets : [
                {
                    label: "今月",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",

                    data : <?php echo json_encode($amount_t_arr, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>
                },
                {
                    label: "先月",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",

                    data : <?php echo json_encode($amount_l_arr, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>
                },
            ]}

            // オプション
            var options_c = {
                // X, Y 軸ラインが棒グラフの値の上にかぶさるようにするか
                scaleOverlay : true,
                // 値の開始値などを自分で設定するか
                scaleOverride : true,

                // 以下の 3 オプションは scaleOverride: true の時に使用
                // Y 軸の値のステップ数
                // e.g. 10 なら Y 軸の値は 10 個表示される
                scaleSteps : <?=$scaleSteps_c; ?>,
                // Y 軸の値のステップする大きさ
                // e.g. 10 なら 0, 10, 20, 30 のように増えていく
                scaleStepWidth : <?=$scaleStepWidth_c; ?>,
                // Y 軸の値の始まりの値
                scaleStartValue : <?=$scaleStartValue_c; ?>,
                // X, Y 軸ラインの色
                scaleLineColor : "rgba(0, 0, 0, .1)",
                // X, Y 軸ラインの幅
                scaleLineWidth : 1,
                // ラベルの表示 ( Y 軸の値 )
                scaleShowLabels : true,
                // ラベルの表示フォーマット ( Y 軸の値 )
                // X, Y 軸値のフォント
                scaleFontFamily : "'Arial'",
                // X, Y 軸値のフォントサイズ
                scaleFontSize : 15,
                // X, Y 軸値のフォントスタイル, normal, italic など
                scaleFontStyle : "italic",
                // X, Y 軸値の文字色
                scaleFontColor : "#666",
                // グリッドライン ( Y 軸の横ライン ) の表示
                scaleShowGridLines : true,
                // グリッドラインの色
                scaleGridLineColor : "rgba(0, 0, 0, .05)",
                // グリッドラインの幅
                scaleGridLineWidth : 1,
                // ラインが曲線 ( true ) か直線 ( false )か
                bezierCurve : true,
                // ポイントの点を表示するか
                pointDot : true,
                // ポイントの点の大きさ
                pointDotRadius : 5,
                // ポイントの点の枠線の幅
                pointDotStrokeWidth : 1,
                // データセットのストロークを表示するか
                // みたいですが、ちょっと変化が分からなかったです
                datasetStroke : true,
                // ラインの幅
                datasetStrokeWidth : 1,
                // ラインの内側を塗りつぶすか
                datasetFill : true,
                // 表示の時のアニメーション
                animation : true,
                // アニメーションの速度 ( ステップ数 )
                animationSteps : 60,
                // アニメーションの種類, 以下が用意されている
                // linear, easeInQuad, easeOutQuad, easeInOutQuad, easeInCubic, easeOutCubic,
                // easeInOutCubic, easeInQuart, easeOutQuart, easeInOutQuart, easeInQuint,
                // easeOutQuint, easeInOutQuint, easeInSine, easeOutSine, easeInOutSine,
                // easeInExpo, easeOutExpo, easeInOutExpo, easeInCirc, easeOutCirc, easeInOutCirc,
                // easeInElastic, easeOutElastic, easeInOutElastic, easeInBack, easeOutBack,
                // easeInOutBack, easeInBounce, easeOutBounce, easeInOutBounce
                animationEasing : "easeOutQuad",
                // アニメーション終了後に実行する処理
                // animation: false の時にも実行されるようです
                // e.g. onAnimationComplete : function() {alert('complete');}
                onAnimationComplete : null,
                responsive:true,
            }

            var lineChartData_t = {
            labels : ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15',
                       '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],

            // labels : ['1', '', '3', '', '5', '', '7', '', '9', '', '11', '', '13', '', '15',
            //          '', '17', '', '19', '', '21', '', '23', '', '25', '', '27', '', '29', '', '31'],

            datasets : [
                {
                    label: "今月",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",

                    data : <?php echo json_encode($transaction_t_arr, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>
                },
                {
                    label: "先月",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",

                    data : <?php echo json_encode($transaction_l_arr, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>
                },
            ]}

            // オプション
            var options_t = {
                // X, Y 軸ラインが棒グラフの値の上にかぶさるようにするか
                scaleOverlay : true,
                // 値の開始値などを自分で設定するか
                scaleOverride : true,

                // 以下の 3 オプションは scaleOverride: true の時に使用
                // Y 軸の値のステップ数
                // e.g. 10 なら Y 軸の値は 10 個表示される
                scaleSteps : <?=$scaleSteps_t; ?>,
                // Y 軸の値のステップする大きさ
                // e.g. 10 なら 0, 10, 20, 30 のように増えていく
                scaleStepWidth : <?=$scaleStepWidth_t; ?>,
                // Y 軸の値の始まりの値
                scaleStartValue : <?=$scaleStartValue_t; ?>,
                // X, Y 軸ラインの色
                scaleLineColor : "rgba(0, 0, 0, .1)",
                // X, Y 軸ラインの幅
                scaleLineWidth : 1,
                // ラベルの表示 ( Y 軸の値 )
                scaleShowLabels : true,
                // ラベルの表示フォーマット ( Y 軸の値 )
                // X, Y 軸値のフォント
                scaleFontFamily : "'Arial'",
                // X, Y 軸値のフォントサイズ
                scaleFontSize : 15,
                // X, Y 軸値のフォントスタイル, normal, italic など
                scaleFontStyle : "italic",
                // X, Y 軸値の文字色
                scaleFontColor : "#666",
                // グリッドライン ( Y 軸の横ライン ) の表示
                scaleShowGridLines : true,
                // グリッドラインの色
                scaleGridLineColor : "rgba(0, 0, 0, .05)",
                // グリッドラインの幅
                scaleGridLineWidth : 1,
                // ラインが曲線 ( true ) か直線 ( false )か
                bezierCurve : true,
                // ポイントの点を表示するか
                pointDot : true,
                // ポイントの点の大きさ
                pointDotRadius : 5,
                // ポイントの点の枠線の幅
                pointDotStrokeWidth : 1,
                // データセットのストロークを表示するか
                // みたいですが、ちょっと変化が分からなかったです
                datasetStroke : true,
                // ラインの幅
                datasetStrokeWidth : 1,
                // ラインの内側を塗りつぶすか
                datasetFill : false,
                // 表示の時のアニメーション
                animation : true,
                // アニメーションの速度 ( ステップ数 )
                animationSteps : 60,
                // アニメーションの種類, 以下が用意されている
                // linear, easeInQuad, easeOutQuad, easeInOutQuad, easeInCubic, easeOutCubic,
                // easeInOutCubic, easeInQuart, easeOutQuart, easeInOutQuart, easeInQuint,
                // easeOutQuint, easeInOutQuint, easeInSine, easeOutSine, easeInOutSine,
                // easeInExpo, easeOutExpo, easeInOutExpo, easeInCirc, easeOutCirc, easeInOutCirc,
                // easeInElastic, easeOutElastic, easeInOutElastic, easeInBack, easeOutBack,
                // easeInOutBack, easeInBounce, easeOutBounce, easeInOutBounce
                animationEasing : "easeOutQuad",
                // アニメーション終了後に実行する処理
                // animation: false の時にも実行されるようです
                // e.g. onAnimationComplete : function() {alert('complete');}
                onAnimationComplete : null,
                responsive:true,
            }

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
