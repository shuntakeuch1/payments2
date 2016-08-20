            // 課金情報
            var lineChartData_c = {
                labels : ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15',
                                   '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],

                // labels : ['1', '', '3', '', '5', '', '7', '', '9', '', '11', '', '13', '', '15',
                //          '', '17', '', '19', '', '21', '', '23', '', '25', '', '27', '', '29', '', '31'],

                datasets : [
                    {
                        label: "今月",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",

                        data : amount_t_arr
                    },
                    {
                        label: "先月",
                        fillColor: "rgba(220,220,220,0.2)",
                        strokeColor: "rgba(220,220,220,1)",
                        pointColor: "rgba(220,220,220,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",

                        data : amount_l_arr
                    },
                ]
            }

            // オプション
            var options_c = {
                // X, Y 軸ラインが棒グラフの値の上にかぶさるようにするか
                scaleOverlay : true,
                // 値の開始値などを自分で設定するか
                scaleOverride : true,

                // 以下の 3 オプションは scaleOverride: true の時に使用
                // Y 軸の値のステップ数
                // e.g. 10 なら Y 軸の値は 10 個表示される
                scaleSteps : scaleSteps_c,
                // Y 軸の値のステップする大きさ
                // e.g. 10 なら 0, 10, 20, 30 のように増えていく
                scaleStepWidth : scaleStepWidth_c,
                // Y 軸の値の始まりの値
                scaleStartValue : scaleStartValue_c,
                // X, Y 軸ラインの色
                scaleLineColor : "rgba(0, 0, 0, .1)",
                // X, Y 軸ラインの幅
                scaleLineWidth : 1,
                // ラベルの表示 ( Y 軸の値 )
                scaleShowLabels : true,
                // ラベルの表示フォーマット ( Y 軸の値 )
                scaleLabel: scaleLabel_c,
                multiTooltipTemplate: scaleLabel_c,
                // X, Y 軸値のフォント
                scaleFontFamily : "'Arial'",
                // X, Y 軸値のフォントサイズ
                scaleFontSize : 15,
                // X, Y 軸値のフォントスタイル, normal, italic など
                scaleFontStyle : "italic",
                // X, Y 軸値の文字色
                scaleFontColor : "#666",
                // グリッドライン ( Y 軸の横ライン ) の表示
                scaleShowGridLines : true,
                // グリッドラインの色
                scaleGridLineColor : "rgba(0, 0, 0, .05)",
                // グリッドラインの幅
                scaleGridLineWidth : 1,
                // ラインが曲線 ( true ) か直線 ( false )か
                bezierCurve : true,
                // ポイントの点を表示するか
                pointDot : true,
                // ポイントの点の大きさ
                pointDotRadius : 5,
                // ポイントの点の枠線の幅
                pointDotStrokeWidth : 1,
                // データセットのストロークを表示するか
                // みたいですが、ちょっと変化が分からなかったです
                datasetStroke : true,
                // ラインの幅
                datasetStrokeWidth : 1,
                // ラインの内側を塗りつぶすか
                datasetFill : true,
                // 表示の時のアニメーション
                animation : true,
                // アニメーションの速度 ( ステップ数 )
                animationSteps : 60,
                // アニメーションの種類, 以下が用意されている
                // linear, easeInQuad, easeOutQuad, easeInOutQuad, easeInCubic, easeOutCubic,
                // easeInOutCubic, easeInQuart, easeOutQuart, easeInOutQuart, easeInQuint,
                // easeOutQuint, easeInOutQuint, easeInSine, easeOutSine, easeInOutSine,
                // easeInExpo, easeOutExpo, easeInOutExpo, easeInCirc, easeOutCirc, easeInOutCirc,
                // easeInElastic, easeOutElastic, easeInOutElastic, easeInBack, easeOutBack,
                // easeInOutBack, easeInBounce, easeOutBounce, easeInOutBounce
                animationEasing : "easeOutQuad",
                // アニメーション終了後に実行する処理
                // animation: false の時にも実行されるようです
                // e.g. onAnimationComplete : function() {alert('complete');}
                onAnimationComplete : null,
                responsive:true,
            }



            // トランザクション情報
            var lineChartData_t = {
            labels : ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15',
                       '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],

            // labels : ['1', '', '3', '', '5', '', '7', '', '9', '', '11', '', '13', '', '15',
            //          '', '17', '', '19', '', '21', '', '23', '', '25', '', '27', '', '29', '', '31'],

            datasets : [
                {
                    label: "今月",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",

                    data : transaction_t_arr
                },
                {
                    label: "先月",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",

                    data : transaction_l_arr
                },
            ]}

            // オプション
            var options_t = {
                // X, Y 軸ラインが棒グラフの値の上にかぶさるようにするか
                scaleOverlay : true,
                // 値の開始値などを自分で設定するか
                scaleOverride : true,

                // 以下の 3 オプションは scaleOverride: true の時に使用
                // Y 軸の値のステップ数
                // e.g. 10 なら Y 軸の値は 10 個表示される
                scaleSteps : scaleSteps_t,
                // Y 軸の値のステップする大きさ
                // e.g. 10 なら 0, 10, 20, 30 のように増えていく
                scaleStepWidth : scaleStepWidth_t,
                // Y 軸の値の始まりの値
                scaleStartValue : scaleStartValue_t,
                // X, Y 軸ラインの色
                scaleLineColor : "rgba(0, 0, 0, .1)",
                // X, Y 軸ラインの幅
                scaleLineWidth : 1,
                // ラベルの表示 ( Y 軸の値 )
                scaleShowLabels : true,
                // ラベルの表示フォーマット ( Y 軸の値 )
                scaleLabel: scaleLabel_t,
                multiTooltipTemplate: scaleLabel_t,
                // X, Y 軸値のフォント
                scaleFontFamily : "'Arial'",
                // X, Y 軸値のフォントサイズ
                scaleFontSize : 15,
                // X, Y 軸値のフォントスタイル, normal, italic など
                scaleFontStyle : "italic",
                // X, Y 軸値の文字色
                scaleFontColor : "#666",
                // グリッドライン ( Y 軸の横ライン ) の表示
                scaleShowGridLines : true,
                // グリッドラインの色
                scaleGridLineColor : "rgba(0, 0, 0, .05)",
                // グリッドラインの幅
                scaleGridLineWidth : 1,
                // ラインが曲線 ( true ) か直線 ( false )か
                bezierCurve : true,
                // ポイントの点を表示するか
                pointDot : true,
                // ポイントの点の大きさ
                pointDotRadius : 5,
                // ポイントの点の枠線の幅
                pointDotStrokeWidth : 1,
                // データセットのストロークを表示するか
                // みたいですが、ちょっと変化が分からなかったです
                datasetStroke : true,
                // ラインの幅
                datasetStrokeWidth : 1,
                // ラインの内側を塗りつぶすか
                datasetFill : false,
                // 表示の時のアニメーション
                animation : true,
                // アニメーションの速度 ( ステップ数 )
                animationSteps : 60,
                // アニメーションの種類, 以下が用意されている
                // linear, easeInQuad, easeOutQuad, easeInOutQuad, easeInCubic, easeOutCubic,
                // easeInOutCubic, easeInQuart, easeOutQuart, easeInOutQuart, easeInQuint,
                // easeOutQuint, easeInOutQuint, easeInSine, easeOutSine, easeInOutSine,
                // easeInExpo, easeOutExpo, easeInOutExpo, easeInCirc, easeOutCirc, easeInOutCirc,
                // easeInElastic, easeOutElastic, easeInOutElastic, easeInBack, easeOutBack,
                // easeInOutBack, easeInBounce, easeOutBounce, easeInOutBounce
                animationEasing : "easeOutQuad",
                // アニメーション終了後に実行する処理
                // animation: false の時にも実行されるようです
                // e.g. onAnimationComplete : function() {alert('complete');}
                onAnimationComplete : null,
                responsive:true,
            }

            var chart1 = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData_c, options_c);



$(function(){
    $("#btn-charge").click(function(){
        if($(this).hasClass('btn-chart_invalid'))
        {
            $("#btn-charge").removeClass('btn-chart_invalid');
            $("#btn-charge").addClass('btn-chart_valid');
            $("#btn-transaction").removeClass('btn-chart_valid');
            $("#btn-transaction").addClass('btn-chart_invalid');

            chart1.destroy();

            chart1 = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData_c, options_c);
        }
    });
});

$(function(){
    $("#btn-transaction").click(function(){
        if($(this).hasClass('btn-chart_invalid'))
        {
            $("#btn-transaction").removeClass('btn-chart_invalid');
            $("#btn-transaction").addClass('btn-chart_valid');
            $("#btn-charge").removeClass('btn-chart_valid');
            $("#btn-charge").addClass('btn-chart_invalid');

            chart1.destroy();

            chart1 = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData_t, options_t);
        }
    });
});