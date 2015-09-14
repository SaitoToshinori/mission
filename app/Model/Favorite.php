<?php

class Favorite extends AppModel {
		public $name = 'Favorite';

		public $belongsTo = array(
			'Book' => array(
			'className' => 'Book',
			'foreignKey' => 'book_id'
			),
			'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id'
			)
		);

		public $validate = array(
			'situation' => array(
	            'required' => array(
	                'rule' => array('notEmpty'),
	                'message' => '選択してください'
	            )
	        )
        );
		//situationのバリデート
}