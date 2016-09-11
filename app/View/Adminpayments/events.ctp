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
<!--                         <?=$this->Html->link('Webhookの送信履歴を見る',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'webhook_histories'
                                                        ),
                                                        array('class'=>'pull-right btn btn-default',
                                                        'id'=>'btn-webhook')
                                                    );?> --></h3>
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
                                    "<tr class=\"cursor_pointer\" data-href=\"events/".$event->id. "\">"; ?>
                                        <td class="col-xs-7 col-sm-9 col-md-9"><?=$awesome_arr[substr($event->type, 0, strcspn($event->type,'.'))];?>&nbsp;<?=h($log_arr[$event->type]);?></td>
                                        <td class="col-xs-5 col-sm-3 col-md-3"><?=h(date('Y/m/d H:i', $event->created));?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                            </table>
                        <?php endif; ?>

                        <div class="pagiWrapper pagiColor">
                            <?php if($page>1): ?>
                                <?=$this->Html->link('<<',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'events',
                                                        "?" => array("page" => $page-1)
                                                        )
                                                    );?>
                                &nbsp;
                            <?php endif; ?>

                            <?php foreach($page_counts as $page_count): ?>
                                <?php if($page_count==$page): ?>
                                    <?=$this->Html->link($page_count,
                                                            array('controller'=>'adminpayments',
                                                            'action'=>'events',
                                                            "?" => array("page" => $page_count)
                                                            ),
                                                            array('class' => 'page_strong')
                                                        );?>
                                <?php else: ?>
                                    <?=$this->Html->link($page_count,
                                                            array('controller'=>'adminpayments',
                                                            'action'=>'events',
                                                            "?" => array("page" => $page_count)
                                                            )
                                                        );?>
                                <?php endif; ?>
                                &nbsp;
                            <?php endforeach;?>

                            <?php if($next_flg): ?>
                                <?=$this->Html->link('>>',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'events',
                                                        "?" => array("page" => $page+1)
                                                        )
                                                    );?>
                            <?php endif; ?>

                            <br>
                            <?php if($page*$count > $number): ?>
                                <?=($page-1)*$count+1;?> ~ <?=$number;?>件目 (全<?=$number;?>件)
                            <?php else: ?>
                                <?=($page-1)*$count+1;?> ~ <?=($page)*$count;?>件目 (全<?=$number;?>件)
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