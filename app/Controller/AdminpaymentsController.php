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

    public function customers() {
        $this->layout = 'adminLayout';

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
}
