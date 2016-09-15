<div class="mainbar">
    <!-- WRAPPER -->
    <div class="wrapper">
        <!-- SERVICES -->
        <section class="module">
            <div class="container">
                <!-- MODULE TITLE -->
                <div class="row">
                    <div class="col-md-12">
                    <h3 class="h3title">個別決済画面発行ページ</h3>
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
                <!-- /MODULE TITLE -->
            </div>
        </section>
      </div>
        <!-- /SERVICES -->
    </div>
</div><!--/ Mainbar ends