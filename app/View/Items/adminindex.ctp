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
                        <div style="display: inline-block">
                            <h3 class="h3title">ELITES商材一覧</h3></div>
                                <div class="max500">
                                    <?=$this->Html->link('新規登録',['action' => 'add'],
                                              array('class'=>'btn btn-default pull-right',
                                                      'style' =>'border-radius:5px',
                                                    'id'=>'btn-return'))?></div>
                                                    <br><br>
                                  <div clas="col-md-12">
                                  <?=$this->Html->css("../css/successmessage");?>
                                  <?=$this->Session->flash(); ?>
                                  <?php foreach($items as $item) :?>
                                      <a href="/payments/items/edit/<?=$item['Item']['id'] ?>" >

                                    <table class="table-bordered" style="margin-bottom:10px;">
                                      <tr>
                                        <td rowspan="2" style="width:10%; padding:0 1% ;">
                                          <?=$this->Item->photoImage($item, ['style' => 'width: 100%; height:auto;']);
                                              ?>
                                        </td>
                                       <td class="col-sm-offset-1 col-sm-9"><?=h($item['Item']['name'])?></td>
                                       <td rowspan="2" class="col-sm-1 sample" style="width:5%;">
                                        <?=$this->Html->link('編集',[
                                                      'action' => 'edit',
                                                          $item['Item']['id']],[
                                                              'class' => 'btn btn_f btn-primary btn-sm','role' => 'button'
                                                                ]) ;?></td>
                                       <td rowspan="2" class="col-sm-1" style="width:5%;">
                                          <div>
                                            <?=$this->Form->postLink('削除',
                                            ['action' => 'delete',$item['Item']['id']],
                                            ['escape' => false,
                                            'class' => 'btn btn_f btn-primary btn-sm',
                                            'role' => 'button',
                                            'confirm' =>'本当に削除してよろしいですか?']
                                            ) ;?>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="col-sm-9">
                                          <?=h($item['Item']['description'])?>
                                          <br><?=h(number_format($item['Item']['amount']))?>円
                                        </td>
                                      </tr>

                                    </table>
                                    </a>

                                  <?php endforeach ;?>

                                  <!-- ページネーション機能 -->
                                  <div style = "text-align:center;">
                                  <?php
                                  //5件以上の時にページネーション表示
                                    if($p_limit <= $maxitem){
                                    echo $this->Paginator->prev('< 前へ ');
                                    echo $this->Paginator->numbers();
                                    echo $this->Paginator->next(' 次へ >');
                                    }
                                  ?>
                                  <br>
                                  <?php echo $this->paginator->counter(array('format' => '%start%~%end%件目 (全%count%件)'));?>
                          </div>
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