<div class="mainbar">
    <!-- WRAPPER -->
    <div class="wrapper">
        <!-- SERVICES -->
        <section class="module">
            <div class="container">
                <!-- MODULE TITLE -->
                <div class="row">
                    <div class="col-md-12">
                    <h3 class="h3title">管理者ユーザ作成</h3>
                      <?=$this->Form->create('Adminuser',array(
                                    'url' => array(
                                        'controller' => 'adminusers',
                                        'action' => 'create'),
                                    'inputDefaults' => array(
                                        'div' => 'form-group',
                                        'wrapInput' =>false
                                    ),
                                    'class' => 'form-horizontal',
                                    'novalidate' => true
                                    ));?>
                    <?=$this->Form->input('staff_id', array(
                                    'type' => 'text',
                                    'label' => array(
                                        'text' => '社員番号',
                                        'class' => 'col col-md-2 control-label',
                                        ),
                                    'between' => '<div class="col-md-8">',
                                    'after' => '</div>',
                                    'placeholder' => '001',
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
                                        'text' => '名前',
                                        'class' => 'col col-md-2 control-label',
                                        ),
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
                    <?=$this->Form->input('password_confirm', array(
                                    'type' => 'password',
                                    'label' => array(
                                        'text' => 'パスワード(確認)',
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

                    <?=$this->Form->input('新規登録', array(
                                    'type' => 'submit',
                                    'label' => false,
                                    'before' => '<div class="col-md-offset-2 col-md-4">',
                                    'after' => '</div>',
                                    'class' => 'btn btn_f btn-block btn-primary'
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
