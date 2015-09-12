<?php 

class UsersController extends AppController {



	public $helpers = array('Html', 'Form');

	public $uses = array('Favorite', 'User');

	public $paginate = array(
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

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');

        
    }

	public function add() {
		if ($this->request->is('post')) {
            $this->User->create();
            $user = $this->User->save($this->request->data);
            if ($user) {
                if ($this->Auth->login($user['User']))
                {
                    $this->Session->setFlash(__('The user has been saved'));
                    $this->redirect(['controller'=>'users','action'=>'mypage',$this->Auth->user('id')]);
                }
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }

	}

	public function login() {
		if ($this->request->is('post')){
            if ($this->Auth->login()) {
                $this->redirect(array('action' => 'mypage',$this->Auth->user('id')));
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
		
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	public function mypage() {
		$this->set('Favorite',$this->paginate('Favorite', array(
			'Favorite.user_id' => $this->request->params['id']
			)));
		$this->set('Book',$this->paginate('Favorite', array(
			'Favorite.user_id' => $this->request->params['id']
			)));
		$id = $this->request->params['id'];
		$name = $this->User->find('first', array(
			'conditions' => array(
				'User.id' => $id
				)));
		$this->set('name', $name);
		$this->set('User', $this);
	}

	public function book() {
		$this->paginate = array(
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
		$this->set('Book',$this->paginate('Favorite', array(
			'Favorite.user_id' => $this->Auth->user('id')
			)));
		
	}

	public function review() {
		$this->paginate = array(
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
		$this->set('Favorite',$this->paginate('Favorite', array(
			'Favorite.user_id' => $this->Auth->user('id')
			)));
	}

}