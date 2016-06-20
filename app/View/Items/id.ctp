<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- Title here -->
    <title>一般決済画面</title>
    <!-- Description, Keywords and Author -->
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your,Keywords">
    <meta name="author" content="ResponsiveWebInc">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <!-- Bootstrap CSS -->
    <!-- <link href="theme/css/bootstrap.min.css" rel="stylesheet"> -->
    <?php echo $this->Html->css('css/bootstrap.min')?>
    <!-- jQuery UI -->
    <!-- <link rel="stylesheet" href="theme/css/jquery-ui.css"> -->
    <?php echo $this->Html->css('css/jquery-ui.css')?>
    <!-- jQuery Gritter -->
    <!-- <link rel="stylesheet" href="theme/css/jquery.gritter.css"> -->
    <?php echo $this->Html->css('css/jquery.gritter.css')?>
    <!-- Font awesome CSS -->
    <!-- <link href="theme/css/font-awesome.min.css" rel="stylesheet"> -->
    <?php echo $this->Html->css('css/font-awesome.min.css')?>
    <!-- Custom CSS -->
    <?php echo $this->Html->css('css/style.css')?>
    <!-- <link href="theme/css/style.css" rel="stylesheet"> -->
    <!-- Widgets stylesheet -->
    <?php echo $this->Html->css('css/widgets.css')?>
    <?php echo $this->Html->css('css/mainbar-margin-left0.css')?>
    <!-- <link href="theme/css/widgets.css" rel="stylesheet"> -->

    <!-- Favicon -->
    <link rel="shortcut icon" href="#">
  </head>

  <body>

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
          <a href="index.html" class="navbar-brand"> <span class="bold">ELITES</span></a>
        </div>
      </div>
    </div>

    <!-- Main content starts -->
    <div class="content">
      <!-- Sidebar -->

      <!-- Sidebar ends -->

      <!-- Main bar -->
      <div class="mainbar">
        <!-- Page heading -->
        <div class="page-head">
          <!-- Page heading -->
          <h2 class="pull-left">一般決済画面
            <!-- page meta -->

          </h2>
          <!-- Breadcrumb -->

          <div class="clearfix"></div>
          </div>

          <div class="container">
            <div class="col-sm-12">
            <!-- <div style="width:800px; margin:0 auto;"> -->
            <table style="width:100%;">
            <tr>
            <?=$this->Form->create("Item")?>
            <td style ="width:30%; border:solid 1px #808080;">NOWALL担当者</td>
            <td style ="width:70%; border:solid 1px #808080;"><?=$this->Form->text('Item')?></td>
            </tr>

            <tr>
            <td style ="width:30%; border:solid 1px #808080;">お名前</td>
            <td style ="width:70%; border:solid 1px #808080;"><?=$this->Form->text('Item')?></td>
            </tr>

            <tr>
            <td style ="width:30%; border:solid 1px #808080;">メールアドレス</td>
            <td style ="width:70%; border:solid 1px #808080;"><?=$this->Form->text('Item')?></td>
            </tr>

            <tr>
            <td style ="width:30%; border:solid 1px #808080;">決済金額</td>
            <td style ="width:70%; border:solid 1px #808080;"><?=$items['Item']['amount'] ?>円</td>
            </tr>

            <tr>
            <td style ="width:30%; border:solid 1px #808080;">決済内容</td>
            <td style ="width:70%; border:solid 1px #808080;"><?=$items['Item']['description'] ?></td>
            </tr>

            <tr>
            <td style ="width:30%; border:solid 1px #808080;">カード情報</td>
            <td style ="width:70%; border:solid 1px #808080;"></td>
            </tr>

            </table>
            </div>

            <div style="text-align:center;">
              <?=$this->Form->checkbox('')?>上記の内容を確認した上で支払いを行います。
              <?=$this->Form->end('決済する')?>
            </div>
          </div>

    <!-- Scroll to top -->

    <!-- Javascript files -->
    <!-- jQuery -->
    <?php // echo $this->Html->script('js/jquery.js', array('inline' => false))?>
    <!-- <script src="js/jquery.js"></script> -->
    <!-- Bootstrap JS -->
    <?php //echo $this->Html->js('js/bootstrap.min.js')?>
    <!-- <script src="js/bootstrap.min.js"></script> -->
    <!-- jQuery UI -->
    <?php //echo $this->Html->js('js/jquery-ui.min.js')?>
    <!-- <script src="js/jquery-ui.min.js"></script> -->
    <!-- jQuery Gritter -->
    <script src="js/jquery.gritter.min.js"></script>
    <!-- Respond JS for IE8 -->
    <script src="js/respond.min.js"></script>
    <!-- HTML5 Support for IE -->
    <script src="js/html5shiv.js"></script>
    <!-- Custom JS -->
    <script src="js/custom.js"></script>
  </body>
</html>