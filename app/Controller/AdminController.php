<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

require "/var/www/html/payments/app/Vendor/autoload.php";
use WebPay\WebPay;

class AdminController extends AppController {

    public $components = array('Session');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function generate() {
        $this->layout = 'adminLayout';

        if ($this->request->is('post'))
        {
            $this->Admin->set($this->request->data['Admin']);

            if($this->Admin->validates())
            {
                $key = uniqid();

                // URL作成
                $url = "https://elite.sc/payments/key/". $key. "?".
                            "nowall-name=". urlencode($this->request->data['Admin']['nowall-name']).
                            "&name=". urlencode($this->request->data['Admin']['name']).
                            "&email=". urlencode($this->request->data['Admin']['email']).
                            "&summary=". urlencode($this->request->data['Admin']['summary']).
                            "&amount=". urlencode($this->request->data['Admin']['amount']).
                            "&day=". urlencode($this->request->data['Admin']['day']);

                $this->request->data['Admin'] += array('url' => $url);


                // ここからルーティング追加
                $file = '/var/www/html/payments/app/Config/routes.php';
                // ファイルをオープンして既存のコンテンツを取得
                $current = file_get_contents($file);
                // 新しいルートをファイルに追加
                $addroute = preg_replace("/\/\/fromkey/","//fromkey\n    Router::connect('/key/".$key. "', array('controller' => 'key', 'action' => 'index')); //time:".time(),$current);
                // 結果をファイルに書き出し
                file_put_contents($file, $addroute);


                // ここからメール送信
                $email = new CakeEmail('default');

                $res = $email->config(array('log' => 'emails'))
                             ->from(array('test@example.com' => 'test'))
                             ->to($this->request->data['Admin']['email'])
                             ->subject('決済URL通知メール')
                             ->send($this->emailcontent_url($this->request->data['Admin']['name'],$url));

                $res = $email->config(array('log' => 'emails'))
                             ->from(array('test@example.com' => 'test'))
                             ->to($this->request->data['Admin']['email'])
                             ->subject('ID/PW通知メール')
                             ->send($this->emailcontent_idpw($this->request->data['Admin']['name']));

                // POSTの内容をSESSIONに保存
                $this->Session->write('sendData', $this->request->data);

                $this->redirect(array('action' => 'generated'));
            }

        }
    }

    public function generated() {
        $this->layout = 'adminLayout';

        if(!$_SESSION['sendData'])
        {
            $this->redirect(array('action' => 'generate'));
        }
        else
        {
            $this->set('sendData', $_SESSION['sendData']);

            // セッションの内容を消す
            $_SESSION = array();
        }
    }

    private function emailcontent_url($name, $url) {

        $emailcontent = $name. "様\n\nお世話になっております。\nELITES事務局です。\n\nこちらから課金情報の登録をお願いします。\n\n". $url."\n\nこのURLはメール送信後24時間有効です。\n\nまた本メールは自動送信のため、返信しないようお願いします。";

        return $emailcontent;
    }

    private function emailcontent_idpw($name) {

        $emailcontent = $name. "様\n\nお世話になっております。\nELITES事務局です。\n\n課金情報登録ページ用のID/PWを送信致します。\n課金情報登録用URLを閲覧する際には、このID/PWを使用してください。\n\nID: elites\nPW: nowall\n\nまた本メールは自動送信のため、返信しないようお願いします。";

        return $emailcontent;
    }
}