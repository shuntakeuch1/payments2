<?php

App::uses('AppModel', 'Model');
<<<<<<< HEAD

class User extends AppModel{

  public $hasMany = array('Charge', 'Recursion');

  public $hasOne = array('CardHash');

=======
class User extends AppModel
{
  public $hasMany = array('Charge', 'Recursion');
  public $hasOne = array('CardHash');
>>>>>>> a2d156b326e9e6f75f4503c5318ecbcebf2018f7
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
<<<<<<< HEAD



=======
>>>>>>> a2d156b326e9e6f75f4503c5318ecbcebf2018f7
