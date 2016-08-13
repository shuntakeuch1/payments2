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
                        <h3 class="h3title">課金の履歴</h3>
                        <?php if(empty($charges)): ?>
                            <?="<h5>課金の履歴はありません。</h5>"; ?>
                        <?php else: ?>
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
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=h($names[$key]);?></td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=number_format(h($charge->amount - $charge->amountRefunded))."円";?></td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=h($charge->description);?></td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=h(date('Y/m/d H:i', $charge->created));?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                            </table>
                        <?php endif; ?>

                        <div class="pagiWrapper pagiCenter">
                            <?php if($page>1): ?>
                                <?=$this->Html->link('<< 前へ',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'charges',
                                                        "?" => array("page" => $page-1)
                                                        )
                                                    );?>
                                &nbsp;&nbsp;&nbsp;
                            <?php endif; ?>
                            <?php if($next_flg): ?>
                                <?=$this->Html->link('次へ >>',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'charges',
                                                        "?" => array("page" => $page+1)
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