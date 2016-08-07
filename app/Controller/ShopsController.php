<?php

class ShopsController extends AppController {
  //var $scaffold;

  public $uses = array('Shop', 'Review'); // 各モデルの呼び出し

  public $helpers = array('Js','Paginator');

  public $components = array('Paginator', 'RequestHandler');

  public function beforeFilter() {
    parent::beforeFilter(); // AppControllerのbeforeFilterの記述の呼び出し
    //var_dump($this->user);
    $this->user = $this->viewVars["user"]["User"];
    //var_dump($this->viewVars);
  }

  public function index() { //トップページ（店舗一覧）

  }

  public function shoplist() {

    $this->autoRender = false;

    $this->Paginator->settings = array(
      'limit' => 5,
      'order' => array('created' => 'desc'),
      'recursive' => 3
    );
    $this->set('list', $this->paginate()); //shopテーブル情報を'list'に格納
    $this->render('/Shops/json/list', 'ajax');

  }

  public function view($id) { //店舗詳細ページ //idをviewで受け取れるようにする
    $userId = !empty($this->user['id']) ? $this->user['id'] : 0;
    $this->set('isEdit', $this->Review->isReview($id, $userId));

    if ($this->isLogin) {
      $this->set('myReviewCnt', $this->Review->getReviewCnt($this->user['id']));
    }


    list($score, $scoreAve) = $this->Review->getScoreAvg($id);
    $this->set('user', $this->user);
    $this->set('scoreAve', $scoreAve);
    $this->set('score', $score);
    $this->set('scoreList', Configure::read('scoreList'));
    $this->set('reviewList', $this->Review->getListByShopId($id));
    $this->set('data', $this->Shop->findById($id));
  }

  public function add() { //レストラン新規登録
    if ($this->request->is('post')) {
      $this->Shop->set($this->data); //postされたら値をセット

      if ($this->Shop->validates()) {
        $this->Shop->save($this->data); //shopテーブルに値を格納
        $this->redirect('index');
      }
    }
  }
}

?>
