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
                        <h3 class="h3title">イベントの詳細</h3>
                        <h3><?=$awesome_arr[substr($events_detail->type, 0, strcspn($events_detail->type,'.'))];?>&nbsp;<?=h($log_arr[$events_detail->type]);?></h3>
                        <h4>イベントの概要</h4>
                        <table class="table table-bordered table-generated">
                            <tr><td class="col-xs-4 col-sm-3 col-md-3">ID</td>
                                <td class="col-xs-8 col-sm-9 col-md-9"><?=h($events_detail->id);?></td></tr>
                            <tr><td>日時</td>
                                <td><?=h(date('Y/m/d H:i', $events_detail->created));?></td></tr>
                            <tr><td>タイプ</td><td><?=h($events_detail->type);?></td></tr>
                        </table>

                        <?php if(($type_flg) and ($type==="charge")): ?>
                            <h4>このイベントに関連するオブジェクト</h4>
                            <table class="table table-bordered table-generated table-hover">
                                <tr data-href="/payments/adminpayments/charges/<?=$events_detail->data->object->id;?>">
                                    <td class="col-xs-4 col-sm-3 col-md-3"><?=$awesome_arr[substr($events_detail->type, 0, strcspn($events_detail->type,'.'))];?>&nbsp;<?=number_format(h($events_detail->data->object->amount - $events_detail->data->object->amountRefunded))."円";?></td>
                                    <td class="col-xs-5 col-sm-6 col-md-6"><?=h($events_detail->data->object->description);?></td>
                                    <td class="col-xs-3 col-sm-3 col-md-3"><?=h(date('Y/m/d H:i', $events_detail->created));?></td></tr>
                            </table>
                        <?php elseif(($type_flg) and ($type==="customer")): ?>
                            <table class="table table-bordered table-generated table-hover">
                                <tr data-href="/payments/adminpayments/customers/<?=$events_detail->data->object->id;?>">
                                    <td class="col-xs-9 col-sm-9 col-md-9"><?=$awesome_arr[substr($events_detail->type, 0, strcspn($events_detail->type,'.'))];?>&nbsp;<?=h($events_detail->data->object->email);?></td>
                                    <td class="col-xs-3 col-sm-3 col-md-3"><?=h(date('Y/m/d H:i', $events_detail->created));?></td></tr>
                            </table>
                        <?php elseif(($type_flg) and ($type==="recursion")): ?>
                            <h4>このイベントに関連するオブジェクト</h4>
                            <table class="table table-bordered table-generated table-hover">
                                <tr data-href="/payments/adminpayments/recursion/<?=$events_detail->data->object->id;?>">
                                    <td class="col-xs-4 col-sm-3 col-md-3"><?=$awesome_arr[substr($events_detail->type, 0, strcspn($events_detail->type,'.'))];?>&nbsp;<?=number_format(h($events_detail->data->object->amount))."円";?></td>
                                    <td class="col-xs-5 col-sm-6 col-md-6"><?=h($events_detail->data->object->description);?></td>
                                    <td class="col-xs-3 col-sm-3 col-md-3"><?=h(date('Y/m/d H:i', $events_detail->created));?></td></tr>
                            </table>
                        <?php endif; ?>

                        <h4>データの詳細</h4>
                            <table class="table table-bordered table-generated">
                                <tr><td class="col-xs-12 col-sm-12 col-md-12"><?php echo "<pre>";
print_r($events_detail->data->object);
                                                                                    echo "</pre>" ?></td></tr>
                            </table>

                        <div class="col-xs-offset-5 col-sm-offset-5 col-md-offset-5">
                            <?=$this->Html->link('戻る',
                                                    array('controller'=>'adminpayments',
                                                          'action'=>'events'
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