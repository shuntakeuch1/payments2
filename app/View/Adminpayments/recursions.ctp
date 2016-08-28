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
                                <?php echo"<tr data-href=\"/payments/adminpayments/recursions/".$recursion->id. "\">"; ?>
                                <td><?=$awesome_arr["recursion"];?>&nbsp;<?=$recursion->description;?></td>
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
                        <div class="pagiWrapper pagiCenter">
                            <?php if($page>1): ?>
                                <?=$this->Html->link('<< 前へ',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'recursions',
                                                        "?" => array("page" => $page-1)
                                                        )
                                                    );?>
                                &nbsp;&nbsp;&nbsp;
                            <?php endif; ?>
                            <?php if($next_flg): ?>
                                <?=$this->Html->link('次へ >>',
                                                        array('controller'=>'adminpayments',
                                                        'action'=>'recursions',
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