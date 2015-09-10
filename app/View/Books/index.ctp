<h2>お気に入り登録された本</h2>
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
     
    <?php foreach ($book as $books): ?>
    <tr>
        <td><?php echo $this->Html->image($books['Book']['thumbnail'], array('alt' => 'サムネイル', 'url' => "detail?isbn=".$books['Book']['isbn'])); ?></td>
        <td><?php echo $this->Html->link($books['Book']['title'], "detail?isbn=".$books['Book']['isbn']); ?></td>
        <td><?php echo $this->Html->link($books['Book']['author'], "author?author=".$books['Book']['author']); ?></td>
        <td><?php echo $books['Book']['publication']; ?></td>
    </tr>
    <?php endforeach; ?>
     
</table>

<?php
echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
?>

<?php echo $this->Html->link('もっと見る', 'table'); ?>


<h2>レビュー</h2>
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
     
    <?php foreach ($favorite as $favorites): ?>
    <tr>
    	<td><?php echo $this->Html->image($favorites['Book']['thumbnail'], array('alt' => 'サムネイル', 'url' => "detail?isbn=".$favorites['Book']['isbn'])); ?></td>
        <td><?php echo $this->Html->link($favorites['Book']['title'], "detail?isbn=".$books['Book']['isbn']); ?></td>
        <td><?php echo $this->Html->link($favorites['Book']['author'], "author?author=".$favorites['Book']['author']); ?></td>
        <td><?php echo $this->Html->link($favorites['User']['username'], '/users/mypage/'.$favorites['User']['id']); ?></td>
        <td><?php echo $favorites['Favorite']['evaluation']; ?></td>
        <td><?php echo $favorites['Favorite']['review']; ?></td>
    </tr>
    <?php endforeach; ?>
     
</table>

<?php
echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
?>

<?php echo $this->Html->link('もっと見る', array('controller' => 'favorites', 'action' => 'review')); ?>