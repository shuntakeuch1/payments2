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
                        <h3 class="h3title">定期課金の一覧</h3>
                        <?=$this->Html->css("../css/successmessage");?>
                        <?=$this->Session->flash(); ?>
                        <?php if(empty($recursions)): ?>
                            <?="<h5>定期課金のデータがありません。</h5>"; ?>
                        <?php else: ?>
                            <table class="table table-bordered table-generated table-hover">
                            <thead>
                                <tr>
                                    <td>商品名</td>
                                    <td>ステータス</td>
                                    <td>入金日</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($recursions as $recursion):?>
                                <a>
                                <?php echo"<tr data-href=\"recursions/".$recursion->id. "\" style=\"cursor:pointer;\" >"; ?>
                                <td><?=$awesome_arr["recursion"];?>&nbsp;
                                    <!-- 空の場合IDを表示 -->
                                    <?php if($recursion->description==""){
                                        echo $recursion->id ;
                                    }else{
                                        echo $recursion->description ;
                                    }?>
                                </td>
                                <td><?php if ($recursion->status=="active"){
                                    echo "<span class=\"badge badge-success\">有効</span>" ;
                                    }else{
                                     echo $recursion->status ;
                                        } ;?></td>
                                <td><?=date("Y/m/d H:i T",$recursion->created)?></td>
                                </tr>
                            <?php endforeach ;?>
                            </tbody>
                            </table>
                        <?php endif; ?>

                        <div class="pagiWrapper pagiColor">
                            <?php if($page>1): ?>
                                <?=$this->Html->link('<<',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'recursions',
                                                        "?" => array("page" => $page-1)
                                                        )
                                                    );?>
                                &nbsp;
                            <?php endif; ?>

                            <?php foreach($page_counts as $page_count): ?>
                                <?php if($page_count==$page): ?>
                                    <?=$this->Html->link($page_count,
                                                            array('controller'=>'adminpayments',
                                                            'action'=>'recursions',
                                                            "?" => array("page" => $page_count)
                                                            ),
                                                            array('class' => 'page_strong')
                                                        );?>
                                <?php else: ?>
                                    <?=$this->Html->link($page_count,
                                                            array('controller'=>'adminpayments',
                                                            'action'=>'recursions',
                                                            "?" => array("page" => $page_count)
                                                            )
                                                        );?>
                                <?php endif; ?>
                                &nbsp;
                            <?php endforeach;?>

                            <?php if($next_flg): ?>
                                <?=$this->Html->link('>>',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'recursions',
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

                            <br>
                            <?php if(!$next_flg && $number>500): ?>
                                <strong class="after500">500件目以降は、WEBPAY上の管理画面で確認してください</strong>
                            <?php endif; ?>
                        </div>



                    </div>
                </div>
                <!-- /MODULE TITLE -->
            </div>
        </section>
        <!-- /SERVICES -->
    </div>
    </div>
</div><!--/ Mainbar ends