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
                        <h3 class="h3title">イベントログ
                        <?=$this->Html->link('Webhookの送信履歴を見る',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'webhook_histories'
                                                        ),
                                                        array('class'=>'pull-right btn btn-default',
                                                        'id'=>'btn-webhook')
                                                    );?></h3>
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
                                        <td class="col-xs-8 col-sm-9 col-md-9"><?=h($log_arr[$event->type]);?></td>
                                        <td class="col-xs-4 col-sm-3 col-md-3"><?=h(date('Y/m/d H:i', $event->created));?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                            </table>
                        <?php endif; ?>

                        <div class="pagiWrapper pagiCenter">
                            <?php if($page>1): ?>
                                <?=$this->Html->link('<< 前へ',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'events',
                                                        "?" => array("page" => $page-1)
                                                        )
                                                    );?>
                                &nbsp;&nbsp;&nbsp;
                            <?php endif; ?>
                            <?php if($next_flg): ?>
                                <?=$this->Html->link('次へ >>',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'events',
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