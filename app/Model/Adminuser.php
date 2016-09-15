<?php

App::uses('BlowfishPasswordHasher','Controller/Component/Auth');
 class Adminuser extends AppModel
 {
    public $validate = array(
      'name'=>array(
        'rule'=>array('notBlank'),
        'message' => '名前を入力して下さい'
        ),
      'staff_id'=>array(
        'rule'=>array('notBlank'),
        'message' => '社員番号を入力して下さい'
        ),
        'email' => array(
          'required' => array(
            'rule' => 'notBlank',
            'message' => 'メールアドレスを入力して下さい'
            ),
              'validEmail' => array(
                'rule' => 'email',
                'message' => '正しいメールアドレスを入力して下さい'
                ),
              'emailExists' => array(
                'rule' => array('isUnique','email'),
                'message' => '入力されたメールアドレスは既に登録されています'
                )
          ),
               'password' => array(
                    'required' => array(
                        'rule' => 'notBlank',
                        'message' => 'パスワードを入力してください'
                            ),
                            // バリデーションにメソッドを指定
                            'match' => array(
                                'rule' => 'passwordConfirm',
                                'message' => 'パスワードが一致していません'
                           ),
                            'passBetween' => array(
                                'rule' => array('between',8,20),
                                'message' => '8文字以上必要です'
                                )
        ),
        'password_confirm' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'パスワード(確認)を入力してください'
            )
        ),
        'password_current' =>array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'パスワードが入力されていません'
                ),
            'match' => array(
                'rule' => 'checkCurrentPassword',
                'message' => 'パスワードが一致していません'
                )
            )
    );
        // カスタムバリデーションメソッド
    public function passwordConfirm($check) {
        // $check は ['password' => '入力された値']
        if ($check['password'] === $this->data['Adminuser']['password_confirm']) {
            return true;
        }
        return false;
    }

    public function checkCurrentPassword($check){
        $password = array_values($check)[0];
        $user = $this->findById($this->data['Adminuser']['id']);
        $passwordHasher = new BlowfishPasswordHasher();
        if($passwordHasher->check($password,$user['Adminuser']['password'])){
            return true ;
        }
        return false;
    }

    public function beforeSave($options = []){
      //パスワードをハッシュ化
      if(isset($this->data['Adminuser']['password'])){
        $passwordHasher = new BlowfishPasswordHasher();
        $this->data['Adminuser']['password'] = $passwordHasher->hash($this->data['Adminuser']['password']);
        return true;
      }
    }

 }