<div class="mainbar">
    <!-- WRAPPER -->
    <div class="wrapper">
        <!-- SERVICES -->
        <section class="module">
            <div class="container">
                <!-- MODULE TITLE -->
                <div class="row">
                    <div class="col-md-12">
                    <h3 class="h3title">アイテム新規作成</h3>
                      <?=$this->Form->create('Item',array(
                                    'type' => 'file',
                                    'url' => array(
                                        'controller' => 'items',
                                        'action' => 'add'),
                                    'inputDefaults' => array(
                                        'div' => 'form-group',
                                        'wrapInput' =>false
                                    ),
                                    'class' => 'form-horizontal',
                                    'novalidate' => true
                                    ));?>


                    <?=$this->Form->input('cha_rec_num', array(
                                    'type' => 'text',
                                    'label' => array(
                                        'text' => '商品番号',
                                        'class' => 'col col-md-2 control-label',
                                        ),
                                    'between' => '<div class="col-md-8">',
                                    'after' => '</div>',
                                    'placeholder' => '',
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
                                        'text' => '商品名',
                                        'class' => 'col col-md-2 control-label',
                                        ),
                                    'between' => '<div class="col-md-8">',
                                    'after' => '</div>',
                                    'placeholder' => '',
                                    'class' => 'form-control',
                                    'error' => array(
                                        'attributes' => array(
                                            'wrap' => 'div',
                                            'class' => 'col-md-offset-2 col-md-8 text-danger'
                                        )
                                    ),
                                    )); ?>


                    <?=$this->Form->input('amount', array(
                                    'type' => 'email',
                                    'label' => array(
                                        'text' => '金額',
                                        'class' => 'col col-md-2 control-label',
                                        ),
                                    'between' => '<div class="col-md-8">',
                                    'after' => '</div>',
                                    'placeholder' => '',
                                    'class' => 'form-control',
                                    'error' => array(
                                        'attributes' => array(
                                            'wrap' => 'div',
                                            'class' => 'col-md-offset-2 col-md-8 text-danger'
                                        )
                                    ),
                                    )); ?>
                    <?=$this->Form->input('description', array(
                                    'type' => 'textarea',
                                    'label' => array(
                                        'text' => '内容',
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
                    <?=$this->Form->input('photo',[
                                    'type' => 'file',
                                    'label' =>[
                                        'text' => '画像',
                                        'class' => 'col col-md-2 control-label',
                                        ],
                                    'between' => '<div class="col-md-5">',
                                    'after' => '</div>',
                                    'placeholder' => '',
                                    'class' => 'form-control',
                                    // 'style'=> 'border:none',
                                    'error' => [
                                            'attributes' =>[
                                            'wrap' =>'div',
                                            'class' => 'col-md-offset-2 col-md-8 text-danger'
                                            ]
                                        ]
                                    ]);?>
                    <?=$this->Form->input('photo_dir',['type' => 'hidden']);?>
                    <?=$this->Form->input('period', array(
                                    'type' => 'checkbox',
                                    'label' => false,
                                    'before' => '<label class="col-md-2 control-label">定期課金</label><label class="col-md-1"></label>',
                                    'between' => '<label class="control-label checktext">※チェックしない場合は一時課金になります</label>',
                                    'checked' => false,
                                     )); ?>

                    <?=$this->Form->input('商品登録', array(
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
