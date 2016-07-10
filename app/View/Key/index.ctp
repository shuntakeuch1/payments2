

    <!-- NAVIGATION -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">

            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://elite.sc/" style="padding: 3px;">
                        <?=$this->Html->image("/elites/img/ELITES_LOGO2.png",
                            array('alt' => 'ELITES Logo',
                                  'height'=>'100%',
                                  'float' => 'left'));?>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="custom-collapse">

                    <ul class="nav navbar-nav navbar-right">

                        <li><a class="section-scroll" href="http://elite.sc/#about">ELITESの特長</a></li>

                        <li><a class="section-scroll" href="http://elite.sc/#courses">コース</a></li>

                        <li><a class="section-scroll" href="http://elite.sc/#student-voice">参加者の声</a></li>

                        <li><a class="section-scroll" href="http://elite.sc/#mentors">講師プロフィール</a></li>

                        <li><a class="section-scroll" href="http://elite.sc/#contact">まずは無料相談</a></li>

                    </ul>
                </div>

            </div>

    </nav>
    <!-- /NAVIGATION -->

    <!-- WRAPPER -->
    <div class="wrapper">

        <!-- SERVICES -->
        <section class="module">

            <div class="container">

                <!-- MODULE TITLE -->
                <div class="row">

                    <div class="col-sm-12">
                        <h3>決済情報を入力する</h3>

<form method="post" action="index">
<table class="table table-bordered table-generated">
  <tbody><tr>
    <th class="col-md-2">担当者名</th><td class="col-md-11"><?=$nowallname;?></td>
  </tr>
  <tr>
    <th class="col-md-2">お名前</th><td class="col-md-11"><?=$name;?>様</td>
  </tr>
  <tr>
    <th class="col-md-2">メールアドレス</th><td class="col-md-11"><?=$email;?></td>
  </tr>
  <tr>
    <th class="col-md-2">決済金額</th><td class="col-md-11"><?=number_format($amount)."円 (";
                                if(empty($day)) echo "今月のみ)";
                                else echo "毎月".$day."日)";?></td>
  </tr>
  <tr>
    <th class="col-md-2">決済内容</th><td class="col-md-11"><?=$summary;?></td>
  </tr>
  <tr>
    <th class="col-md-2">カード情報</th>
    <td class="col-md-11">
  <script src="https://checkout.webpay.jp/v3/" class="webpay-button" data-key="test_public_cKKcPY89vgl2ba03eD0zAgix" data-lang="ja" data-partial="true"></script>
      (※入力されたカード情報は、WebPayのシステムを通じて安全に送信されます)
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <input type="checkbox" name="agree" value="1" required=""> 上記決済内容を確認した上で支払いを行います。<br>
      <input type="submit" value="決済を実行する" class="btn btn-success">
    </td>
  </tr>
</tbody></table>

<input type="hidden" name="nowallname" value=<?=$nowallname; ?>>
<input type="hidden" name="name" value=<?=$name; ?>>
<input type="hidden" name="email" value=<?=$email; ?>>
<input type="hidden" name="summary" value=<?=$summary; ?>>
<input type="hidden" name="amount" value=<?=$amount; ?>>
<input type="hidden" name="day" value=<?=$day; ?>>
<input type="hidden" name="key" value=<?=$key; ?>>

</form>
                    </div>

                </div>
                <!-- /MODULE TITLE -->


            </div>

        </section>
        <!-- /SERVICES -->

    </div>

    <!-- WRAPPER -->
    <div class="wrapper">

        <!-- CONTACT -->
        <section class="module-small">

            <div class="container">

                <div class="row">

                    <!-- CONTENT BOX -->
                    <div class="col-xs-6">
                        <div class="content-box">
                            <div class="content-box-title font-inc">
                                <p class="m-b-0">株式会社NOWALL</p>
                            </div>
                            <p>
                                <a href="http://nowall.co.jp/" target="_blank">会社概要</a>
                                <a href="http://nowall.co.jp/legal" target="_blank">特定商取引法に基づく表示</a>
                            </p>
                        </div>
                    </div>
                    <!-- /CONTENT BOX -->

                    <!-- CONTENT BOX -->
                    <div class="col-xs-6">
                        <p class="m-b-0" style="font-size: 1.5em">アクセス</p>
                        <p class="m-b-0" style="font-size: 1.5em">〒160-0023 東京都新宿区西新宿6丁目10番1号 セントラルパークタワー ラ・トゥール新宿 6階</p>
                    </div>
                    <!-- /CONTENT BOX -->
                </div>

            </div>

        </section>
        <!-- /CONTACT -->

        <!-- FOOTER -->
        <footer class="footer">

            <div class="container">

                <div class="row">

                    <div class="col-sm-12 text-center">
                        <p class="copyright font-inc m-b-0">© 2015 <a href="http://nowall.co.jp/" target="_blank">NOWALL, Inc.</a> All Rights Reserved.</p>
                    </div>

                </div>

            </div>

        </footer>
        <!-- /FOOTER -->

    </div>
    <!-- /WRAPPER -->