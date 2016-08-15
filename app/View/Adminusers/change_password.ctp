<div class="mainbar">
    <!-- WRAPPER -->
    <div class="wrapper">
        <!-- SERVICES -->
        <section class="module">
            <div class="container">

                <!-- MODULE TITLE -->
                <div class="row">
                    <div class="col-md-12">

                        <h3 class="h3title">パスワード変更画面</h3>

                          <?=$this->Form->create('Adminuser',array(
                                        'url' => array(
                                            'controller' => 'adminusers',
                                            'action' => 'changePassword'),
                                        'inputDefaults' => array(
                                            'div' => 'form-group',
                                            'wrapInput' =>false
                                        ),
                                        'class' => 'form-horizontal',
                                        'novalidate' => true
                                        ));?>
                        <?=$this->Form->input('password_current', array(
                                        'type' => 'password',
                                        'label' => array(
                                            'text' => '現在のパスワード',
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
                        <?=$this->Form->input('id')?>
                        <?=$this->Form->input('password', array(
                                        'type' => 'password',
                                        'label' => array(
                                            'text' => '新しいパスワード',
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
                        <?=$this->Form->input('編集', array(
                                        'type' => 'submit',
                                        'label' => false,
                                        'before' => '<div class="col-md-offset-2 col-md-4">',
                                        'after' => '</div>',
                                        'class' => 'btn btn-block btn-primary'
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