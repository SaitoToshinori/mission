<?php 

class BooksController extends AppController {

    public $helpers = array('Html', 'Form');

	public $uses = array('Book', 'Favorite');

	public $paginate = array(
			'Book'	=> array(
				'limit' => 25,
				'order' => array('id' => 'desc')
				),
			'Favorite' => array(
				'limit' => 25,
				'order' => array('id' => 'desc'),
				'conditions' => array(
					'NOT' => array(
						'Favorite.review' => ''
					)
				)
			)
	);


	public function index() {
		//find allで最新のもの10っけん
		$this->set('book', $this->Book->find('all',array(
			'limit' => 10,
			'order' => array('Book.id' => 'desc')
			)));
		$this->set('favorite',$this->Favorite->find('all', array(
			'limit' => 10,
			'order' => array('Favorite.id' => 'desc'),
			'conditions' => array(
					'NOT' => array(
						'Favorite.review' => ''
					)
				)
			)));
		$this->set('Book', $this);
		
		/*【本を登録したユーザーの表示】
		最後の取り出しかた＝それぞれのテーブル項目のbook.idと一致するfavorite.book_idを探す。
		そこからuser_idを取得して、それと一致するuser.idを持ってるuser.usernameを取得する
        */

        /*
        // 最新の登録された本10件
		$books = $this->Book->find('all', array(
		    'limit' => 10,
		    'order' => array('id' => 'desc')
		));
		//これは$favoritesを使うためのモノ
		// 各本をお気に入りしたユーザ10人ずつ
		$favorites = $this->Favorite->find('all', array(
		    'conditions' => array(
		        'book_id' => Hash::extract($books, '{n}.Book.id'
		    )
		));

		// 各book_id毎にfavoriteのリストを持ちたい
		//
		// array(
		//    book_id => array(
		//      [Favorite],
		//      [Favorite],
		//      [Favorite],
		//    ),
		//    book_id => array(
		//      [Favorite],
		//      [Favorite],
		//      [Favorite],
		//    ),
		// )
		$user = array(); //空っぽ。という変数の宣言だから意味ないというか考えなくてよし
		foreach ($favorites as $favorite) {//$favoritesの中身を回す
		    $book_id = Hash::get($favorite, 'Favorite.book_id');//$favoriteの中からbook_idを取得

		    if (!Hash::get($user, $book_id)) {//$userに$book_id=$favoriteの中のbook_idがあるなら
		        $user[$book_id] = [];//$user[$book_id]に中身が空の配列をわたす
		    }

		    $user[$book_id][] = $favorite;//?$user[$book_id][]に$favoriteを入れる？それとも、$user[$book_id]を入れる？
		}
		        */

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
		$this->set('Book', $this->paginate('Book'));
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
		$confirm1 = $this->request->query('isbn');//urlのisbnを取得。やろうとしていることは既にbooksに保存されていてそれが既に今のユーザーにレビューされているかどうかのチェック
		//これがあると編集画面に行けるのか、登録画面に行けるのかがわかれる
		//var_dump($confirm);
		$confirm2 = $this->Book->find('first', array(
			'conditions' => array(
				'Book.isbn' => $confirm1)
			));//既にその本が保存されているかどうかをチェク(該当bookのレコードを取得)
		//var_dump($confirm2['Book']['id']);撮れてるconfirm2の時点でとれていなかったら$confirm2['Book']['id']がエラーになる
		if(!empty($confirm2)) {//$confirm2が入っていたらこの中に
			$confirm3 = $this->Favorite->find('first', array(
				'conditions' => array(
					'Favorite.book_id' => $confirm2['Book']['id'],//ここにBookがあるのはconfirm2で値がとれているありきの話
					'Favorite.user_id' => $this->Auth->user('id')
				)
				)
			);
			$this->set('confirm', $confirm3);
		} else {
			$this->set('confirm', $confirm2);
			//保存されているbook_idとログインしているuser_idのセットがあるかどうかチェックする(既にセットとしてあったら登録ではなくて修正のボタンにするため)
		//現在何故か重複してしまっているのでダメになっている。
		}
		
		$review1 = $this->Book->find('first', array(
			'conditions' => array(
				'Book.isbn' => $confirm1)
			)
		);//今表示している本のisbnと一致する本があるかどうかをチェック

		if(!empty($review1)) {
			$review2 = $this->Favorite->find('all', array(
			'conditions' => array(
				'Favorite.book_id' => $review1['Book']['id']
			)
		));
			$this->set('reviews', $review2);

		} else {
			$this->set('reviews', $review1);			
		}
		
		
		
		/*
		isbnを取得し、このisbnに一致するbooksのレコードを探す。ここで得たbook.idをつかってfavoriteのレビューを探す。
		取得したbook_idを持っているfavoritesのレコードを探す。それが合ったならforeach
		*/
	}

	public function table() {
		$this->set('Book', $this->paginate('Book'));
		$this->set('User', $this);
	}
	/*
	public function table() {
		
	}//listアクションは使えないそう

	public function review() {
		
	}
	*/


}
