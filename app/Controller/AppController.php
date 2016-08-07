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
  public $components = array('DebugKit.Toolbar', 'Auth');

  public $isLogin = false;
  public $user = array();
  public $uses = array('User');

  public function beforeFilter() {
    $this->isLogin = (bool)$this->Auth->user(); //ログインしているか否かを真偽値で格納
    $user = $this->Auth->user(); //ユーザー情報の取得

    if (!empty($user['email'])) { // emailが空でなければ
      $user = $this->User->findByEmail($user['email']); // データベースのemailを取得 findBy◯◯でどのカラム名も取得可能
      $this->user = $user['User'];
    } else {
      $this->user = $user;
    }

    $this->set('isLogin', $this->isLogin);
    $this->set('user', $this->user);
    //var_dump($this->user);
    $this->Auth->allow();
  }
}










