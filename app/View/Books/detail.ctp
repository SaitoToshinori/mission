<h2><?php echo $items[0]['title']; ?>の詳細</h2>


<table>
     
    <tr>
        <th>タイトル</th>
        <th>著者</th>
        <th>出版社</th>
        <th>商品説明文</th>
        <th>発売日</th>
        <th>税込み販売価格</th>

    </tr>

    
    <?php foreach ($items as $detail) :?>
            
    

                <!--物によって、配列に複数個入っている奴と入っていない奴が合って、それによってforeachの数が決まってくる-->



      <!--そのまま帰ってきたのだと前半にいいものが入っていない→そこから目的の本情報が入っている['Items']にまで言った。foreachの回し方に注意！-->
        
    <tr>
        <td><?php echo $this->Html->link($detail['title'], 'detail?title='.$detail['title'], array('action' => 'detail')); ?></td><!--
        詳細画面に行く時には、どのページの情報を取得すればいいかに注意。ここで、タイトルをクリックすると、パラメーターにタイトルを持った、books/detail/['title']に遷移。
        この時にしっかりとこのページでゲットした各種必要な変数をゲットする。また、isbnでしっかりと基さんが撮っていた本のあらすじを取れるようにするここから、books/detail?title=???というページに移行させる。ここではお気に入りボタンの表示、記事の詳細情報(検索結果の他に出版社、あらすじ、価格がある)
        ここで、その記事に紐付いているレビューを持ってくる。また、レビューページの遷移にもこのページの情報というか、そういうものが必要である。
        ちなみに、お気に入りしたら、booksテーブルに保存、並びにfavoritesの各項目に対するinsertがされる
        著者の方には、著者のurlをクリックしたら、そのurlがもつ著者の名前を判断軸に検索に翔り。
        基本的にurlを踏んで、それを遷移先のページに持ち越す、というところが気も
        あとページャーもつける-->
        <td><?php echo $this->Html->link($detail['author'], 'author?author='.$detail['author'], array('action' => 'author')); ?></td>
        <td><?php echo $detail['publisherName']; ?></td>
        <td><?php echo $detail['itemCaption']; ?></td>
        <td><?php echo $detail['salesDate']; ?></td>
        <td><?php echo $detail['itemPrice']; ?></td>
    </tr>
    


            
    <h2>本の登録</h2>
    <?php
    echo $this->Form->create('Favorite', array('action' => 'add'));
    echo $this->Form->input('title', array('type'=>'hidden','value'=>$detail['title']));
    echo $this->Form->input('author', array('type'=>'hidden','value'=>$detail['author']));
    echo $this->Form->input('publisher', array('type'=>'hidden','value'=>$detail['publisherName']));
    echo $this->Form->input('text', array('type'=>'hidden','value'=>$detail['itemCaption']));
    echo $this->Form->input('publication', array('type'=>'hidden','value'=>$detail['salesDate']));
    echo $this->Form->input('price', array('type'=>'hidden','value'=>$detail['itemPrice']));
    echo $this->Form->input('isbn', array('type'=>'hidden','value'=>$detail['isbn']));
    echo $this->Form->input('thumbnail', array('type'=>'hidden','value'=>$detail['smallImageUrl']));
    echo $this->Form->end(array('label' => '登録', 'name' => 'book'));
    ?>
    
    <?php endforeach; ?>
</table>