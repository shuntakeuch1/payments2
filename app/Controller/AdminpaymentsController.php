<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

require VENDORS . 'autoload.php';
use WebPay\WebPay;

class AdminpaymentsController extends AppController {

    public $helpers = array('Paginator');

    public $components = array('Paginator');

    public $uses = array('User', 'CardHash', 'Charge', 'Recursion', 'Item', 'Refund');

    public function beforeFilter() {
        parent::beforeFilter();

        $log_arr = array(
            "charge.succeeded" => "課金に成功しました",
            "charge.failed" => "課金に失敗しました",
            "charge.refunded" => "課金が払い戻されました",
            "charge.captured" => "課金の仮売上が実売上化されました",
            "customer.created" => "顧客が作成されました",
            "customer.updated" => "顧客が更新されました",
            "customer.deleted" => "顧客が削除されました",
            "recursion.created" => "定期課金が作成されました",
            "recursion.succeeded" => "定期課金に成功しました",
            "recursion.failed" => "定期課金が失敗しました",
            "recursion.resumed" => "定期課金が再開されました",
            "recursion.deleted" => "定期課金が削除されました",
            "account.application.deauthorized" => "アプリケーションの認可を取り消しました",
            "ping" => "テストのイベントを発行しました"
        );
        $this->set('log_arr', $log_arr);

        $awesome_arr = array(
            "dashboard" => "<i class=\"fa fa-line-chart\"></i>",
            "charge" => "<i class=\"fa fa-credit-card\"></i>",
            "customer" => "<i class=\"fa fa-users\"></i>",
            "recursion" => "<i class=\"fa fa-calendar\"></i>",
            "event" => "<i class=\"fa fa-rss\"></i>",
            "account" => "<i class=\"fa fa-user-plus\"></i>",
            // "account.application.deauthorized" => "<i class=\"fa fa-未定\"></i>",
            "ping" => "<i class=\"fa fa-cog\"></i>",
            "pub_payment" => "<i class=\"fa fa-pencil-square-o\"></i>",
            "item" => "<i class=\"fa fa-folder-open-o\"></i>",
            "fee" => "<i class=\"fa fa-database\"></i>",
        );
        $this->set('awesome_arr', $awesome_arr);

        $transactionType = array(
            "payment" => "支払い",
            "refund" => "払い戻し",
        );
        $this->set('transactionType', $transactionType);

    }

