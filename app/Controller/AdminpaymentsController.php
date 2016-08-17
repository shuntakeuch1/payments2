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

        $webpay = new WebPay('test_secret_2NKghr1KT4pPccIahLfvd4Sk');
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


        // 今月の売上金額・今月のトランザクション数
        $offset = 0;
        $amount_count = 0;
        $transaction_count = 0;
        $first_day = strtotime( "first day of ". date("Y-m-01", time())); // 月初め
        while(1) {
            // 払い戻しは90日前まで可能 90 + 1ヶ月31日 = 121日
            // 一度に最大100件まで取得可能
            $tmps = $webpay->charge->all(array("count"=>100, "offset"=>$offset, "created" => array("gte" => strtotime("-121 day"))));

            if(empty($tmps->data[0])) break;

            else {
                $offset = $offset + 100;

                foreach($tmps->data as $tmp){

                    // 今月の課金額の総和
                    if($tmp->created >= $first_day) $amount_count = $amount_count + $tmp->amount;

                    // トランザクション数:手数料の足し引きが発生した数で計算
                    foreach($tmp->fees as $fee){
                        if($fee->created >= $first_day) $transaction_count = $transaction_count + 1;
                    }
                }
            }
        }

        // 今月の払い戻し額の総和
        $amountRefunded_count = 0;
        $this->Refund->recursive = -1;
        $params = array(
            'conditions' => array(
                'created >=' => date('Y-m-d H:i:s', $first_day)
                )
            );
        $refund_database = $this->Refund->find('all', $params);

        if(empty($refund_database)) {
            die(データベースエラー);
        }
        else {
            foreach($refund_database as $refund_data){
                $amountRefunded_count = $amountRefunded_count + $refund_data['Refund']['amount_refunded'];
            }
        }

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

            if(empty($this->params['url']['page']))$page=1;
            else $page = $this->params['url']['page'];

            $this->set('page', $page);

            $count=10;
            if(empty($page)) $offset=0;
            else $offset=$count*($page-1);

            $webpay = new WebPay('test_secret_2NKghr1KT4pPccIahLfvd4Sk');
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
            $webpay = new WebPay('test_secret_2NKghr1KT4pPccIahLfvd4Sk');
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

            if($charges_detail->refunded) $this->set('paid', "払い戻し済み");
            elseif($charges_detail->amountRefunded > 0) $this->set('paid', "一部払い戻し済み");
            elseif($charges_detail->captured) $this->set('paid', "支払い済み");
            else $this->set('paid', "未払い");

            if(empty($this->params['pass'][1]) || $this->params['pass'][1]!="edit") $this->set('edit_flg', false);
            else $this->set('edit_flg', true);


            // 払い戻し処理
            $this->set('amount_refunded_error', false);
            if ($this->request->is('post') && $this->params['pass'][1]=="refund") {

                // 払い戻し額が範囲内の時
                if(ctype_digit($this->request->data['Refund']['amount_refunded']) && $this->request->data['Refund']['amount_refunded'] >0 && $this->request->data['Refund']['amount_refunded'] <= $charges_detail->amount - $charges_detail->amount_refunded) {

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

            if(empty($this->params['url']['page']))$page=1;
            else $page = $this->params['url']['page'];

            $this->set('page', $page);

            $count=10;
            if(empty($page)) $offset=0;
            else $offset=$count*($page-1);

            $webpay = new WebPay('test_secret_2NKghr1KT4pPccIahLfvd4Sk');
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
            $webpay = new WebPay('test_secret_2NKghr1KT4pPccIahLfvd4Sk');
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

            $webpay = new WebPay('test_secret_2NKghr1KT4pPccIahLfvd4Sk');
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
            $webpay = new WebPay('test_secret_2NKghr1KT4pPccIahLfvd4Sk');
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
            else if(stripos($events_detail->type, "customer") !== false) $this->set('type', "customer");
            else if(stripos($events_detail->type, "recursion") !== false) $this->set('type', "recursion");
            else $this->set('type', "others");

            $this->render("events_detail");
        }
    }
}
