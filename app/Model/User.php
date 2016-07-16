<?php

App::uses('AppModel', 'Model');

class User extends AppModel
{
  public $hasMany = array('Charge', 'Recursion');

  public $hasOne = array('CardHash');

  public $name = 'User';

  public $validate = array(
  'nowall_name' => array(
    'rule' =>array('notBlank'),
    'required' => true,
    // 'allowEmpty' => false,
    'message' => ' 担当者名を入力してください'
     )
    // ,
  // 'email'=>array(
  //     'rule' => array('email'),
  //     'message' => 'メールアドレスを入力してください'
  //     ),
  // 'name' => array(
  //   'rule' =>array('notBlank')
  //   )
  // ,
  // 'last_check' => array(
  //   'rule' =>array('notBlank')
  //   )
  );

}
