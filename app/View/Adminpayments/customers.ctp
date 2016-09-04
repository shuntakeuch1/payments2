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
                        <h3 class="h3title">顧客の一覧</h3>
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

                                        <?php if(empty($names[$key])) :?>
                                        <tr class="cursor_pointer_n">
                                            <td class="col-xs-4 col-sm-4 col-md-4" style="color:red"><?=$awesome_arr["customer"];?>&nbsp;ID:<?=h($customer->id);?>がDB上に見つかりません</td>
                                        <?php else :?>
                                        <?php echo "<tr class=\"cursor_pointer\" data-href=\"customers/".$customer->id. "\">"; ?>
                                            <td class="col-xs-4 col-sm-4 col-md-4"><?=$awesome_arr["customer"];?>&nbsp;<?=h($names[$key]);?></td>
                                        <?php endif;?>
                                        <td class="col-xs-5 col-sm-5 col-md-5"><?=h($customer->email);?></td>
                                        <td class="col-xs-3 col-sm-3 col-md-3"><?=h(date('Y/m/d ', $customer->created));?>
                                                                               <div class="visible-xs-inline" style=""><br></div>
                                                                               <?=h(date('H:i', $customer->created));?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                            </table>
                        <?php endif; ?>

                        <div class="pagiWrapper pagiColor">
                            <?php if($page>1): ?>
                                <?=$this->Html->link('<<',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'customers',
                                                        "?" => array("page" => $page-1)
                                                        )
                                                    );?>
                                &nbsp;
                            <?php endif; ?>

                            <?php foreach($page_counts as $page_count): ?>
                                <?php if($page_count==$page): ?>
                                    <?=$this->Html->link($page_count,
                                                            array('controller'=>'adminpayments',
                                                            'action'=>'customers',
                                                            "?" => array("page" => $page_count)
                                                            ),
                                                            array('class' => 'page_strong')
                                                        );?>
                                <?php else: ?>
                                    <?=$this->Html->link($page_count,
                                                            array('controller'=>'adminpayments',
                                                            'action'=>'customers',
                                                            "?" => array("page" => $page_count)
                                                            )
                                                        );?>
                                <?php endif; ?>
                                &nbsp;
                            <?php endforeach;?>

                            <?php if($next_flg): ?>
                                <?=$this->Html->link('>>',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'customers',
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