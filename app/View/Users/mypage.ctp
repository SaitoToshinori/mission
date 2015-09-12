<ul>
    <li>Languages
        <ul>
            <li>English
                <ul>
                    <li>American</li>
                    <li>Canadian</li>
                    <li>British</li>
                </ul>
            </li>
            <li>Spanish</li>
            <li>German</li>
        </ul>
    </li>
</ul>


<h2><?php echo $auth->user()['username']; ?>のしたレビュー</h2>

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
        <th>削除</th>
        <th>編集</th>
    </tr>
     
    <?php foreach ($Favorite as $favorite): ?>
    <?php var_dump($favorite);?>
    <tr>
        <td><?php echo $this->Html->image($favorite['Book']['thumbnail'], array('alt' => 'サムネイル', 'url' => "/books/detail?isbn=".$favorite['Book']['isbn'])); ?></td>
        <td><?php echo $this->Html->link($favorite['Book']['title'], "/books/detail?isbn=".$favorite['Book']['isbn']); ?></td>
        <td><?php echo $this->Html->link($favorite['Book']['author'], "/books/author?author=".$favorite['Book']['author']); ?></td>
        <td><?php echo $this->Html->link($favorite['User']['username'], '/users/mypage/'.$favorite['User']['id']); ?></td>
        <td><?php echo $favorite['Favorite']['evaluation']; ?></td>
        <td><?php echo $favorite['Favorite']['review']; ?></td>
        <td>
        <?php  if($this->request->params['id'] == $auth->user('id')) {
            echo  $this->Form->postLink('削除', array('controller' => 'favorites', 'action' => 'delete', $favorite['Favorite']['id']));
            } else {
            echo '他人のお気に入りは削除できません';} ?>
        </td>
        <td>
        <?php  if($this->request->params['id'] == $auth->user('id')) {
            echo  $this->Html->link('編集', array('controller' => 'favorites', 'action' => 'edit', $favorite['Favorite']['id']));
            } else {
            echo '他人のお気に入りは編集できません';} ?>
        </td>
    </tr>
    <?php endforeach; ?>
     
</table>

<?php
echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
?>
<?php echo $this->Html->link('もっと見る', 'review'); ?>
<h2><?php echo $auth->user()['username']; ?>の登録した本</h2>

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
        <td><?php echo $this->Html->image($book['Book']['thumbnail'], array('alt' => 'サムネイル', 'url' => "detail?title=".$book['Book']['title'])); ?></td>
        <td><?php echo $this->Html->link($book['Book']['title'], 'detail?title='.$book['Book']['title']); ?></td>
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
<?php echo $this->Html->link('もっと見る', 'book'); ?>