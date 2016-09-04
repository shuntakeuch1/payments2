<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

// require VENDORS . 'autoload.php';
// use WebPay\WebPay;
require_once "webpay-php-full-2.2.2/autoload.php";
use WebPay\WebPay;

class BillingController extends AppController {
  public $name = 'Billing';
  public $uses = array('Charges');
  public $helpers = array('Paginator','Html','Form');
  public $components = array('Session','Paginator','Cookie');

  public function index() {
    $this->layout = 'adminLayout';
    $this->set('title_for_layout','入金情報 | ELITES');

    $webpay = new WebPay($this->secret_key);
    $webpay->setAcceptLanguage('ja');

    $charges = $webpay->charge->all();
    $this->set('charges', $charges->data);
      foreach ($charges->data as $charge){
        $data = date("Y/m ",$charge->created);
        //連想配列が空かチェック、年/月ごとに集計
        if(empty($every_month[$data])){
          $every_month[$data] = $charge->amount ;
        }else{
          $every_month[$data] = $every_month[$data] + $charge->amount ;
        }
      }
      $this->set('every_month',$every_month);
      debug($every_month);
  }

}