    public function dashboard() {
        $this->layout = 'adminLayout';
        $this->set('title_for_layout','ダッシュボード | ELITES');

        $webpay = new WebPay($this->secret_key);
        $webpay->setAcceptLanguage('ja');

        // 最近追加された課金
        $charges = $webpay->charge->all(array("count"=>3));
        $this->set('charges', $charges->data);
        // 顧客名をDB検索
        $charge_names = array();
        foreach($charges->data as $charge){
            $params = array(
                'conditions' => array(
                    'customer_id' => $charge->customer
                    )
                );
            $customer = $this->User->find('first', $params);
            array_push($charge_names, $customer['User']['name']);
        }
        $this->set('charge_names', $charge_names);


        // 最近追加された顧客
        $customers = $webpay->customer->all(array("count"=>3));
        $this->set('customers', $customers->data);
        // 顧客名をDB検索
        $customer_names = array();
        foreach($customers->data as $customer){
            $params = array(
                'conditions' => array(
                    'customer_id' => $customer->id
                    )
                );
            $customer = $this->User->find('first', $params);
            array_push($customer_names, $customer['User']['name']);
        }
        $this->set('customer_names', $customer_names);


        // 最近発生したイベント
        $events = $webpay->event->all(array("count"=>3));
        $this->set('events', $events->data);


        // 今月の売上金額・今月のトランザクション数・グラフ表示用データ
        $offset = 0;
        $amount_count = 0;
        $transaction_count = 0;
        $first_day = strtotime( "first day of ". date("Y-m-01", time())); // 今月の月初め
        $last_month_day = strtotime( "first day of - 1 month". date("Y-m-01", time())); // 先月の月初め
        $amount_t_arr = array_pad($amount_t_arr = array(), 31, 0); // 今月の売上金額
        $amount_l_arr = array_pad($amount_l_arr = array(), 31, 0); // 先月の売上金額
        $transaction_t_arr = array_pad($transaction_t_arr = array(), 31, 0); // 今月のトランザクション数
        $transaction_l_arr = array_pad($transaction_l_arr = array(), 31, 0); // 先月のトランザクション数
        while(1) {
            // 払い戻しは90日前まで可能 90 + 1ヶ月31日 = 121日
            // 一度に最大100件まで取得可能
            $tmps = $webpay->charge->all(array("count"=>100, "offset"=>$offset, "created" => array("gte" => strtotime("-121 day"))));

            if(empty($tmps->data[0])) break;

            else {
                $offset = $offset + 100;

                foreach($tmps->data as $tmp){

                    // 今月の課金額
                    if($tmp->created >= $first_day) {
                        $amount_count = $amount_count + $tmp->amount;

                        $amount_t_arr[date("j", $tmp->created)-1] = $amount_t_arr[date("j", $tmp->created)-1] + $tmp->amount;
                    }
                    // 先月の課金額
                    elseif($tmp->created >= $last_month_day) {
                        $amount_l_arr[date("j", $tmp->created)-1] = $amount_l_arr[date("j", $tmp->created)-1] + $tmp->amount;
                    }

                    // トランザクション数:手数料の足し引きが発生した数で計算
                    foreach($tmp->fees as $fee){
                        // 今月のトランザクション数
                        if($fee->created >= $first_day) {
                            $transaction_count = $transaction_count + 1;

                            $transaction_t_arr[date("j", $fee->created)-1] = $transaction_t_arr[date("j", $fee->created)-1] + 1;
                        }
                        // 先月のトランザクション数
                        elseif($fee->created >= $last_month_day) {
                            $transaction_l_arr[date("j", $fee->created)-1] = $transaction_l_arr[date("j", $fee->created)-1] + 1;
                        }
                    }
                }
            }
        }

        // 今月の払い戻し額の総和
        $amountRefunded_count = 0;
        $this->Refund->recursive = -1;
        $params = array(
            'conditions' => array(
                'created >=' => date('Y-m-d H:i:s', $last_month_day)
                )
            );
        $refund_database = $this->Refund->find('all', $params);

        if(empty($refund_database)) {
            die(データベースエラー);
        }
        else {
            foreach($refund_database as $refund_data){
                // 今月の払い戻し額
                if(strtotime($refund_data['Refund']['created']) >= $first_day) {
                    $amountRefunded_count = $amountRefunded_count + $refund_data['Refund']['amount_refunded'];
                    $amount_t_arr[date("j", strtotime($refund_data['Refund']['created']))-1] = $amount_t_arr[date("j", strtotime($refund_data['Refund']['created']))-1] - $refund_data['Refund']['amount_refunded'];
                }
                // 先月の払い戻し額
                elseif(strtotime($refund_data['Refund']['created']) >= $last_month_day) {
                    $amount_l_arr[date("j", strtotime($refund_data['Refund']['created']))-1] = $amount_l_arr[date("j", strtotime($refund_data['Refund']['created']))-1] - $refund_data['Refund']['amount_refunded'];
                }

            }
        }

        $this->set('amount_t_arr', $amount_t_arr);
        $this->set('amount_l_arr', $amount_l_arr);
        $this->set('transaction_t_arr', $transaction_t_arr);
        $this->set('transaction_l_arr', $transaction_l_arr);


        // グラフオプション用
        // 課金額
        $amount_max = max(max($amount_t_arr), max($amount_l_arr), 0); // 課金額の最大値
        $amount_min = min(min($amount_t_arr), min($amount_l_arr), 0); // 課金額の最小値
        $amount_strlen = max(strlen($amount_max), strlen($amount_min)); // 桁数の最大値
        $amount_max_round = round($amount_max + 5*pow(10, ($amount_strlen-2)), -($amount_strlen-1)); // 目盛りの最大値

        // 目盛りの最小値
        if($amount_min>=0) $amount_min_round = 0;
        else $amount_min_round = round($amount_min - 5*pow(10, ($amount_strlen-2)), -($amount_strlen-1));

        $scaleSteps_c = (abs($amount_max_round) + abs($amount_min_round)) / pow(10, strlen(abs($amount_max_round) + abs($amount_min_round))-1);
        $scaleStepWidth_c = ($amount_max_round - $amount_min_round) / $scaleSteps_c;
        $scaleStartValue_c = $amount_min_round;

        $this->set('scaleSteps_c', $scaleSteps_c);
        $this->set('scaleStepWidth_c', $scaleStepWidth_c);
        $this->set('scaleStartValue_c', $scaleStartValue_c);

        // トランザクション数
        $transaction_max = max(max($transaction_t_arr), max($transaction_l_arr), 0); // トランザクション数の最大値
        $transaction_min = min(min($transaction_t_arr), min($transaction_l_arr), 0); // トランザクション数の最小値
        $transaction_strlen = max(strlen($transaction_max), strlen($transaction_min)); // 桁数の最大値
        $transaction_max_round = round($transaction_max + 5*pow(10, ($transaction_strlen-2)), -($transaction_strlen-1)); // 目盛りの最大値
        $transaction_min_round = 0; // 目盛りの最小値

        $scaleSteps_t = (abs($transaction_max_round) + abs($transaction_min_round)) / pow(10, strlen(abs($transaction_max_round) + abs($transaction_min_round))-1);
        $scaleStepWidth_t = ($transaction_max_round - $transaction_min_round) / $scaleSteps_t;
        $scaleStartValue_t = $transaction_min_round;

        $this->set('scaleSteps_t', $scaleSteps_t);
        $this->set('scaleStepWidth_t', $scaleStepWidth_t);
        $this->set('scaleStartValue_t', $scaleStartValue_t);


        // 今月の売上金額:課金額の総和 - 払戻額の総和
        $amount_count = $amount_count - $amountRefunded_count;
        $this->set('amount_count', $amount_count);
        $this->set('transaction_count', $transaction_count);

        // 現在の顧客数
        $customer_count = $this->User->find('count');
        $this->set('customer_count', $customer_count);
    }

