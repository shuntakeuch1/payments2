<h3>管理者ユーザ一覧</h3>
<?=$this->Html->link('新規登録','create')?><p>
<?=$this->Html->link('ログアウト','logout')?>

                          <?php foreach($adminusers as $user) :?>
                            <table class="table-hover" style="border:solid 1px #000; margin-bottom:10px; width:100%;">
                              <tr>
                                <td class="col-sm-4"><?=h($user['Adminuser']['staff_id'])?></td>
                                <td  class="col-sm-8" style = "border-left:solid 1px #000;"><?=h($user['Adminuser']['name'])?></td>
                                <td><?=h($user['Adminuser']['email'])?></td>
                                <td><a href="adminusers/edit/<?=$user['Adminuser']['id'] ?>" >編集</a></td>
                                <td>
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
                            if($p_limit <= $maxitem){
                            echo $this->Paginator->prev('< 前へ ');
                            echo $this->Paginator->numbers();
                            echo $this->Paginator->next(' 次へ >');
                            }
                          ?>
                          </div>