<?php

// App::import('Vendor', 'autoload');
// App::uses('WebPay', 'WebPay');

require "/var/www/html/payments/vendors/autoload.php";
use WebPay\WebPay;

class KeyController extends AppController {

    public $uses = array('User', 'CardHash', 'Charge', 'Recursion');

    //public $components = array('Security');

    public function beforeFilter() {
        parent::beforeFilter();

        // //Basic認証
        // // id
        // $loginId = 'elites';

        // // passwd
        // $loginPassword = 'nowall';

        // $this->Security->validatePost = false;
        // $this->Security->csrfUseOnce = false;
        // $this->Security->csrfExpires = '+1 hour';

        // if (isset($_SERVER['PHP_AUTH_USER'])) {
        //     if (! ($_SERVER['PHP_AUTH_USER'] == $loginId && $_SERVER['PHP_AUTH_PW'] == $loginPassword)) {
        //         $this->basicAuthError();
        //     }
        // } else {
        //     // 失敗したら途中で処理終了
        //     $this->basicAuthError();
        // }//Basic認証END

        switch (true) {
            case !isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']):
            case $_SERVER['PHP_AUTH_USER'] !== 'elites':
            case $_SERVER['PHP_AUTH_PW']   !== 'nowall':
                header('WWW-Authenticate: Basic realm="Please enter your ID and password"');
                header('HTTP/1.0 401 Unauthorized');
                die("Invalid id / password combination.  Please try again");
        }


        if (!$this->request->is('post'))
        {
            // ここから24時間前のルーティングを削除
            $file = '/var/www/html/payments/app/Config/routes.php';

            // ファイルをオープンして既存のコンテンツを取得
            $current = file_get_contents($file);

            // 現在のaction名が24時間を超えていたら他ページに飛ばす
            // action名を取得
            preg_match('/\/key\/(.*?)\?/s', $_SERVER['REQUEST_URI'], $key);
            // 時間を抽出
            preg_match('/^.*'.$key['1'].'.*$/um',$current, $tmp1);

            if(empty($tmp1)) die("URLが間違っているか、発行後24時間経過したため、アクセスできません");

            preg_match_all('/time:(\w+)/s', $tmp1['0'], $tmp1,PREG_SET_ORDER);
            if(time() - $tmp1['0']['1'] > 86400){
                $current = preg_replace('/^.*time:'.$tmp1['0']['1'].'*$/um','',$current);
                $current = preg_replace('/\n\n/',"\n",$current);
                file_put_contents($file, $current);
                die("URLが間違っているか、発行後24時間経過したため、アクセスできません");
            }

            // その他のルーティングについて24時間超えていたら消す
            $current = file_get_contents($file);
            preg_match_all('/time:(\w+)/s', $current, $tmp2,PREG_SET_ORDER);

            foreach($tmp2 as $value)
            {
                // 24時間 = 24*3600 = 86400
                if(time() - $value['1'] > 86400){
                    $current = preg_replace('/^.*time:'.$value['1'].'*$/um','',$current);
                    $current = preg_replace('/\n\n/',"\n",$current);
                }

            }
            file_put_contents($file, $current);
        }
    }

