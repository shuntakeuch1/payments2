<?php
class BillingController extends AppController {
  public $name = 'Adminusers';
  public $uses = array('Adminuser');
  public $helpers = array('Paginator','Html','Form');
  public $components = array('Session','Paginator','Cookie');


}