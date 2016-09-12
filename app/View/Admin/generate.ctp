      <!-- Main bar -->
      <div class="mainbar">
        <!-- Page heading -->
        <div class="page-head">
          <!-- Page heading -->
          <h2 class="pull-left">個別決済画面発行ページ</h2>
          <div class="clearfix"></div>
        </div><!--/ Page heading ends -->
        <!-- Matter -->
        <div class="matter">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="widget wblue">
                          <div class="widget-head">
                    <div class="pull-left">個別決済画面発行ページ</div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="widget-content">
                    <div class="padd">

                    <!-- Form starts.  -->
                      <?=$this->Form->create('Admin',array(
                                    'url' => array(
                                        'controller' => 'admin',
                                        'action' => 'generate'),
                                    'inputDefaults' => array(
                                        'div' => 'form-group',
                                        'wrapInput' =>false
                                    ),
                                    'class' => 'form-horizontal',
                                    'novalidate' => true
                                    ));?>

                    <?=$this->Form->input('nowall-name', array(
                                    'type' => 'text',
                                    'label' => array(
                                        'text' => 'NOWALL担当者',
                                        'class' => 'col col-md-2 control-label',
                                        ),
                                    'value' => $currentUser['name'],
                                    'between' => '<div class="col-md-8">',
                                    'after' => '</div>',
                                    'placeholder' => '柏木 祥太',
                                    'class' => 'form-control',
                                    'error' => array(
                                        'attributes' => array(
                                            'wrap' => 'div',
                                            'class' => 'col-md-offset-2 col-md-8 text-danger'
                                        )
                                    ),
                                    )); ?>

                    <?=$this->Form->input('name', array(
                                    'type' => 'text',
                                    'label' => array(
                                        'text' => 'お客様名',
                                        'class' => 'col col-md-2 control-label',
                                    ),
                                    'between' => '<div class="col-md-8">',
                                    'after' => '</div>',
                                    'placeholder' => '田中 太郎',
                                    'class' => 'form-control',
                                    'error' => array(
                                        'attributes' => array(
                                            'wrap' => 'div',
                                            'class' => 'col-md-offset-2 col-md-8 text-danger'
                                        )
                                    ),
                                    )); ?>


                    <?=$this->Form->input('email', array(
                                    'type' => 'text',
                                    'label' => array(
                                        'text' => 'EMAIL',
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

                    <?=$this->Form->input('summary', array(
                                    'type' => 'text',
                                    'label' => array(
                                        'text' => '決済内容',
                                        'class' => 'col col-md-2 control-label',
                                        ),
                                    'between' => '<div class="col-md-8">',
                                    'after' => '</div>',
                                    'placeholder' => 'WEBエンジニアマスターコース',
                                    'class' => 'form-control',
                                    'error' => array(
                                        'attributes' => array(
                                            'wrap' => 'div',
                                            'class' => 'col-md-offset-2 col-md-8 text-danger'
                                        )
                                    ),
                                    )); ?>

                    <?=$this->Form->input('amount', array(
                                    'type' => 'text',
                                    'label' => array(
                                        'text' => '決済金額',
                                        'class' => 'col col-md-2 control-label',
                                        ),
                                    'between' => '<div class="col-md-8">',
                                    'after' => '</div>',
                                    'placeholder' => '600000',
                                    'class' => 'form-control',
                                    'error' => array(
                                        'attributes' => array(
                                            'wrap' => 'div',
                                            'class' => 'col-md-offset-2 col-md-8 text-danger'
                                        )
                                    ),
                                    )); ?>
                    <?=$this->Form->input('period', array(
                                    'type' => 'checkbox',
                                    'label' => false,
                                    'before' => '<label class="col-md-2 control-label">毎月課金</label><label class="col-md-1"></label>',
                                    'between' => '<label class="control-label checktext">※チェックしない場合は一時課金になります</label>',
                                    'checked' => false,
                                     )); ?>


                    <?=$this->Form->input('発行する', array(
                                    'type' => 'submit',
                                    'label' => false,
                                    'before' => '<div class="col-md-offset-2 col-md-4">',
                                    'after' => '</div>',
                                    'class' => 'btn_f btn-block btn-primary'
                                    )); ?>

                    <?=$this->form->end();?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!--/ Matter ends -->
      </div><!--/ Mainbar ends -->