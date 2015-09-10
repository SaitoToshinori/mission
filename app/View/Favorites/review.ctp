<h2>レビュー一覧</h2>

<?php
 echo $this->Paginator->counter(array('format' => '全%count%件' ));
 echo $this->Paginator->counter(array('format' => '{:page}/{:pages}ページを表示'));
?>

<table>
     
    <tr>
        <th>サムネイル画像</th>
        <th>タイトル</th>
        <th>著者</th>
        <th>レビュワー名</th>
        <th>評価</th>
        <th>本文</th>
    </tr>
     
    <?php foreach ($Favorite as $favorite): ?>
    <tr>
        <td><?php echo $this->Html->image($favorite['Book']['thumbnail'], array('alt' => 'サムネイル', 'url' => "/books/detail?isbn=".$favorite['Book']['isbn'])); ?></td>
        <td><?php echo $this->Html->link($favorite['Book']['title'], "/books/detail?isbn=".$favorite['Book']['isbn']); ?></td>
        <td><?php echo $this->Html->link($favorite['Book']['author'], "/books/author?author=".$favorite['Book']['author']); ?></td>
        <td><?php echo $this->Html->link($favorite['User']['username'], '/users/mypage/'.$favorite['User']['id']); ?></td>
        <td><?php echo $favorite['Favorite']['evaluation']; ?></td>
        <td><?php echo $favorite['Favorite']['review']; ?></td>
    </tr>
    <?php endforeach; ?>
     
</table>

<?php
echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
?>