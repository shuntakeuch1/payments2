<?php

require VENDORS . 'autoload.php';

// require_once "webpay-php-full-2.2.2/autoload.php";
// use WebPay\WebPay;
// require "/var/www/html/payments/vendors/autoload.php";
// use WebPay\WebPay;

// App::items('AppController','Controller');
class ItemsController extends AppController
{
  public $name = 'Items';
  public $uses = array('Item','User','Charge','CardHash');
  public $helpers = array('Paginator','Html','Form');
  public $components = array('Session','Paginator','Cookie');

  public function index()
  {
    $this->set('maxitem',$this->Item->find('count','all'));
    $p_limit = 5;
    $this->set('p_limit',$p_limit);
    $this->autoLayout = false;  // レイアウトをOFFにする
    $this->Paginator->settings = array(
        'limit' => $p_limit,
        'order' => array('created' => 'desc'),
        'recusive' =>3
      );
    $this->set('items',$this->paginate());
    // $this->set('items',$this->Item->find('all'));
  }

  public function id($cha_rec_id)
  {
    $this->autoLayout = false;  // レイアウトをOFFにする
    $this->set('items',$this->Item->findByCha_rec_id($cha_rec_id));
  }

  public function purchased()
  {
    if($this->request->is('post'))
    {
      debug($this->User->set($this->request->data));
      // debug($this->request->data);
      if($this->User->validates()){
    // API リクエスト
    try {
          // $webpay = new WebPay('test_secret_cDu1Jtaxzaph6NMemY1SC1UF');
          $webpay = new WebPay('test_secret_3Rn1BM2o8gtY8Dq1xPaVh6kl');
          //エラー日本語化
          $webpay->setAcceptLanguage('ja');
          //取得したdataの定義


          $nowall_name = $this->request->data['nowall_name'];
          $name = $this->request->data['name'];
          $amount = $this->request->data['amount'];
          $email = $this->request->data['email'];
          $token = $this->request->data['webpay-token'];
          $description = $this->request->data['description'];
          //emailあるか確認 なかったらcutomer_id作成
          $finger_tmp = $webpay->token->retrieve($token);
          $finger_tmp = $finger_tmp->card->fingerprint;
          //カード情報もチェック
          $emailcount = $this->User->find('count',array(
                                          'conditions' => array(
                                                'email' => $email,
                                                'fingerprint' => $finger_tmp
                                                )
                                          )
          );

          if($emailcount==0)
          {
            //顧客生成
            $customers = $webpay->customer->create(array("card"=>$token,"email"=>$email));
            $customer_id = $customers->id;
            //users_id生成
            $this->User->save(['email'=>$email,'customer_id'=>$customer_id,'name'=>$name]);
            //users_id取得
            $customer = $this->User->findByEmail($email);
            $user_id = $customer['User']['id'];
            //card_hash保存
            $fingerprint = $customers->activeCard->fingerprint;
            $this->CardHash->save(['user_id'=>$user_id,'fingerprint'=>$fingerprint]);
          }else{
            //customer_idと課金のひも付け
            $customer = $this->User->findByEmail($email);
            debug($customer);
            $customer_id = $customer['User']['customer_id'];
            $user_id = $customer['User']['id'];
          };
          // 課金処理
          $charge_id = $webpay->charge->create(array(
          "amount"=>$amount,
          "currency"=>"jpy",
          "customer"=>$customer_id,
          "description"=>$description
            ));
          //課金idの保存
          $charge_id = $charge_id->id;
          $this->Charge->save(['user_id'=>$user_id,'charge_id'=>$charge_id,'amount'=>$amount]);

    } catch (\WebPay\ErrorResponse\ErrorResponseException $e) {
        $error = $e->data->error;
        switch ($error->causedBy) {
            case 'buyer':
                // カードエラーなど、購入者に原因がある
                // エラーメッセージをそのまま表示するのがわかりやすい
                $this->Session->write(array('err_message'=>$error->message,'nowall_name'=>$nowall_name));
                break;
            case 'insufficient':
                // 実装ミスに起因する
                $this->Session->write('err_message',$error->message);
                break;
            case 'missing':
                // リクエスト対象のオブジェクトが存在しない
                $this->Session->write('err_message',$error->message);
                break;
            case 'service':
                // WebPayに起因するエラー
                $this->Session->write('err_message',$error->message);
                break;
            default:
                // 未知のエラー
                $this->Session->write('err_message',$error->message);
                break;
        }
        //申込失敗画面へ
        $this->redirect(array('controller'=>'error','action'=>'index'));
    } catch (\WebPay\ApiException $e) {
        // APIからのレスポンスが受け取れない場合。接続エラーなど
      exit;
        $this->Session->write('err_message',$error->message);
        $this->redirect(array('controller'=>'error','action'=>'index'));
    } catch (\Exception $e) {
        // WebPayとは関係ない例外の場合
        $this->Session->write('err_message',$error->message);
        $this->redirect(array('controller'=>'error','action'=>'index'));
    }
      //成功画面へ
      $this->Session->write(
        array('email'=> $email,
          'name'=>$name,
          'amount'=>$amount,
          'description'=>$description));
      $this->redirect(array('controller'=>'purchased','action'=>'index'));
    }
    }
  }

}