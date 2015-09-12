<h2>お気に入り登録された本一覧</h2>

<?php
 echo $this->Paginator->counter(array('format' => '全%count%件' ));
 echo $this->Paginator->counter(array('format' => '{:page}/{:pages}ページを表示'));
?>

<table>
     
    <tr>
        <th>サムネイル画像</th>
        <th>タイトル</th>
        <th>著者</th>
        <th>発売日</th>
    </tr>
     
    <?php foreach ($Book as $book): ?>
    <tr>
        <td><?php echo $this->Html->image($book['Book']['thumbnail'], array('alt' => 'サムネイル', 'url' => "detail?isbn=".$book['Book']['isbn'])); ?></td>
        <td><?php echo $this->Html->link($book['Book']['title'], 'detail?isbn='.$book['Book']['isbn']); ?></td>
        <td><?php echo $this->Html->link($book['Book']['author'], 'author?author='.$book['Book']['author']); ?></td>
        <td><?php echo $book['Book']['publication']; ?></td>
    </tr>
    <?php endforeach; ?>
     
</table>

<?php
echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
?>