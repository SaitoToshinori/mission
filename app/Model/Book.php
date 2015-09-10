<?php 

class Book extends AppModel {
	public $name = 'Book';

	public $validate = array(
        'isbn' => array(
            'required' => array(
                'rule' => 'isUnique',
                'message' => 'このメールアドレスはすでに登録されています。'
            )
        )
    );

}