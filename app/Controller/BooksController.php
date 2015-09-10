<?php 

class BooksController extends AppController {

    public $helpers = array('Html', 'Form');

	public $uses = array('Book', 'Favorite');

	public $paginate = array(
			'Book'	=> array(
				'limit' => 10,
				'order' => array('id' => 'desc')
				),
			'Favorite' => array(
				'limit' => 10,
				'order' => array('id' => 'desc'),
				'conditions' => array(
					'NOT' => array(
						'Favorite.review' => ''
					)
				)
			)
	);


	public function index() {
		//$this->Paginator->settings['paramType'] = 'querystring';
		$page = $this->request->params['named']['page'];
		var_dump($this->paginate['Book']);
		$this->paginate['Book']['page'] = $page;
		$this->set('book', $this->paginate('Book'));
		//var_dump($this->request->params['named']['page']);
		$this->set('favorite',$this->paginate('Favorite'));
	}

	

	public function search() {
		if($this->request->is('get')) {
            $title = $this->request->query('title');
            //スペースキーで文字ん風力することを禁止しなくては
            if(empty($title)/* or empty($strpos)*/) {
                $this->Session->setFlash('入力しなければ検索できません。');
                $this->redirect(array('action'=>'index'));
            }

           	$baseUrl = 'https://app.rakuten.co.jp/services/api/BooksBook/Search/20130522?';
			$params = array(
				'applicationId' => '1020126519972453190',
				'format' => 'xml',
				'title' => $title//タイトルが空だったら
				);
			App::uses('Xml', 'Utility');
			$query = http_build_query($params);
			$url = $baseUrl . $query;
			$xmlArray = Xml::toArray(Xml::build($url));
			if (Hash::get($xmlArray, 'root.count') > 1) {
				$items = Hash::get($xmlArray, 'root.Items.Item');
			} else {
				$items = array( Hash::get($xmlArray, 'root.Items.Item') );
			}
			$this->set('items', $items);
	        //$this->set('divination', $xmlArray);
	    }

	    $this->paginate = array(
			'Book' => array(
				'limit' => 25,
				'order' => array('id' => 'desc')
			
			)
		);
		$this->set('Book', $this->paginate());
	    /*
	    もしサムネイル、もしくはタイトルがクリックされたら
	    その本のisbnをリンクデータに格納して、飛び先に送る。
	    urlはbooks/detail?isbn=$hoge['isbn']にする。
	    isbnは一意なのでその本の詳細ページに最適な情報をもたらす。
	    以下detailの内容
	    urlからisbnを取得しhttp通信
	    xmlで取得し、パース
	    表示
	    */
	}

	public function author() {
		if($this->request->is('get')) {
            $author = $this->request->query('author');
            //スペースキーで文字ん風力することを禁止しなくては
           	$baseUrl = 'https://app.rakuten.co.jp/services/api/BooksBook/Search/20130522?';
			$params = array(
				'applicationId' => '1020126519972453190',
				'format' => 'xml',
				'author' => $author//タイトルが空だったら
				);
			App::uses('Xml', 'Utility');
			$query = http_build_query($params);
			$url = $baseUrl . $query;
			$xmlArray = Xml::toArray(Xml::build($url));

			if (Hash::get($xmlArray, 'root.count') > 1) {
				$items = Hash::get($xmlArray, 'root.Items.Item');
			} else {
				$items = array( Hash::get($xmlArray, 'root.Items.Item') );
			}
			$this->set('items', $items);
			//$this->log(Hash::get($xmlArray, 'root.Items'), 'debug');
	        //$this->set('divination', $xmlArray);
	        //$this->log($xmlArray);
	        
	    }
		/*
		もし著者がクリックされたら(リンクを張り、リンクにはその著者の名前が入っている変数を格納し田植えでauthorページに行く。これを検索条件にapiを使用)
	    その本のisbnをリンクデータに格納して、飛び先に送る。
	    urlはbooks/detail?isbn=$hoge['isbn']にする。
	    isbnは一意なのでその本の詳細ページに最適な情報をもたらす。
		urlからisbnを取得しhttp通信
	    xmlで取得し、パース
	    表示
	    データをビューに渡しておわり
		*/
	}

	public function detail() {
		if($this->request->is('get')) {
            $isbn = $this->request->query('isbn');
           	$baseUrl = 'https://app.rakuten.co.jp/services/api/BooksBook/Search/20130522?';
			$params = array(
				'applicationId' => '1020126519972453190',//isbnに変更。それに応じてしっかり変更しましょう。※これは詳細ページで1冊しか表示されるべきではないのに、複数出てくる→一意正を持たせなくては行けない
				'format' => 'xml',
				'isbn' => $isbn
				);
			App::uses('Xml', 'Utility');
			$query = http_build_query($params);
			$url = $baseUrl . $query;
			$xmlArray = Xml::toArray(Xml::build($url));
	        if (Hash::get($xmlArray, 'root.count') > 1) {
				$items = Hash::get($xmlArray, 'root.Items.Item');
			} else {
				$items = array( Hash::get($xmlArray, 'root.Items.Item') );
			}
			$this->log(Hash::get($xmlArray, 'root.Items'), 'debug');
	        //$this->set('divination', $xmlArray);
	        //$this->log($xmlArray);
	        $this->set('items', $items);
	    
	        //$this->set('divination', $xmlArray);
	    }
		/*
		もしサムネイル、もしくはタイトルがクリックされたら
	    その本のisbnをリンクデータに格納して、飛び先に送る。
	    urlはbooks/detail?isbn=$hoge['isbn']にする。
	    isbnは一意なのでその本の詳細ページに最適な情報をもたらす。
	    以下detailの内容
	    urlからisbnを取得しhttp通信
	    xmlで取得し、パース
	    表示
		*/
	}

	public function table() {
		$this->paginate = array(
			'Book' => array(
				'limit' => 20,
				'order' => array('id' => 'desc')
			
			)
		);
		$this->set('Book', $this->paginate('Book'));
	}
	/*
	public function table() {
		
	}//listアクションは使えないそう

	public function review() {
		
	}
	*/


}
