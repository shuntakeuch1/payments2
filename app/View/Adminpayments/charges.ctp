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
                                        <?php if(empty($names[$key])) :?>
                                        <tr class="cursor_pointer_n">
                                            <td class="col-xs-3 col-sm-3 col-md-3" style="color:red"><?=$awesome_arr["charge"];?>&nbsp;ID:<?=h($charge->id);?>がDB上に見つかりません</td>
                                        <?php else :?>
                                        <?php echo "<tr class=\"cursor_pointer\" data-href=\"charges/".$charge->id. "\">"; ?>
                                            <td class="col-xs-3 col-sm-3 col-md-3"><?=$awesome_arr["charge"];?>&nbsp;<?=h($names[$key]);?></td>
                                        <?php endif;?>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=number_format(h($charge->amount - $charge->amountRefunded))."円";?>
                                        <div class="visible-xs-inline" style=""><br></div>
                                        <?php if($charge->refunded) echo " <span class=\"badge badge-info\">払戻済</span>";
                                              elseif($charge->amount_refunded > 0) echo " <span class=\"badge badge-warning\">一部払戻済</span>";
                                              elseif($charge->captured) echo " <!--<span class=\"badge badge-success\">支払済</span>-->";
                                              else echo " <span class=\"badge badge-important\">未払い</span>"; ?>
                                        </td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=h($charge->description);?></td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=h(date('Y/m/d ', $charge->created));?>
                                                                               <div class="visible-xs-inline" style=""><br></div>
                                                                               <?=h(date('H:i', $charge->created));?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                            </table>
                        <?php endif; ?>

                        <div class="pagiWrapper pagiColor">
                            <?php if($page>1): ?>
                                <?=$this->Html->link('<<',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'charges',
                                                        "?" => array("page" => $page-1)
                                                        )
                                                    );?>
                                &nbsp;
                            <?php endif; ?>

                            <?php foreach($page_counts as $page_count): ?>
                                <?php if($page_count==$page): ?>
                                    <?=$this->Html->link($page_count,
                                                            array('controller'=>'adminpayments',
                                                            'action'=>'charges',
                                                            "?" => array("page" => $page_count)
                                                            ),
                                                            array('class' => 'page_strong')
                                                        );?>
                                <?php else: ?>
                                    <?=$this->Html->link($page_count,
                                                            array('controller'=>'adminpayments',
                                                            'action'=>'charges',
                                                            "?" => array("page" => $page_count)
                                                            )
                                                        );?>
                                <?php endif; ?>
                                &nbsp;
                            <?php endforeach;?>

                            <?php if($next_flg): ?>
                                <?=$this->Html->link('>>',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'charges',
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