<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
    Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
    Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
/**
 * ...個別決済画面用遷移
 */
//fromkey
    Router::connect('/key/5780ffb937f03', array('controller' => 'key', 'action' => 'index')); //time:1468071865
    Router::connect('/key/5780ff98e218c', array('controller' => 'key', 'action' => 'index')); //time:1468071832
    Router::connect('/key/5780ff3c839a8', array('controller' => 'key', 'action' => 'index')); //time:1468071740
    Router::connect('/key/5780fe716e6b5', array('controller' => 'key', 'action' => 'index')); //time:1468071537
    Router::connect('/key/5780fe684e581', array('controller' => 'key', 'action' => 'index')); //time:1468071528
    Router::connect('/key/5780fe3b687ec', array('controller' => 'key', 'action' => 'index')); //time:1468071483
    Router::connect('/key/5780fd8611c72', array('controller' => 'key', 'action' => 'index')); //time:1468071302
    Router::connect('/key/5780fd2ac715e', array('controller' => 'key', 'action' => 'index')); //time:1468071210
    Router::connect('/key/5780fccda4388', array('controller' => 'key', 'action' => 'index')); //time:1468071117
    Router::connect('/key/5780f8b720a9f', array('controller' => 'key', 'action' => 'index')); //time:1468070071
    Router::connect('/key/5780e10fe38a7', array('controller' => 'key', 'action' => 'index')); //time:1468064015
//tokey
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
    CakePlugin::routes();
/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
    require CAKE . 'Config' . DS . 'routes.php';
