<?php 

class FavoritesController extends AppController {
	
	public $helpers = array('Html', 'Form');

	public $uses = array('Favorite', 'Book', 'User');

	public $paginate = array(
		'Favorite' => array(
			'limit' => 25,
			'order' => array('id' => 'desc'),
			'conditions' => array(
				'NOT' => array(
					'Favorite.review' => ''
					)
				)
		),
		'Book' => array(
			'limit' => 25,
			'order' => array('id' => 'desc')
		)
	);
	
	public function add() {		
		if($this->request->is('post')) {//どっちのボタンが押されたかを判定させる。こっちは、お気に入りする画面に遷移するためのボタン。//postで通信されている
			if(isset($this->request->data['book'])){//string(6) "登録"が着てる				
				$ouhu = $this->Book->find('first', array(
					'conditions' => array(
						'Book.isbn' => $this->request->data['Favorite']['isbn'])));
				if(empty($ouhu)){//isbnがなかった場合
					$id = $this->Book->save($this->request->data['Favorite']);//ここの値が正しくない。$this->request->dataは値正しい。→saveができていない。→model,dbが問題!?
					$this->set('info', $id);//infoがfavorites/addに渡ってない説
					//var_dump($this->set('info', $id));これ自体がnullなのはもんだいないらしい(うまく言ってるblogの方でやっても同じ結果だった)
					//exit;
					//$this->redirect(array('controller' => 'favorites', 'action' => 'add'));これを抜くとなぜ動作するかはわからない
				} else {
					$this->set('info', $ouhu);
				}
				
			}
		
		
			if(isset($this->request->data['favorite'])){
				//既に紐付いていたら、という処理を行って、それをビューに渡してボタンのひょうじの条件分岐をする必要あるので、それを組んでからビューに渡す
				$this->Favorite->save($this->request->data);
				$this->Session->setFlash('登録しました');
				$this->redirect(array('controller' => 'books', 'action' => 'index'));
			}
		}
		
		/*
		お気に入りの本に登録するというボタンが押されたら(この時にどの本についてかをしっかりと分かる状態でページが遷移されていなければならない。
		このボタンが押されたらbooksテーブルにデータを格納かな)(入ってくるデータはタイトル,著者、出版社、説明文、発売日、価格)
		画面が登録画面に遷移する
		画面には読書状況、レビューなどが入力する欄が合って、そこと、bookのid、userのidをこっそり取得して(post送信なら、ボタンを押す→
		ポストデータが飛んでくる→セーブされる→idが発行される→取得する事ができる→そのidを持つ本を表示する事ができる→レビューとかを書き込める
		)、favoritesdbに格納する。
		(bookのidが取得されるということは、データベースに既に本自体がお気に入り登録されているということがされていなければならない)
		
		*/
	}

	public function edit($id = null) {
		$rr = $this->Favorite->find('first', array(
        	'conditions' => array(
        		'Favorite.id' => $this->request->params['id'])
        	));
        $this->set('bookid', $rr);

		$this->Favorite->id = $id;
        if ($this->request->is('get')) {
            $this->request->data = $this->Favorite->read();
        } else {
            if ($this->Favorite->save($this->request->data)) {
                $this->Session->setFlash('修正しました');
                $this->redirect(array('controller' => 'users', 'action'=>'mypage', $this->Auth->user('id')));
            } else {
                $this->Session->setFlash('修正失敗しました');
            }
        }
	}

	public function delete($id) {
				if ($this->request->is('get')) {
        			throw new MethodNotAllowedException();
    			}
   				if($this->Favorite->delete($id)) {
		            $this->Session->setFlash('Success!');
		            $this->redirect('/users/mypage/'.$this->Auth->user('id'));
				} else {
					$this->Session->setFlash('failed!');
		            $this->redirect('/users/mypage/'.$this->Auth->user('id'));
				}
		}

	public function review() {
		$this->set('Favorite',$this->paginate());
		/*$aa = $this->Favorite->find('all', array(
			'conditions' => array(
				'NOT' => array(
				'Favorite.review' => ''
				)
			)
				
		)   
		);
		var_dump($aa);*/
	}
	public function table() {
		$this->paginate = array(
			'Favorite' => array(
				'group' => 'book_id',
				'limit' => 25,
				'order' => array('id' => 'desc'),
				'conditions' => array(
					'NOT' => array(
						'Favorite.review' => ''
						)
					)
			)
		);
		$this->set('Book', $this->paginate('Favorite'));
		$this->set('User', $this);
	}


}