<?php

    App::uses('AppModel', 'Model');

    class Refund extends AppModel{

          public $belongsTo = array('User');

    }