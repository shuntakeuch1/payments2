<?php

// App::items('AppController','Controller');
class ItemsController extends AppController
{
  public $name = 'Items';
  public $uses = array('Item');
  public $helpers = array('Paginator','Html','Form');
  public $components = array('Paginator');

  public function index()
  {
    $this->autoLayout = false;  // レイアウトをOFFにする
    $this->Paginator->settings = array(
        'limit' => 5,
        'order' => array('created' => 'desc'),
        'recusive' =>3
      );
    $this->set('items',$this->paginate());
    // $this->set('items',$this->Item->find('all'));

  }

  public function id($cha_rec_id)
  {
    $this->autoLayout = false;  // レイアウトをOFFにする
    // $userId = !empty($this->user['id']) ? $this->user['id'] :0;
    // $this->set('isEdit',$this->Review->isReview($id,$userId));

    // if($this->isLogin)
    // {
    //   $this->set('myReviewCnt',$this->Review->getReviewCnt($this->user['id']));
    // }

    // list($score,$scoreAve) = $this->Review->getScoreAvg($id);
    // $this->set('scoreAve',$scoreAve);
    // $this->set('score',$score);
    // $this->set('scoreList',Configure::read('scoreList'));
    // $this->set('reviewList',$this->Review->getListByShopId($id));
    // $this->set('items',$this->Item->find('all'));
    $this->set('items',$this->Item->findByCha_rec_id($cha_rec_id));
  }

}