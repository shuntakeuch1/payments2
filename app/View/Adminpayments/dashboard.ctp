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
                        <h3 class="h3title"></h3>
                        <div>
                            <div class="col-md-4">
                                <div class="legend">今月の売上金額</div>
                                <div class="result"><?=number_format(h($amount_count))." 円";?></div>
                            </div>
                            <div class="col-md-4">
                                <div class="legend">今月のトランザクション数</div>
                                <div class="result"><?=$transaction_count;?> 件</div>
                            </div>
                            <div class="col-md-4">
                                <div class="legend">現在の顧客数</div>
                                <div class="result"><?=$customer_count;?> 名</div>
                            </div>
                        </div>

                        <div class="btn btn-default pull-left btn-chart_valid" id="btn-charge">売上金額</div>
                        <div class="btn btn-default pull-left btn-chart_invalid" id="btn-transaction">トランザクション数</div>

                        <canvas id="canvas" height="450" width="600" style="height:450px width:600px"></canvas>

                        <h3><i class="fa fa-credit-card h3dashboard"></i> 最近追加された課金</h3>
                        <table class="table table-bordered table-generated table-hover">
                            <thead>
                                <tr>
                                    <td>名前</td>
                                    <td>金額</td>
                                    <td>内容</td>
                                    <td>課金日</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($charges as $key => $charge): ?>
                                    <?php echo
                                    "<tr data-href=\"/payments/adminpayments/charges/".$charge->id. "\">"; ?>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=$awesome_arr["charge"];?>&nbsp;<?=h($charge_names[$key]);?></td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=number_format(h($charge->amount - $charge->amountRefunded))."円";?>

                                        <div class="visible-xs-inline" style=""><br></div>
                                        <?php if($charge->refunded) echo " <span class=\"badge badge-info\">払戻済</span>";
                                              elseif($charge->amount_refunded > 0) echo " <span class=\"badge badge-warning\">一部払戻済</span>";
                                              elseif($charge->captured) echo " <!--<span class=\"badge badge-success\">支払済</span>-->";
                                              else echo " <span class=\"badge badge-important\">未払い</span>"; ?>

                                        </td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=h($charge->description);?></td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=h(date('Y/m/d H:i', $charge->created));?></td>
                                    </tr>
                                <?php endforeach;?>
                                <tr data-href="/payments/adminpayments/charges"><td class="td_log" colspan="4">課金の履歴を見る</td></tr>
                            </tbody>
                        </table>

                        <h3><i class="fa fa-users"></i> 最近追加された顧客</h3>
                        <?php if(empty($customers)): ?>
                            <?="<h5>顧客のデータがありません。</h5>"; ?>
                        <?php else: ?>
                            <table class="table table-bordered table-generated table-hover">
                            <thead>
                                <tr>
                                    <td>名前</td>
                                    <td>メールアドレス</td>
                                    <td>作成日時</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($customers as $key => $customer): ?>
                                    <?php echo
                                    "<tr data-href=\"/payments/adminpayments/customers/".$customer->id. "\">"; ?>
                                        <td class="col-xs-4 col-sm-4 col-md-4"><?=$awesome_arr["customer"];?>&nbsp;<?=h($customer_names[$key]);?></td>
                                        <td class="col-xs-5 col-sm-5 col-md-5"><?=h($customer->email);?></td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=h(date('Y/m/d H:i', $customer->created));?></td>
                                    </tr>
                                <?php endforeach;?>
                                <tr data-href="/payments/adminpayments/customers"><td class="td_log" colspan="4">顧客の一覧を見る</td></tr>
                            </tbody>
                            </table>
                        <?php endif; ?>

                        <h3><i class="fa fa-rss"></i> 最近発生したイベント</h3>
                        <?php if(empty($events)): ?>
                            <?="<h5>イベントリストはありません。</h5>"; ?>
                        <?php else: ?>
                            <table class="table table-bordered table-generated table-hover">
                            <thead>
                                <tr>
                                    <td>イベント名</td>
                                    <td>発生日時</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($events as $key => $event): ?>
                                    <?php echo
                                    "<tr data-href=\"/payments/adminpayments/events/".$event->id. "\">"; ?>
                                        <td class="col-xs-9 col-sm-9 col-md-9"><?=$awesome_arr[substr($event->type, 0, strcspn($event->type,'.'))];?>&nbsp;<?=h($log_arr[$event->type]);?></td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=h(date('Y/m/d H:i', $event->created));?></td>
                                    </tr>
                                <?php endforeach;?>
                                <tr data-href="/payments/adminpayments/events"><td class="td_log" colspan="4">イベントログを見る</td></tr>
                            </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /MODULE TITLE -->
            </div>
        </section>
        <!-- /SERVICES -->
    </div>
</div><!--/ Mainbar ends -->