<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

require VENDORS . 'autoload.php';
use WebPay\WebPay;

class AdminpaymentsController extends AppController {

    public $helpers = array('Paginator');

    public $components = array('Paginator');

    public $uses = array('User', 'CardHash', 'Charge', 'Recursion', 'Item');

    public function beforeFilter() {
        parent::beforeFilter();

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

            // 顧客名をDB検索
            $params = array(
                'conditions' => array(
                'customer_id' => $charges_detail->customer
                )
            );
            $customer = $this->User->find('first', $params);
            $this->set('customer', $customer['User']);

            if($charges_detail->paid) $this->set('paid', "支払い済み");
            else $this->set('paid', "未払い");

            if($charges_detail->fees[0]->transactionType == 'payment') $this->set('transactionType', "支払い済み");
            else $this->set('transactionType', "未払い");

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

            // if($customers_detail->paid) $this->set('paid', "支払い済み");
            // else $this->set('paid', "未払い");

            // if($customers_detail->fees[0]->transactionType == 'payment') $this->set('transactionType', "支払い済み");
            // else $this->set('transactionType', "未払い");

            $this->render("customers_detail");
        }
    }

    public function events() {
        $this->layout = 'adminLayout';

        if(empty($this->params['url']['page']))$page=1;
        else $page = $this->params['url']['page'];

        $this->set('page', $page);

        $count=10;
        if(empty($page)) $offset=0;
        else $offset=$count*($page-1);

        $webpay = new WebPay('test_secret_2NKghr1KT4pPccIahLfvd4Sk');
        $webpay->setAcceptLanguage('ja');
        $events = $webpay->event->all(array("count"=>$count, "offset"=>$offset));
        $this->set('events', $events->data);

        $events_next = $webpay->event->all(array("count"=>1, "offset"=>$offset+$count));
        if(empty($events_next->data[0])) $next_flg=0;
        else $next_flg=1;
        $this->set('next_flg', $next_flg);

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
    }
}
