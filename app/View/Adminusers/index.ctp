<?=$this->Html->css("td_hide","stylesheet",array('media'=>"screen"));?>
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
                    <h3 class="h3title">管理者ユーザ一覧</h3></div>

                        <div class="max500" style="margin-bottom:5px;">
                        <?=$this->Html->link('新規登録','create',
                          array('class'=>'btn btn-default',
                          'id'=>'btn-return'))?>
                        <?=$this->Html->link('パスワード変更',
                            ['action' => 'changePassword'],
                                array('class'=>'btn btn-default',
                                  'id'=>'btn-return'))?></div>
                                  <div style="clear:both; margin-bottom:10px;">
                                  <?=$this->Session->flash(); ?></div>
                          <?php foreach($adminusers as $user) :?>
                            <table class="table table-bordered" style="margin-bottom:10px; width:100%;">
                              <tr>
                                <td style="width:5%"><?=h($user['Adminuser']['staff_id'])?></td>
                                <td  class="col-sm-3"><?=h($user['Adminuser']['name'])?></td>
                                <td class="col-sm-4" id="td_hide"><?=h($user['Adminuser']['email'])?></td>
                                <td class="col-sm-1" style = "text-align:center; width:10%;">
                                <?=$this->Html->link('編集',['action' => 'edit',$user['Adminuser']['id']],[
                                  'class' => 'btn btn_f btn-primary btn-sm','role' =>'button']
                                );?>

                                </td>
                                <td class="col-sm-1" style = "text-align:center; width:10%;">
                                  <?=$this->Form->postLink('削除',
                                  ['action' => 'delete',$user['Adminuser']['id']],
                                    ['escape' => false,
                                            'class' => 'btn btn_f btn-primary btn-sm',
                                            'role' => 'button',
                                            'confirm' =>'本当に削除してよろしいですか?']
                                  )?>
                                </td>
                              </tr>
                            </table>

                          <?php endforeach ;?>

                          <!-- ページネーション機能 -->
                          <div class="pagiWrapper pagiColor">
                            <?php
                              if($p_limit < $maxitem){
                                echo $this->Paginator->prev('<< ',array(), null, array('class' => 'prev disabled'));
                              echo $this->Paginator->numbers(
                                                      ['separator' => '  ',
                                                      'currentClass' => 'page_strong']);
                              echo $this->Paginator->next(' >>',array(), null, array('class' => 'next disabled'));
                              }
                            ?>
                            <br>
                            <?php echo $this->paginator->counter(array('format' => '%start%~%end%件目 (全%count%件)'));?>

                          </div>
                        </div>

                </div>
                <!-- /MODULE TITLE -->
            </div>
        </section>
      </div>
        <!-- /SERVICES -->
    </div>
</div><!--/ Mainbar ends