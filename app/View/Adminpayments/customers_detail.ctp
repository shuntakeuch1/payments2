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
                        <h3 class="h3title">顧客の詳細</h3>
                        <h4>顧客の詳細情報</h4>
                        <table class="table table-bordered table-generated">
                            <tr><td class="col-xs-3 col-sm-3 col-md-3">ID</td>
                                <td class="col-xs-9 col-sm-9 col-md-9"><?=h($customers_detail->id);?></td></tr>
                            <tr><td>作成日時</td>
                                <td><?=h(date('Y/m/d H:i', $customers_detail->created));?></td></tr>

                            <?php if(empty($customer)) :?>
                                <tr><td>お客様名</td><td style="color:red">ID:<?=h($this->params['pass'][0]);?>がDB上に見つかりません</td></tr>
                                <tr><td>EMAIL</td><td style="color:red">ID:<?=h($this->params['pass'][0]);?>がDB上に見つかりません</td></tr>
                            <?php else :?>
                                <tr><td>お客様名</td><td><?=h($customer['name']);?></td></tr>
                                <tr><td>EMAIL</td><td><?=h($customer['email']);?></td></tr>
                            <?php endif;?>

                        </table>

                        <h4>クレジットカード情報</h4>
                        <table class="table table-bordered table-generated">
                            <tr><td class="col-xs-3 col-sm-3 col-md-3">名前</td>
                                <td class="col-xs-9 col-sm-9 col-md-9"><?=h($customers_detail->activeCard->name);?></td></tr>
                            <tr><td>カード番号</td><td>**** **** **** <?=h($customers_detail->activeCard->last4);?></td></tr>
                            <tr><td>識別ID</td><td><?=h($customers_detail->activeCard->fingerprint);?></td></tr>
                            <tr><td>有効期限</td><td><?=h(sprintf('%02d', $customers_detail->activeCard->expMonth));?> / <?=h($customers_detail->activeCard->expYear);?></td></tr>
                            <tr><td>タイプ</td><td><?=h($customers_detail->activeCard->type);?></td></tr>
                        </table>

                        <h4>課金履歴</h4>
                        <?php if(empty($customers_charges)): ?>
                            <?="<h5>課金の履歴はありません。</h5>"; ?>
                        <?php else: ?>
                            <table class="table table-bordered table-generated table-hover">
                            <thead>
                                <tr>
                                    <td>金額</td>
                                    <td>内容</td>
                                    <td>課金日時</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($customers_charges as $key => $charge): ?>
                                    <?php echo
                                    "<tr data-href=\"../charges/".$charge->id. "\">"; ?>
                                        <td class="col-xs-4 col-sm-4 col-md-3">
                                            <?=$awesome_arr["charge"];?>&nbsp;<?=number_format(h($charge->amount - $charge->amountRefunded))."円";?>

                                            <div class="visible-xs-inline" style=""><br></div>
                                            <?php if($charge->refunded) echo " <span class=\"badge badge-info\">払戻済</span>";
                                                  elseif($charge->amount_refunded > 0) echo " <span class=\"badge badge-warning\">一部払戻済</span>";
                                                  elseif($charge->captured) echo " <!--<span class=\"badge badge-success\">支払済</span>-->";
                                                  else echo " <span class=\"badge badge-important\">未払い</span>"; ?>
                                        </td>
                                        <td class="col-xs-5 col-sm-5 col-md-6"><?=h($charge->description);?></td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=h(date('Y/m/d ', $charge->created));?>
                                                                               <div class="visible-xs-inline" style=""><br></div>
                                                                               <?=h(date('H:i', $charge->created));?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                            </table>
                        <?php endif; ?>


                        <h4>登録されている定期課金</h4>
                        <?php if(empty($customers_detail->recursions[0])): ?>
                            <?="<h5>この顧客が登録されている定期課金はありません。</h5>"; ?>
                        <?php else: ?>
                            <table class="table table-bordered table-generated table-hover">
                            <thead>
                                <tr>
                                    <td>金額</td>
                                    <td>内容</td>
                                    <td>作成日時</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($customers_detail->recursions as $key => $recursion): ?>
                                    <?php echo
                                    "<tr data-href=\"../recursions/".$recursion->id. "\">"; ?>
                                        <td class="col-xs-4 col-sm-4 col-md-3"><?=$awesome_arr["recursion"];?>&nbsp;<?=number_format(h($recursion->amount))."円";?></td>
                                        <td class="col-xs-5 col-sm-5 col-md-6"><?=h($recursion->description);?></td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=h(date('Y/m/d ', $recursion->created));?>
                                                                               <div class="visible-xs-inline" style=""><br></div>
                                                                               <?=h(date('H:i', $recursion->created));?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                            </table>
                        <?php endif; ?>

                        <div>
                            <?=$this->Html->link('顧客の一覧画面へ',
                                                    array('controller'=>'adminpayments',
                                                          'action'=>'customers'
                                                ),
                                                    array('class'=>'btn btn-default pull-left',
                                                    'id'=>'btn-return')
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