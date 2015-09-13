<h2><?php echo $this->request->query('title') ?>の検索結果</h2>


<table>
     
    <tr>
        <th>サムネイル</th>
        <th>タイトル</th>
        <th>著者</th>
        <th>本の発売日</th>
        
    </tr>

            <?php foreach ($items as $hoge) :?>
                

      <!--そのまま帰ってきたのだと前半にいいものが入っていない→そこから目的の本情報が入っている['Items']にまで言った。foreachの回し方に注意！-->
        
    <tr>
        <td><?php echo $this->Html->image($hoge['smallImageUrl'], array('alt' => 'サムネイル', 'url' => "detail?isbn=".$hoge['isbn']/*たまたま思いついてしまった。*/)); ?></td>
        <td><?php echo $this->Html->link($hoge['title'], 'detail?isbn='.$hoge['isbn'], array('action' => 'detail')); ?></td><!--
        詳細画面に行く時には、どのページの情報を取得すればいいかに注意。ここで、タイトルをクリックすると、パラメーターにタイトルを持った、books/detail/['title']に遷移。
        この時にしっかりとこのページでゲットした各種必要な変数をゲットする。また、isbnでしっかりと基さんが撮っていた本のあらすじを取れるようにするここから、books/detail?title=???というページに移行させる。ここではお気に入りボタンの表示、記事の詳細情報(検索結果の他に出版社、あらすじ、価格がある)
        ここで、その記事に紐付いているレビューを持ってくる。また、レビューページの遷移にもこのページの情報というか、そういうものが必要である。
        ちなみに、お気に入りしたら、booksテーブルに保存、並びにfavoritesの各項目に対するinsertがされる
        著者の方には、著者のurlをクリックしたら、そのurlがもつ著者の名前を判断軸に検索に翔り。
        基本的にurlを踏んで、それを遷移先のページに持ち越す、というところが気も
        あとページャーもつける-->
        <td><?php echo $this->Html->link($hoge['author'], 'author?author='.$hoge['author'], array('action' => 'author')); ?></td>
        <td><?php echo $hoge['salesDate']; ?></td>

    </tr>
    
    <?php endforeach; ?>
</table>

<?php
echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
?>