<div class="mainbar">
    <!-- WRAPPER -->
    <div class="wrapper">
        <!-- SERVICES -->
        <section class="module">
            <div class="container">
                <!-- MODULE TITLE -->
                <div class="row">
                    <div class="col-md-12">
                    <h3 class="h3title">発行完了</h3>
                        <!-- Table starts.  -->
                        <div class="widget wblue">
                          <div class="widget-head">
                            <div class="pull-left">以下の内容で決済画面を発行し、お客様へ送信しました</div>
                            <div class="clearfix"></div>
                          </div>
                          <div class="widget-content">
                            <div class="table-responsive">
                              <table class="table table-bordered table-generated">
                                <tr>
                                  <td class="col-md-3">NOWALL担当者</td>
                                  <td class="col-md-9"><?=h($sendData['Admin']['nowall-name']);?></td>
                                </tr>
                                <tr>
                                  <td class="col-md-3">お名前</td>
                                  <td class="col-md-9"><?=h($sendData['Admin']['name']);?></td>
                                </tr>

                                <tr>
                                  <td class="col-md-3">メールアドレス</td>
                                  <td class="col-md-9"><?=h($sendData['Admin']['email']);?></td>
                                </tr>

                                <tr>
                                  <td class="col-md-3">決済金額</td>
                                  <td class="col-md-9"><?=number_format(h($sendData['Admin']['amount']))."円";?>
                                      <?php if($sendData['Admin']['period']) echo "(月額)";
                                            else echo "(今月1回)";?>
                                  </td>
                                </tr>

                                <tr>
                                  <td class="col-md-3">決済内容</td>
                                  <td class="col-md-9"><?=h($sendData['Admin']['summary']);?></td>
                                </tr>
                                <tr>
                                  <td class="col-xs-3 col-sm-3 col-md-3">決済URL</td>
                                  <td class="col-xs-9 col-sm-9 col-md-9"><?=$sendData['Admin']['url'];?></td>
                                </tr>
                              </table>
                            </div>
                          </div>
                        </div>
                        <p>※メールが届かない場合、アドレス間違いや受信拒否されている可能性が
                        あります。その場合は上記URLをお客様へ別途お伝えください。</p>
                    </div>
                </div>
                <!-- /MODULE TITLE -->
            </div>
        </section>
      </div>
        <!-- /SERVICES -->
    </div>
</div><!--/ Mainbar ends