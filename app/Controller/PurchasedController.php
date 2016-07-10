<?php

App::uses('CakeEmail', 'Network/Email');
class PurchasedController extends AppController
{
  public $components = array('Session','Paginator','Cookie');

  public function index()
  {
    $this->autoLayout = false;  // レイアウトをOFFにする
    $email = $this->Session->read('email');
    $this->Session->delete('email');
    //読み込む設定ファイルの変数名を指定
    $email = new CakeEmail('default');
    $email->from(array('test@example.com'=>'test'));
    $email->to('takeuchishun89@gmail.com');
    $email->subject('メールタイトル');
    //メール送信する
    $email->send('メール本文');

  }

}