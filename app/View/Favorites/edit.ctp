<h2>お気に入りの編集</h2>

<?php
echo $this->Form->create('Favorite', array('action'=>'edit'));
echo '読書状況';
echo $this->Form->input('Favorite.id', array('type'=>'hidden', 'value'=>$bookid['Favorite']['id']));
echo $this->Form->select('situation', array('読みたい' => '読みたい', '今読んでる' => '今読んでる', '読み終わった' => '読み終わった', '積読' => '積読'));
echo $this->Form->input('evaluation', array('type' => 'radio', 'options' => array('評価なし' => '評価なし', '評価していない' => '評価していない', 'あまり評価していない' => 'あまり評価していない', 'そこそこ評価する' => 'そこそこ評価する', '評価する' => '評価する', 'かなり評価する' => 'かなり評価する')));
echo $this->Form->input('review', array('label' => 'レビュー'));
echo $this->Form->input('book_id', array('type'=>'hidden', 'value'=>$bookid['Favorite']['book_id']));
echo $this->Form->input('user_id', array('type'=>'hidden', 'value'=>$auth->user('id')));
echo $this->Form->end(array('label' => '編集完了', 'name' => 'favorite'));
