<?php
class AdminusersController extends AppController {
  public $name = 'Adminusers';
  public $uses = array('Adminuser');
  public $helpers = array('Paginator','Html','Form');
  public $components = array('Session','Paginator','Cookie');

  public function beforeFilter(){
    parent::beforeFilter();
  }

  public function index (){
    $this->layout = 'adminLayout';
    $this->set('title_for_layout','管理者一覧画面 | ELITES') ;
    $p_limit = 10;
    $this->set('p_limit',$p_limit);
    $this->set('maxitem',$this->Adminuser->find('count','all'));
    $this->Paginator->settings = array(
    'limit' => $p_limit,
    // 'order' => array('created' => 'desc'),
    'recusive' =>3
    );
    $this->set('adminusers',$this->paginate());
  }

  public function create (){
    //ログインの禁止
    $this->layout = 'adminLayout';
    $this->set('title_for_layout','管理者登録画面 | ELITES');
    if($this->request->is('post')){
      if($this->Adminuser->validates()){
        $this->Adminuser->create();
          if ($this->Adminuser->save($this->request->data)) {
            $this->Flash->success('管理者ユーザーを登録しました');
            return $this->redirect(['action' => 'index']);
          }
      }
    }
  }

  public function edit($id =null){
    $this->layout = 'adminLayout';
    $this->set('title_for_layout','管理者編集画面 | ELITES');
    $this->set('id',$id);
    if($this->request->is(['post','put'])){
      if($this->Adminuser->save($this->request->data)){
        $this->Flash->success('会員情報を変更しました');
        $user = $this->Adminuser->find('first',[
                'fields' => ['id','email'],
                'conditions' => ['id' => $this->Auth->user('id')]
                ]);
        $this->Auth->login($user['User']);
        return $this->redirect(['action' => 'index']);
      }
    }else{
      $this->request->data = $this->Adminuser->findById($id);
    }
  }

  public function changePassword($id =null){
    $this->layout = 'adminLayout';
    $this->set('title_for_layout','管理者編集画面 | ELITES');
    if($this->request->is(['post','put'])){
      if($this->Adminuser->save($this->request->data)){
        $this->Flash->success('パスワードを更新しました');
        return $this->redirect(['action' => 'index']);
      }
    }else{
      $this->request->data = ['Adminuser' => ['id' => $this->Auth->user('id')]];
    }

  }

  public function delete($id = null){
    if(!$this->Adminuser->exists($id)){
      throw new NotFoundException('ユーザーがみつかりません');
    }
    $this->request->allowMethod('post','delete');
    if($this->Adminuser->delete($id)){
      $this->Flash->success('ユーザーを削除しました');
    }else{
      $this->Flash->error('ユーザーを削除できませんでした');
    }
    return $this->redirect(['action' => 'index']);

  }

  public function login(){
    $this->layout = 'itemLayout';
    $this->set('title_for_layout','ログイン | ELITES') ;
    //ログインの禁止
    if($this->Auth->user()){
      return $this->redirect($this->Auth->redirectUrl());
    }

    if($this->request->is('post')){
      if($this->Auth->login()){
        $this->redirect($this->Auth->redirectUrl());
      }else{
        $this->Flash->error('メールアドレスかパスワードが違います');
      }
     }
  }

  public function logout(){

    // $this->Session->setFlash('ログアウトしました');
    $this->Flash->set('ログアウトしました');

    $this->redirect($this->Auth->logout());
  }
}