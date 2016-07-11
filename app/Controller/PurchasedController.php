<?php

App::uses('CakeEmail', 'Network/Email');
class PurchasedController extends AppController
{
  public $components = array('Session','Paginator','Cookie');

  public function index()
  {
    $this->autoLayout = false;  // レイアウトをOFFにする
    $email_addr = $this->Session->read('email');
    $name = $this->Session->read('name');
    $amount = $this->Session->read('amount');
    $description = $this->Session->read('description');
    $this->Session->delete(array('email','name','amount','description'));

    //読み込む設定ファイルの変数名を指定
    $email = new CakeEmail('default');
    $email->from(array('test@example.com'=>'NoWall '));
    $email->to($email_addr);
    $email->subject('決済が完了しました。');
    //メール送信する
    $email->send($name. "様\n\nお世話になっております。\nELITES事務局です。\n\n以下の内容で決済しました。\n\n決済金額:".number_format($amount)."円\n決済内容:".$description."\n\nまた本メールは自動送信のため、返信しないようお願いします。");

    // $res = $email->config(array('log' => 'emails'))
    //                ->from(array('test@example.com' => 'test'))
    //                ->to(array($email_addr)
    //                ->subject('決済URL通知メール')
    //                ->send($this->emailcontent_url($this->request->data['Admin']['name'],$url));

    //   $res = $email->config(array('log' => 'emails'))
    //                ->from(array('test@example.com' => 'test'))
    //                ->to($this->request->data['Admin']['email'])
    //                ->subject('ID/PW通知メール')
    //                ->send($this->emailcontent_idpw($this->request->data['Admin']['name']));


  }

}