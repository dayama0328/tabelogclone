<?php

App::import('Vendor', 'facebook', array('file' => 'facebook/src/facebook.php'));

class UsersController extends AppController {

  public $components = array(
    'Session',
    'Auth' => array(
      'authenticate' => array(
        'Form' => array(
          'fields' =>
            array('username' => 'email', 'password' => 'password')
        )
      ),
      'loginRedirect' => array('controller' => 'shops', 'action' => 'index'),
      'logoutRedirect' => array('controller' => 'shops', 'action' => 'index'),
      'authError' => 'メールアドレスとパスワードを入力してください'
    )
  );

  public function beforeFilter() {
    parent::beforeFilter(); // AppControllerのbeforeFilterの記述の呼び出し
    $this->Auth->deny('edit'); // ログインしないとページを閲覧できないように設定する
  }

  public function add() { //新規会員登録
      if ($this->request->is('post')) {
        $this->User->set($this->data);

        if ($this->User->validates()) {
          $this->User->save($this->data);

          // 新規会員登録されたら自動的にログイン状態にする
          $data = $this->User->find('first', array(
            'condition' => array('email' => $this->data['User']['email'])
          ));
          $this->Auth->login($data);
          $this->Session->setFlash('ログインに成功しました', 'default', array(), 'auth');

          return $this->redirect($this->Auth->redirect());
        }
      }
  }

  public function edit() {
    if ($this->request->is('post')) {
      $this->User->validate['email'] = array(
        'validEmail' => array(
          'rule' => array('email'),
          'message' => 'メールアドレスを入力してください'
        )
      );

      if ($this->User->validates()) {
        $this->User->save($this->data);

        //メールアドレス・パスワードを更新したら自動的にログイン状態にする
        $data = $this->User->find('first', array('conditions' => array('email' => $this->data['User']['email'])));
        $this->Auth->login($data['User']);
        $this->Session->setFlash('設定変更に成功しました', 'default', array(), 'auth');
        return $this->redirect($this->Auth->redirect());
      }
    }
  }

  public function login() {
    if ($this->request->is('post')) {
      $this->User->set($this->data); // Userテーブルに値をセット

      if ($this->Auth->login()) {
        return $this->redirect($this->Auth->redirect());
      } else {
        $this->Session->setFlash('メールアドレスかパスワードが間違っています', 'default', array(), 'auth');
      }
    }
  }

  public function logout() {
    $this->Auth->logout(); // ログアウト
    $this->Session->setFlash('ログアウトしました', 'default', array(), 'auth'); // エラーメッセージの表示
    return $this->redirect($this->Auth->redirect()); // リダイレクトさせる
  }

  public function facebook() {
    $this->autoRender = false;
    $this->facebook = $this->createFacebook();

    $user = $this->facebook->getUser();

    if ($user) {
      // 認証後の処理
      $myData = $this->facebook->api('/me?fields=email');
      $data = array(
        'email' => $myData['email']
      );
      $exist = $this->User->find($data['email']);

      if (!$exist) {
        $this->User->save($data);
      }

      //ログイン状態にする
      $this->Auth->login($data);
      $this->Session->setFlash('Facebookログインに成功しました', 'default', array(), 'auth');
      return $this->redirect($this->Auth->redirect());

    } else {
      // 認証前
      $url = $this->facebook->getLoginUrl( array(
        'scope' => 'email'
      ));

      $this->redirect($url);
    }
  }

  private function createFacebook() {
    return new Facebook( array(
      'appId' => '460418454164402',
      'secret' => '4b9c2731763f04f60ae38efe027241cf'
    ));
  }
}

?>
