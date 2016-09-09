<!-- Main bar -->
<div class="mainbar">
    <!-- WRAPPER -->
    <div class="wrapper">
        <!-- SERVICES -->
        <section class="module">
            <div class="container">
                <!-- MODULE TITLE -->
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="h3title">個別課金の詳細</h3>

                        <?php if($edit_flg || $refund_flg): ?>
                            <h4>払い戻しの情報</h4>
                        <div style="border: 1px solid #ddd;">
                            <?=$this->Form->create('Refund', array('url' => array('controller' => 'adminpayments', 'action' => 'charges',$charges_detail->id,'refund'))); ?>

                            <?php if($amount_refunded_error): ?>
                                <div id="refund_error">・払い戻し金額は1円以上<?=number_format(h($charges_detail->amount - $charges_detail->amount_refunded)); ?>円以内で指定してください</div>
                            <?php endif; ?>

                            <?php if(isset($webpay_error)): ?>
                                <div id="refund_error">・<?="すでに全額返金済み、もしくは課金から90日以上経過しているため返金できません"; ?></div>
                            <?php endif; ?>

                            <div class="col-md-12">
                                払い戻す金額は、1円以上<?=number_format(h($charges_detail->amount - $charges_detail->amount_refunded)); ?>円以内で指定してください。
                            </div>
                            <div style="display:inline-flex">
                                <div class="col-md-7 form_margin">
                                    払い戻す金額<div class="visible-xs-inline" style=""><br>&nbsp;</div> (単位:円)
                                </div>
                                <?=$this->Form->input('amount_refunded', array(
                                        'type' => 'text',
                                        'label' => false,
                                        'size' => '10',
                                        'value' => $charges_detail->amount - $charges_detail->amount_refunded,
                                        'before' => '<div class="col-md-1" style="padding-top:4px">',
                                        'after' => '</div>',
                                        'class' => '',

                                        )); ?>
                                <?=$this->Form->input('払い戻す', array(
                                        'type' => 'submit',
                                        'label' => false,
                                        'before' => '<div class="col-md-1 form_margin">',
                                        'after' => '</div>',
                                        'class' => 'btn btn-danger confirm_link',
                                        'id' => 'btn-round',
                                        )); ?>
                                <?=$this->Form->end(); ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <h4>課金の詳細情報</h4>
                        <table class="table table-bordered table-generated">
                            <tr><td class="col-xs-3 col-sm-3 col-md-3">ID</td>
                                <td class="col-xs-9 col-sm-9 col-md-9"><?=h($charges_detail->id);?></td></tr>
                            <tr><td>課金日時</td>
                                <td><?=h(date('Y/m/d H:i', $charges_detail->created));?></td></tr>

                                <?php if(empty($customer)) :?>
                                    <tr><td>お客様名</td><td style="color:red">ID:<?=h($this->params['pass'][0]);?>がDB上に見つかりません</td></tr>
                                    <tr><td>EMAIL</td><td style="color:red">ID:<?=h($this->params['pass'][0]);?>がDB上に見つかりません</td></tr>
                                <?php else :?>
                                    <tr><td>お客様名</td><td><?=h($customer['name']);?></td></tr>
                                    <tr><td>EMAIL</td><td><?=h($customer['email']);?></td></tr>
                                <?php endif;?>

                            <tr><td>決済内容</td><td><?=h($charges_detail->description);?></td></tr>
                            <tr><td>課金額</td><td><?=h(number_format(h($charges_detail->amount)))."円 ";?></td></tr>
                            <?php if($charges_detail->amountRefunded>0): ?>
                                <tr><td>払戻金額</td><td><?=h(number_format(h($charges_detail->amountRefunded)))."円 ";?></td></tr>
                            <?php endif; ?>
                            <tr><td>ステータス</td><td><?=$paid;?></td></tr>
                        </table>

                        <h4>カード情報</h4>
                        <table class="table table-bordered table-generated">
                            <tr><td class="col-xs-3 col-sm-3 col-md-3">名前</td>
                                <td class="col-xs-9 col-sm-9 col-md-9"><?=h($charges_detail->card->name);?></td></tr>
                            <tr><td>カード番号</td><td>**** **** **** <?=h($charges_detail->card->last4);?></td></tr>
                            <tr><td>識別ID</td><td><?=h($charges_detail->card->fingerprint);?></td></tr>
                            <tr><td>有効期限</td><td><?=h(sprintf('%02d', $charges_detail->card->expMonth));?> / <?=h($charges_detail->card->expYear);?></td></tr>
                            <tr><td>タイプ</td><td><?=h($charges_detail->card->type);?></td></tr>
                        </table>

                        <h4>手数料</h4>
                        <table class="table table-bordered table-generated">
                        <thead>
                            <tr>
                                <td>手数料</td>
                                <td>ステータス</td>
                                <td>支払日時</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $fees = array_reverse($charges_detail->fees);?>
                            <?php foreach($fees as $fee): ?>
                                <tr>
                                    <td class="col-xs-6 col-sm-5 col-md-5"><?=$awesome_arr["fee"];?>&nbsp;<?=h(number_format(h($fee->amount)))."円 ";?> (<?=h($fee->rate)."%+".h($fee->transactionFee)."円";?>)</td>
                                    <td class="col-xs-3 col-sm-3 col-md-3"><?=h($transactionType[$fee->transactionType]);?></td>
                                    <td class="col-xs-3 col-sm-4 col-md-4"><?=h(date('Y/m/d ', $fee->created));?>
                                                                               <div class="visible-xs-inline" style=""><br></div>
                                                                               <?=h(date('H:i', $fee->created));?></td></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                        </table>

                        <h4>関連した顧客</h4>
                        <?php if(is_null($charges_detail->customer)): ?>
                            <?="<h5>顧客情報がありません。</h5>"; ?>
                        <?php else: ?>
                            <table class="table table-bordered table-generated table-hover">
                            <thead>
                                <tr>
                                    <td>メールアドレス</td>
                                    <td>作成日時</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo
                                "<tr data-href=\"../customers/".$charges_detail->customer. "\">"; ?>
                                        <td class="col-xs-9 col-sm-8 col-md-8"><?=$awesome_arr["customer"];?>&nbsp;<?=h($customer_detail->email);?></td>
                                        <td class="col-xs-3 col-sm-4 col-md-4"><?=h(date('Y/m/d ', $customer_detail->created));?>
                                                                               <div class="visible-xs-inline" style=""><br></div>
                                                                               <?=h(date('H:i', $customer_detail->created));?></td>
                                </tr>
                            </tbody>
                            </table>
                        <?php endif; ?>

                        <?php if(isset($recursion_detail)): ?>
                        <h4>関連した定期課金</h4>
                            <table class="table table-bordered table-generated table-hover">
                            <thead>
                                <tr>
                                    <td>内容</td>
                                    <td>ステータス</td>
                                    <td>作成日時</td>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php echo
                                    "<tr data-href=\"../recursions/".$recursion_detail->id. "\">"; ?>
                                        <td class="col-xs-6 col-sm-5 col-md-5"><?=$awesome_arr["recursion"];?>&nbsp;<?=h($recursion_detail->description);?></td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=h($recursion_detail->status);?></td>
                                        <td class="col-xs-3 col-sm-4 col-md-4"><?=h(date('Y/m/d ', $recursion_detail->created));?>
                                                                               <div class="visible-xs-inline" style=""><br></div>
                                                                               <?=h(date('H:i', $recursion_detail->created));?></td>
                                    </tr>
                            </tbody>
                            </table>
                        <?php endif; ?>



                        <div>
                            <?=$this->Html->link('課金の履歴画面へ',
                                                    array('controller'=>'adminpayments',
                                                          'action'=>'charges'
                                                ),
                                                    array('class'=>'btn btn-default pull-left',
                                                    'id'=>'btn-return')
                                                );?>
                            <?php if(!$edit_flg && !$refund_flg): ?>
                                <?=$this->Html->link('<i class="fa fa-minus-circle"></i> 課金を払い戻す',
                                                        array('controller'=>'adminpayments',
                                                              'action'=>'charges',
                                                              $charges_detail->id,
                                                              'edit'
                                                    ),
                                                        array('class'=>'btn btn-danger pull-right',
                                                        'id'=>'btn-round',
                                                        'escape' => false
                                                        )
                                                    );?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- /MODULE TITLE -->
            </div>
        </section>
        <!-- /SERVICES -->
    </div>
</div><!--/ Mainbar ends