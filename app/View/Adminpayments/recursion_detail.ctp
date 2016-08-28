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
                        <h3 class="h3title">定期課金の詳細</h3>
                        <h6>定期課金の詳細情報</h6>
                        <table class="table table-bordered table-generated">
                            <tr><td class="col-xs-3 col-sm-3 col-md-3">ID</td>
                                <td class="col-xs-9 col-sm-9 col-md-9"><?=h($recursions_detail->id);?></td></tr>
                            <tr><td>作成日時</td>
                                <td><?=h(date('Y/m/d H:i', $recursions_detail->created));?></td></tr>
                            <tr><td>金額</td>
                                <td><?=h($recursions_detail->amount)?></td>
                            </tr>
                            <tr><td>ステータス</td>
                                <td><?php if ($recursions_detail->status=="active"){
                                    echo "<span class=\"badge badge-success\">有効</span>" ;
                                    }else{
                                     echo $recursions_detail->status ;
                                        } ;?></td>
                            </tr>
                            <tr><td>課金間隔</td>
                                <td><?php if($recursions_detail->period=="month"){
                                        echo "月額";
                                }else{
                                        echo h($recursions_detail->period);
                                }?></td>
                            </tr>
                            <tr><td>課金対象の顧客</td>
                                <td><?=$this->Html->link(
                                h($recursions_detail->customer),
                                ['action' => 'customers',$recursions_detail->customer])?></td>
                            </tr>
                           <tr><td>最終施行時刻</td>
                                <td><?=h(date("Y/m/d H:i",$recursions_detail->lastExecuted))?></td>
                            </tr>
                           <tr><td>次回予定時刻</td>
                                <td><?=h(date("Y/m/d H:i",$recursions_detail->nextScheduled))?>
                                </td>
                            </tr>
                           <tr><td>メモ</td>
                                <td><?=h($recursions_detail->description)?></td>
                            </tr>
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
                                    "<tr data-href=\"/payments/adminpayments/charges/".$charge->id. "\">"; ?>
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



                        <div>
                            <?=$this->Html->link('定期課金の一覧画面へ',
                                                    array('controller'=>'adminpayments',
                                                          'action'=>'recursions',
                                                ),
                                                    array('class'=>'btn btn-default pull-left',
                                                    'id'=>'btn-return')
                                                );?>
                            <?=$this->Form->postlink('定期課金を削除する',
                                                    array('controller'=>'adminpayments',
                                                          'action'=>'recursions_delete',$recursions_detail->id
                                                ),
                                                    array(
                                                        'escape' => false,
                                                        'class'=>'btn btn-danger pull-right',
                                                        'role' =>'button',
                                                        'confirm' => "本当に削除してよろしいですか?",
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