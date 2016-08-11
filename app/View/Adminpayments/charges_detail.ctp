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
                        <h4>課金の詳細情報</h4>
                        <table class="table table-bordered table-generated">
                            <tr><td class="col-xs-3 col-sm-3 col-md-3">ID</td>
                                <td class="col-xs-9 col-sm-9 col-md-9"><?=h($charges_detail->id);?></td></tr>
                            <tr><td>課金日時</td>
                                <td><?=h(date('Y/n/j h:i', $charges_detail->created));?></td></tr>
                            <tr><td>お客様名</td><td><?=h($customer['name']);?></td></tr>
                            <tr><td>EMAIL</td><td><?=h($customer['email']);?></td></tr>
                            <tr><td>決済内容</td><td><?=h($charges_detail->description);?></td></tr>
                            <tr><td>決済金額</td><td><?=h(number_format(h($charges_detail->amount)))."円 ";?></td></tr>
                            <tr><td>ステータス</td><td><?=h($paid);?></td></tr>
                        </table>

                        <h4>カード情報</h4>
                        <table class="table table-bordered table-generated">
                            <tr><td class="col-xs-3 col-sm-3 col-md-3">名前</td>
                                <td class="col-xs-9 col-sm-9 col-md-9"><?=h($charges_detail->card->name);?></td></tr>
                            <tr><td>カード番号</td><td>**** **** **** <?=h($charges_detail->card->last4);?></td></tr>
                            <tr><td>識別ID</td><td><?=h($charges_detail->card->fingerprint);?></td></tr>
                            <tr><td>有効期限</td><td><?=h($charges_detail->card->expMonth);?> / <?=h($charges_detail->card->expYear);?></td></tr>
                            <tr><td>タイプ</td><td><?=h($charges_detail->card->type);?></td></tr>
                        </table>

                        <h4>手数料</h4>
                        <table class="table table-bordered table-generated">
                            <tr><td class="col-xs-3 col-sm-3 col-md-3">手数料</td>
                                <td class="col-xs-9 col-sm-9 col-md-9"><?=h(number_format(h($charges_detail->fees[0]->amount)))."円 ";?> (<?=h($charges_detail->fees[0]->rate)."%+".h($charges_detail->fees[0]->transactionFee)."円";?>)</td></tr>
                            <tr><td>ステータス</td><td><?=h($transactionType);?></td></tr>
                            <tr><td>支払い日時</td>
                                <td><?=h(date('Y/n/j h:i', $charges_detail->fees[0]->created));?></td></tr>
                        </table>

                        <div class="col-xs-offset-3 col-sm-offset-4 col-md-offset-4">
                            <?=$this->Html->link('顧客情報へ',
                                                    array('controller'=>'adminpayments',
                                                          'action'=>'customers',
                                                          $charges_detail->customer
                                                ),
                                                    array('class'=>'btn btn-default',
                                                    'id'=>'btn-webhook')
                                                );?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?=$this->Html->link('戻る',
                                                    array('controller'=>'adminpayments',
                                                          'action'=>'charges'
                                                ),
                                                    array('class'=>'btn btn-default',
                                                    'id'=>'btn-webhook')
                                                );?>
                        </div>
                    </div>
                </div>
                <!-- /MODULE TITLE -->
            </div>
        </section>
        <!-- /SERVICES -->
    </div>
</div><!--/ Mainbar ends