   public function index() {
        $this->layout = 'keyLayout';

        if ($this->request->is('post'))
        {
            // ここからWEBPAY
            try{
                $webpay = new WebPay('test_secret_2NKghr1KT4pPccIahLfvd4Sk');
                $webpay->setAcceptLanguage('ja');

                $token = $webpay->token->retrieve($this->request->data['webpay-token']);

                // ここから顧客登録関連
                // 既に顧客登録しているか
                $params = array(
                    'conditions' => array(
                        'email' => $this->request->data['email'],
                        'fingerprint' => $token->card->fingerprint,
                        )
                    );
                $customer = $this->User->find('first', $params);

                // 新規顧客
                if(empty($customer)){
                    // 同じメールアドレスは登録しているか
                    $params = array(
                        'conditions' => array(
                        'email' => $this->request->data['email'],
                        )
                    );
                    $emailcount = $this->User->find('count', $params);

                    // 過去に同じEMAILで登録がある場合、名前に数字を付加してから登録
                    if($emailcount>0){
                        $this->request->data['name'] = $this->request->data['name'] . ($emailcount + 1);
                    }

                    // 新規顧客登録
                    $return_cu = $webpay->customer->create(array(
                            "card"=>$this->request->data['webpay-token'],
                            "email"=>$this->request->data['email'],
                            "description"=>""
                            ));

                    $customer_id = $return_cu->id;

                    // DB登録(Usersテーブル)
                    $user_savedata = array(
                        'email' => $this->request->data['email'],
                        'customer_id' => $customer_id,
                        'name' => $this->request->data['name']
                        );

                    $this->User->save($user_savedata);

                    $user_id = $this->User->id;

                    // DB登録(Card_Hashesテーブル)
                    $cardhashes_savedata = array(
                        'user_id' => $user_id,
                        'fingerprint' => $token->card->fingerprint
                        );
                    $this->CardHash->save($cardhashes_savedata);
                }
                // 過去に課金あり
                else{
                    $customer_id = $customer['User']['customer_id'];
                    $user_id = $customer['User']['id'];
                }

                // ここから課金登録関連
                // 一時課金のとき
                if(empty($this->request->data['day'])){
                    $return_ch = $webpay->charge->create(array(
                        "amount"=>$this->request->data['amount'],
                        "currency"=>"jpy",
                        "customer"=>$customer_id,
                        "description" => ""
                        )
                    );

                    // DB登録
                    // Chargesテーブル
                    $charge_savedata = array(
                        'user_id' => $user_id,
                        'charge_id' => $return_ch->id,
                        'summary' => $this->request->data['summary'],
                        'amount' => $this->request->data['amount']
                    );
                    $this->Charge->save($charge_savedata);
                }
                // 定期課金のとき
                else{
                    $return_re = $webpay->recursion->create(array(
                        "amount"=>$this->request->data['amount'],
                        "currency"=>"jpy",
                        "customer"=>$customer_id,
                        "period"=>"month",
                        "description" => ""
                    ));

                    // DB登録
                    // Recursionsテーブル
                    $recursion_savedata = array(
                        'user_id' => $user_id,
                        'recursion_id' => $return_re->id,
                        'summary' => $this->request->data['summary'],
                        'amount' => $this->request->data['amount']
                    );
                    $this->Recursion->save($recursion_savedata);
                }
            }
            catch (\WebPay\ErrorResponse\ErrorResponseException $e) {
                $error = $e->data->error;

                switch ($error->causedBy) {
                    case 'buyer':
                        // カードエラーなど、購入者に原因がある
                        // エラーメッセージをそのまま表示するのがわかりやすい
                    debug(a);
                        break;
                    case 'insufficient':
                        // 実装ミスに起因する
                            debug(b);
                        break;
                    case 'missing':
                        // リクエスト対象のオブジェクトが存在しない
                            debug(c);
                        break;
                    case 'service':
                        // WebPayに起因するエラー
                            debug(d);
                        break;
                    default:
                        // 未知のエラー
                            debug(e);
                        break;
                }

                $this->redirect(array('Controller'=>'error', 'action'=>'index'));

            } catch (\WebPay\ApiException $e) {
                    // APIからのレスポンスが受け取れない場合。接続エラーなど
                    debug(aaa);
                    debug($e);
                    debug(f);
                    $this->redirect(array('controller'=>'error', 'action'=>'index'));
            } catch (\Exception $e) {
                    // WebPayとは関係ない例外の場合
                    debug(g);
                    $this->redirect(array('Controller'=>'error', 'action'=>'index'));
            }

            // ここからルーティングファイルから該当項目を削除
            // ルーティングファイルの指定
            $file = '/var/www/html/payments/app/Config/routes.php';
            // ファイルをオープンして既存のコンテンツを取得
            $current = file_get_contents($file);
            // 該当するルーティングを削除
            $delroute = preg_replace('/^.*'.$this->request->data['key'].'.*$/um','',$current);
            $delroute = preg_replace('/\n\n/',"\n",$delroute);
            // 結果をファイルに書き出し
            file_put_contents($file, $delroute);

            $this->redirect(array('controller'=>'purchased', 'action'=>'index'));
        }
        else
        {
            $nowallname = $this->request->query('nowall-name');
            $this->set('nowallname', urldecode($nowallname));

            $name = $this->request->query('name');
            $this->set('name', urldecode($name));

            $email = $this->request->query('email');
            $this->set('email', urldecode($email));

            $summary = $this->request->query('summary');
            $this->set('summary', urldecode($summary));

            $amount = $this->request->query('amount');
            $this->set('amount', urldecode($amount));

            $day = $this->request->query('day');
            $this->set('day', urldecode($day));

            // URL内の$keyを取得
            preg_match('/\/key\/(.*?)\?/s', $_SERVER['REQUEST_URI'], $key);
            $this->set('key', $key['1']);

            if(empty($nowallname)||empty($name)||empty($email)||empty($summary)||empty($amount))
                die("URLが間違っています.  Please try again");
        }
   }
}
