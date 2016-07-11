<?php

<<<<<<< HEAD
App::uses('AppModel', 'Model');
class User extends AppModel
{
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
=======
    App::uses('AppModel', 'Model');

    class User extends AppModel{

          public $hasMany = array('Charge', 'Recursion');

          public $hasOne = array('CardHash');

    }

>>>>>>> d849adec6c71011c7f5fa911f74d38b4f879f6d0
