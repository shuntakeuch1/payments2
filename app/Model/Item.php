<?php

    App::uses('AppModel', 'Model');

    class Item extends AppModel{

          public $belongsTo = array('Charge', 'Recursion');

    }