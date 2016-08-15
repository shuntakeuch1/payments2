<?php

    App::uses('AppModel', 'Model');

    class Charge extends AppModel{

          public $hasMany = array('Item', 'Refund');

          public $belongsTo = array('User');

    }