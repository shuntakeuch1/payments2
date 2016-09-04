<div class="mainbar">
    <!-- WRAPPER -->
    <div class="wrapper">
        <!-- SERVICES -->
        <section class="module">
            <div class="container">

                <!-- MODULE TITLE -->
                <div class="row">
                    <div class="col-md-12">

                        <h3 class="h3title">入金情報</h3>
                        <div>
                        <ul class="list-group">
                        <?php foreach($every_month as $month ):?>

                        <li class="list-group-item">
                            売上:<?=number_format($month);?>円/手数料
                        </li>
                        <?php endforeach ;?>
                        </ul>
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