<div class="mainbar">
    <!-- WRAPPER -->
    <div class="wrapper">
        <!-- SERVICES -->
        <section class="module">
            <div class="container">

                <!-- MODULE TITLE -->
                <div class="row">
                    <div class="col-md-12">

                        <h3 class="h3title">管理者ユーザ一覧</h3>
                        <?=$this->Html->css("../css/successmessage");?>
                        <?=$this->Html->link('新規登録','create')?>
                        <?=$this->Html->link('ログアウト','logout')?>
                        <?=$this->Session->flash(); ?>

                          <?php foreach($adminusers as $user) :?>
                            <table style="border:solid 1px #000; margin-bottom:10px; width:100%;">
                              <tr>
                                <td class="col-sm-2"><?=h($user['Adminuser']['staff_id'])?></td>
                                <td  class="col-sm-3" style = "border-left:solid 1px #000;"><?=h($user['Adminuser']['name'])?></td>
                                <td class="col-sm-4" style = "border-left:solid 1px #000;"><?=h($user['Adminuser']['email'])?></td>
                                <td class="col-sm-1" style = "border-left:solid 1px #000; align:center;"><a style="height:100%; width:100%; display:block" href="/payments/adminusers/edit/<?=$user['Adminuser']['id'] ?>">編集</a></td>
                                <td class="col-sm-1" style = "border-left:solid 1px #000; text-align:center;">
                                  <?=$this->Form->postLink('削除',
                                  ['action' => 'delete',$user['Adminuser']['id']],
                                  ['confirm' => '本当に削除してよろしいですか?']
                                  )?>
                                </td>
                              </tr>
                            </table>

                          <?php endforeach ;?>

                          <!-- ページネーション機能 -->
                          <div style = "text-align:center;">
                          <?php
                            if($p_limit < $maxitem){
                            echo $this->Paginator->prev('< 前へ ');
                            echo $this->Paginator->numbers();
                            echo $this->Paginator->next(' 次へ >');
                            }
                          ?>
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