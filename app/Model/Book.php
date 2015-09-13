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

    public $resultCount = 0;

    public function paginate() {          	
           	//$title = func_get_args(0)[0]['title'];
           	$conditions = func_get_args(0)[0];
           	$limit = func_get_args(3)[3];
           	$page = func_get_args(4)[4];
           	$baseUrl = 'https://app.rakuten.co.jp/services/api/BooksBook/Search/20130522?';
			$params = array(
				'applicationId' => '1020126519972453190',
				'format' => 'xml',
				'hits' => $limit,
				'page' => $page
				);
			$params = array_merge($params, $conditions);
			App::uses('Xml', 'Utility');
			$query = http_build_query($params);
			$url = $baseUrl . $query;
			$xmlArray = Xml::toArray(Xml::build($url));
			$this->resultCount = Hash::get($xmlArray, 'root.count');
			$this->result = Hash::get($xmlArray, 'root.count');
			//var_dump($this->result);
			if (Hash::get($xmlArray, 'root.count') > 1) {
				$items = Hash::get($xmlArray, 'root.Items.Item');
			} else {
				$items = array( Hash::get($xmlArray, 'root.Items.Item') );
			}
			
			return $items;
	        //$this->set('divination', $xmlArray);
	}
	
	public function paginateCount() {
		return $this->resultCount;
	}

}