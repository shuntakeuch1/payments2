<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    protected $public_key = 'test_public_94I0ag7bXenugPP1HrcG175s';
    protected $secret_key = 'test_secret_3Rn1BM2o8gtY8Dq1xPaVh6kl';

    public function beforeFilter(){
        $this->set('currentUser',$this->Auth->user());

        $this->set('public_key', $this->public_key);
    }

    public $components = array(
      // 'DebugKit.Toolbar',
       'Flash',
      'Auth' =>[
        'loginAction' =>[
          'controller' => 'adminusers',
          'action' =>'login',
          ],
          'authenticate' =>[
            'Form' =>[
              'userModel' =>'Adminuser',
              'fields' => [
                'username' =>'email',
                'password' => 'password',
              ],
              'passwordHasher' =>'Blowfish',
            ]
          ],
          'loginRedirect' => [
            'controller' => 'adminpayments',
            'action' =>'dashboard'
          ],
          'logoutRedirect' =>[
            'controller' => 'adminusers',
            'action' =>'login'
          ],
          'authError' =>'ログインしてください',
        ]
     );
    public function appError($error) {
        $this->redirect('http://elite.sc/');
    }
}
