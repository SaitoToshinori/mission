<h2>お気に入り登録された本</h2>
<table>
     
    <tr>
        <th>サムネイル画像</th>
        <th>タイトル</th>
        <th>著者</th>
        <th>発売日</th>
        <th>お気に入り登録したユーザー</th>
    </tr>
    <?php foreach ($book as $books): ?>
        <?php var_dump($books); ?>
    
    		
    <tr>
        <td><?php echo $this->Html->image($books['Book']['thumbnail'], array('alt' => 'サムネイル', 'url' => "detail?isbn=".$books['Book']['isbn'])); ?></td>
        <td><?php echo $this->Html->link($books['Book']['title'], "detail?isbn=".$books['Book']['isbn']); ?></td>
        <td><?php echo $this->Html->link($books['Book']['author'], "author?author=".$books['Book']['author']); ?></td>
        <td><?php echo $books['Book']['publication']; ?></td>
        
    </tr>
    
    <?php endforeach; ?>
     
</table>

<?php echo $this->Html->link('もっと見る', 'table'); ?>


<h2>レビュー</h2>

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

<?php echo $this->Html->link('もっと見る', array('controller' => 'favorites', 'action' => 'review')); ?>