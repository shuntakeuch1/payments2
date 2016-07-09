<?php

    App::uses('AppModel', 'Model');

    class User extends AppModel{

          public $hasMany = array('Charge', 'Recursion');

          public $hasOne = array('CardHash');

    }

