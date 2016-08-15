<?=$this->Html->css("../css/message");?>
<div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <!-- Menu button for smallar screens -->
    <div class="navbar-header">
      <!-- <a href="#" class="navbar-brand">ELITES PAYMENTS</a> -->
                <a href="index.html" class="navbar-brand"> <span class="bold"><i class="fa fa-credit-card-alt" aria-hidden="true"></i>
ELITES PAYMENTS</span></a>

    </div>
  </div>
</div>

<!-- Main content starts -->
<div class="content">



    <div class="wrapper">
    <section class="module">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-xs-12">
          <h3>ELITESログインページ</h3>
          <?=$this->Flash->render('auth');?>
            <div class="widget wblue">
                      <div class="widget-head">
                <div class="pull-left">ログイン</div>
                <div class="clearfix"></div>
              </div>
              <div class="widget-content">
                <div class="padd">

                <!-- Form starts.  -->
                  <?=$this->Form->create('Adminuser',array(
                                'url' => array(
                                    'controller' => 'adminusers',
                                    'action' => 'login'),
                                'inputDefaults' => array(
                                    'div' => 'form-group',
                                    'wrapInput' =>false
                                ),
                                'class' => 'form-horizontal',
                                'novalidate' => true
                                ));?>


                <?=$this->Form->input('email', array(
                                'type' => 'email',
                                'label' => array(
                                    'text' => 'メールアドレス',
                                    'class' => 'col col-md-2 control-label',
                                    ),
                                'between' => '<div class="col-md-8">',
                                'after' => '</div>',
                                'placeholder' => 'hoge@hoge.jp',
                                'class' => 'form-control',
                                'error' => array(
                                    'attributes' => array(
                                        'wrap' => 'div',
                                        'class' => 'col-md-offset-2 col-md-8 text-danger'
                                    )
                                ),
                                )); ?>


                <?=$this->Form->input('password', array(
                                'type' => 'password',
                                'label' => array(
                                    'text' => 'パスワード',
                                    'class' => 'col col-md-2 control-label',
                                    ),
                                'between' => '<div class="col-md-8">',
                                'after' => '</div>',
                                'placeholder' => ' ',
                                'class' => 'form-control',
                                'error' => array(
                                    'attributes' => array(
                                        'wrap' => 'div',
                                        'class' => 'col-md-offset-2 col-md-8 text-danger'
                                    )
                                ),
                                )); ?>


                <?=$this->Form->input('ログイン', array(
                                'type' => 'submit',
                                'label' => false,
                                'before' => '<div class="col-md-offset-2 col-md-4">',
                                'after' => '</div>',
                                'class' => 'btn btn-block btn-primary'
                                )); ?>

                <?=$this->form->end();?>
            </div>
        </div>
      </div>
    </div><!--/ Matter ends -->
  </div><!--/ Mainbar ends -->
  <div class="clearfix"></div>
</div>


    <!-- CONTACT -->
    <section class="module-small">

        <div class="container">

            <div class="row">

                <!-- CONTENT BOX -->
                <div class="col-xs-6">
                    <div class="content-box">
                        <div class="content-box-title font-inc">
                            <p class="m-b-0">株式会社NOWALL</p>
                        </div>
                        <p>
                            <a href="http://nowall.co.jp/" target="_blank">会社概要</a>
                            <a href="http://nowall.co.jp/legal" target="_blank">特定商取引法に基づく表示</a>
                        </p>
                    </div>
                </div>
                <!-- /CONTENT BOX -->

                <!-- CONTENT BOX -->
                <div class="col-xs-6">
                    <p class="m-b-0" style="font-size: 1.5em">アクセス</p>
                    <p class="m-b-0" style="font-size: 1.5em">〒160-0023 東京都新宿区西新宿6丁目10番1号 セントラルパークタワー ラ・トゥール新宿 6階</p>
                </div>
                <!-- /CONTENT BOX -->
            </div>

        </div>

    </section>
    <!-- /CONTACT -->

    <!-- FOOTER -->
    <footer class="footer">

        <div class="container">

            <div class="row">

                <div class="col-sm-12 text-center">
                    <p class="copyright font-inc m-b-0">© 2015 <a href="http://nowall.co.jp/" target="_blank">NOWALL, Inc.</a> All Rights Reserved.</p>
                </div>

            </div>

        </div>

    </footer>
    <!-- /FOOTER -->

</div>
<!-- /WRAPPER -->


<div class="clearfix"></div>
</div><!--/ Content ends -->
