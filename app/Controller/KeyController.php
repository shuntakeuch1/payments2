<?php

// App::import('Vendor', 'autoload');
// App::uses('WebPay', 'WebPay');

require "/var/www/html/payments/vendors/autoload.php";
use WebPay\WebPay;

class KeyController extends AppController {

    //public $components = array('Session', 'Security');

    public function beforeFilter() {
        parent::beforeFilter();

        // //Basic認証
        // // id
        // $loginId = 'elites';

        // // passwd
        // $loginPassword = 'nowall';

        // $this->Security->validatePost = false;

        // if (isset($_SERVER['PHP_AUTH_USER'])) {
        //     if (! ($_SERVER['PHP_AUTH_USER'] == $loginId && $_SERVER['PHP_AUTH_PW'] == $loginPassword)) {
        //         $this->basicAuthError();
        //     }
        // } else {
        //     // 失敗したら途中で処理終了
        //     $this->basicAuthError();
        // }//Basic認証END

    }
   public function index() {
        $this->layout = 'keyLayout';

        if ($this->request->is('post'))
        {
            $webpay = new WebPay('test_secret_2NKghr1KT4pPccIahLfvd4Sk');

            $webpay->setAcceptLanguage('ja');

            try{
                    $webpay->charge->create(array(
                                           "amount"=>$this->request->data['amount'],
                                           "currency"=>"jpy",
                                           "card"=>$this->request->data['webpay-token'],
                                           "description" => "PHP からのアイテムの購入"
                                           )
                                        );
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
            } catch (\WebPay\ApiException $e) {
                    // APIからのレスポンスが受け取れない場合。接続エラーなど
                    debug(aaa);
                    debug($e);
                    debug(f);
            } catch (\Exception $e) {
                    // WebPayとは関係ない例外の場合
                    debug(g);
            }
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

            if(empty($nowallname)||empty($name)||empty($email)||empty($summary)||empty($amount))
                die("URLが間違っています.  Please try again");
        }
   }

    private function basicAuthError() {
            header('WWW-Authenticate: Basic realm="Please enter your ID and password"');
            header('HTTP/1.0 401 Unauthorized');
            die("Invalid id / password combination.  Please try again");
    }
}
