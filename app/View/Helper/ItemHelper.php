<?php

class ItemHelper extends AppHelper{
  public $helpers = ['Html'];

  public function photoImage($item,$options = []){
    $photoDir = Configure::read('Photo.dir');
    $defaultPhoto = Configure::read('Photo.default');

    if(empty($item['Item']['photo'])){
      $path = $defaultPhoto;
    }else{
      $path = $photoDir.$item['Item']['photo_dir'].'/'.$item['Item']['photo'];
    }

    return $this->Html->image($path,$options);
  }

}