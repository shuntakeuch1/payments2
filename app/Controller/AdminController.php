<?php

class AdminController extends AppController {

    // public $components = array('Security');

    public $components = array('Session');

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



    public function generate() {
        $this->layout = 'adminLayout';

        if ($this->request->is('post'))
        {
            $this->Admin->set($this->request->data);

            if($this->Admin->validates())
            {
                $key = uniqid();

                $this->request->data['Admin'] += array('key' => $key);

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

    private function basicAuthError() {
            header('WWW-Authenticate: Basic realm="Please enter your ID and password"');
            header('HTTP/1.0 401 Unauthorized');
            die("Invalid id / password combination.  Please try again");
    }
}