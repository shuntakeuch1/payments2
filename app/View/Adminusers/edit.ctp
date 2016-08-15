<a href="/payments/adminusers/changePassword">パスワード変更</a>
                      <?=$this->Form->create('Adminuser',array(
                                    'url' => array(
                                        'controller' => 'adminusers',
                                        'action' => 'edit'),
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
                    <?=$this->Form->input('id')?>
                    <?=$this->Form->input('password_current', array(
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
                    <?=$this->Form->input('編集', array(
                                    'type' => 'submit',
                                    'label' => false,
                                    'before' => '<div class="col-md-offset-2 col-md-4">',
                                    'after' => '</div>',
                                    'class' => 'btn btn-block btn-primary'
                                    )); ?>

                    <?=$this->form->end();?>
