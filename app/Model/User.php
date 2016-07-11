<?php

App::uses('AppModel', 'Model');
class User extends AppModel
{
  public $hasMany = array('Charge', 'Recursion');
  public $hasOne = array('CardHash');
  public $name = 'User';
  public $validates = array(
  'email'=>array(
      'rule' => array('email'),
      'message' => 'メールアドレスを入力してください'
      ),
  'nowall_name' => array(
    'rule' =>array('notBlank')
    ),
  'name' => array(
    'rule' =>array('notBlank')
    ),
  'last_check' => array(
    'rule' =>array('notBlank')
    )
  );

}