    public function charges() {

        $this->layout = 'adminLayout';

        if(empty($this->params['pass'][0])) {
            $this->set('title_for_layout','課金の履歴 | ELITES');

            if(empty($this->params['url']['page']))$page=1;
            else $page = $this->params['url']['page'];

            $this->set('page', $page);

            $count=10;
            if(empty($page)) $offset=0;
            else $offset=$count*($page-1);

            $webpay = new WebPay($this->secret_key);
            $webpay->setAcceptLanguage('ja');
            $charges = $webpay->charge->all(array("count"=>$count, "offset"=>$offset));
            $this->set('charges', $charges->data);

            $charges_next = $webpay->charge->all(array("count"=>1, "offset"=>$offset+$count));
            if(empty($charges_next->data[0])) $next_flg=0;
            else $next_flg=1;
            $this->set('next_flg', $next_flg);

            // 顧客名をDB検索
            $names = array();
            foreach($charges->data as $charge){
                $params = array(
                    'conditions' => array(
                        'customer_id' => $charge->customer
                        )
                    );
                $customer = $this->User->find('first', $params);
                array_push($names, $customer['User']['name']);
            }
            $this->set('names', $names);
        }
        else {
            $this->set('title_for_layout','個別課金の詳細 | ELITES');

            $webpay = new WebPay($this->secret_key);
            $webpay->setAcceptLanguage('ja');

            $charges_detail = $webpay->charge->retrieve($this->params['pass'][0]);
            $this->set('charges_detail', $charges_detail);

            $customer_detail = $webpay->customer->retrieve($charges_detail->customer);
            $this->set('customer_detail', $customer_detail);

            if($charges_detail->recursion){
                $recursion_detail = $webpay->recursion->retrieve($charges_detail->recursion);
                $this->set('recursion_detail', $recursion_detail);
            }

            // 顧客名をDB検索
            $params = array(
                'conditions' => array(
                'customer_id' => $charges_detail->customer
                )
            );
            $customer = $this->User->find('first', $params);
            $this->set('customer', $customer['User']);

            if($charges_detail->refunded) $this->set('paid', "<span class=\"badge badge-info\">払戻済</span>");
            elseif($charges_detail->amountRefunded > 0) $this->set('paid', "<span class=\"badge badge-warning\">一部払戻済</span>");
            elseif($charges_detail->captured) $this->set('paid', "<span class=\"badge badge-success\">支払済</span>");
            else $this->set('paid', "<span class=\"badge badge-important\">未払い</span>");

            if(empty($this->params['pass'][1]) || $this->params['pass'][1]!="edit") $this->set('edit_flg', false);
            else $this->set('edit_flg', true);


            // 払い戻し処理
            $this->set('amount_refunded_error', false);
            if ($this->request->is('post') && $this->params['pass'][1]=="refund") {

                // 払い戻し額が範囲内の時
                if(ctype_digit($this->request->data['Refund']['amount_refunded']) && $this->request->data['Refund']['amount_refunded'] >0 && $this->request->data['Refund']['amount_refunded'] <= $charges_detail->amount - $charges_detail->amount_refunded) {

                    try {
                        $charges_detail = $webpay->charge->refund(array(
                            'id' => $this->params['pass'][0],
                            'amount' => $this->request->data['Refund']['amount_refunded']));

                        // RefundsテーブルへのDB登録
                        $refund_savedata = array(
                            'user_id' => $customer['User']['id'],
                            'charge_id' => $this->params['pass'][0],
                            'amount_refunded' => $this->request->data['Refund']['amount_refunded']
                        );

                        $this->Refund->save($refund_savedata);

                        $this->redirect(array('action' => 'charges',$charges_detail->id));
                    }
                    catch (\WebPay\ErrorResponse\InvalidRequestException $e) {
                        $this->set('webpay_error', $e);
                    }
                }
                else {
                    // 払い戻し額がおかしい時
                    $amount_refunded_error = true;
                    $this->set('amount_refunded_error', true);
                }

                $this->set('refund_flg', true);
            }
            else {
                $this->set('refund_flg', false);
            }

            $this->render("charges_detail");
        }
    }

    public function customers() {
        $this->layout = 'adminLayout';

        if(empty($this->params['pass'][0])) {
            $this->set('title_for_layout','顧客の一覧 | ELITES');

            if(empty($this->params['url']['page']))$page=1;
            else $page = $this->params['url']['page'];

            $this->set('page', $page);

            $count=10;
            if(empty($page)) $offset=0;
            else $offset=$count*($page-1);

            $webpay = new WebPay($this->secret_key);
            $webpay->setAcceptLanguage('ja');
            $customers = $webpay->customer->all(array("count"=>$count, "offset"=>$offset));
            $this->set('customers', $customers->data);

            $customers_next = $webpay->customer->all(array("count"=>1, "offset"=>$offset+$count));
            if(empty($customers_next->data[0])) $next_flg=0;
            else $next_flg=1;
            $this->set('next_flg', $next_flg);

            // 顧客名をDB検索
            $names = array();
            foreach($customers->data as $customer){
                $params = array(
                    'conditions' => array(
                        'customer_id' => $customer->id
                        )
                    );
                $customer = $this->User->find('first', $params);
                array_push($names, $customer['User']['name']);
            }
            $this->set('names', $names);
        }
        else {
            $this->set('title_for_layout','顧客の詳細 | ELITES');

            $webpay = new WebPay($this->secret_key);
            $webpay->setAcceptLanguage('ja');
            $customers_detail = $webpay->customer->retrieve($this->params['pass'][0]);

            $this->set('customers_detail', $customers_detail);

            $customers_charges = $webpay->charge->all(array("customer"=>$this->params['pass'][0]));
            $this->set('customers_charges', $customers_charges->data);

            // 顧客名をDB検索
            $params = array(
                'conditions' => array(
                    'customer_id' => $customers_detail->id
                )
            );
            $customer = $this->User->find('first', $params);
            $this->set('customer', $customer['User']);

            $this->render("customers_detail");
        }
    }

    public function events() {
        $this->layout = 'adminLayout';

        if(empty($this->params['pass'][0])) {
            $this->set('title_for_layout','イベントログ | ELITES');

            $webpay = new WebPay($this->secret_key);
            $webpay->setAcceptLanguage('ja');

            // 全件数:負荷がかかりそうなので中止
            // $count_offset = 0;
            // $all_count = 0;
            // while(1) {
            //     $tmps = $webpay->event->all(array("count"=>100, "offset"=>$count_offset));

            //     $all_count = $all_count + count($tmps->data);

            //     if(empty($tmps->data[0])) break;
            //     else $count_offset = $count_offset + 100;
            // }

            if(empty($this->params['url']['page']))$page=1;
            else $page = $this->params['url']['page'];

            $this->set('page', $page);

            $count=10;
            if(empty($page)) $offset=0;
            else $offset=$count*($page-1);

            $events = $webpay->event->all(array("count"=>$count, "offset"=>$offset));
            $this->set('events', $events->data);

            $events_next = $webpay->event->all(array("count"=>1, "offset"=>$offset+$count));
            if(empty($events_next->data[0])) $next_flg=0;
            else $next_flg=1;
            $this->set('next_flg', $next_flg);
        }
        else {
            $this->set('title_for_layout','イベントの詳細 | ELITES');

            $webpay = new WebPay($this->secret_key);
            $webpay->setAcceptLanguage('ja');
            $events_detail = $webpay->event->retrieve($this->params['pass'][0]);

            $this->set('events_detail', $events_detail);

            $types = array(
                "charge.succeeded",
                "charge.failed",
                "charge.refunded",
                "charge.captured",
                "customer.created",
                "customer.updated",
                "recursion.created",
                "recursion.succeeded",
                "recursion.failed",
                "recursion.resumed",
                "recursion.deleted",
            );

            $type_flg = false;

            foreach ($types as $type) {
                if ($events_detail->type == $type) {
                    $type_flg = true;
                }
            }

            $this->set('type_flg', $type_flg);

            if(stripos($events_detail->type, "charge") !== false) $this->set('type', "charge");
            elseif(stripos($events_detail->type, "customer") !== false) $this->set('type', "customer");
            elseif(stripos($events_detail->type, "recursion") !== false) $this->set('type', "recursion");
            else $this->set('type', "others");

            $this->render("events_detail");
        }
    }
}
