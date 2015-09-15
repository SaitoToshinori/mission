<h2><?php echo $name['User']['username']; ?>のしたレビュー</h2>


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
    <tr>
        <td><?php echo $this->Html->image($favorite['Book']['thumbnail'], array('alt' => 'サムネイル', 'url' => "/books/detail?isbn=".$favorite['Book']['isbn'])); ?></td>
        <td><?php echo $this->Html->link($favorite['Book']['title'], "/books/detail?isbn=".$favorite['Book']['isbn']); ?></td>
        <td><?php echo $this->Html->link($favorite['Book']['author'], "/books/author?author=".$favorite['Book']['author']); ?></td>
        <td><?php echo $this->Html->link($favorite['User']['username'], '/users/mypage/'.$favorite['User']['id']); ?></td>
        <td><?php echo $favorite['Favorite']['evaluation']; ?></td>
        <td><?php echo $favorite['Favorite']['review']; ?></td>
        <td>
        <?php  if($this->request->params['pass'][0] == $auth->user('id')) {
            echo  $this->Form->postLink('削除', array('controller' => 'favorites', 'action' => 'delete', $favorite['Favorite']['id']));
            } else {
            echo '他人のお気に入りは削除できません';} ?>
        </td>
        <td>
        <?php  if($this->request->params['pass'][0] == $auth->user('id')) {
            echo  $this->Html->link('編集', array('controller' => 'favorites', 'action' => 'edit', $favorite['Favorite']['id']));
            } else {
            echo '他人のお気に入りは編集できません';
            } ?>
        </td>
    </tr>
    <?php endforeach; ?>
     
</table>
<?php 
    echo $this->Form->create('User', array('action' => 'review', 'type' => 'get'));
    echo $this->Form->input('userid', array('type'=>'hidden','value'=>$this->request->params['pass'][0]));
    echo $this->Form->end('もっと見る');
?>


<h2><?php echo $name['User']['username']; ?>の登録した本</h2>

<table>
     
    <tr>
        <th>サムネイル画像</th>
        <th>タイトル</th>
        <th>著者</th>
        <th>発売日</th>
        <th>お気に入り登録したユーザー</th>
    </tr>
     
    <?php foreach ($Book as $book): ?>
    <tr>
        <td><?php echo $this->Html->image($book['Book']['thumbnail'], array('alt' => 'サムネイル', 'url' => "/books/detail?isbn=".$book['Book']['isbn'])); ?></td>
        <td><?php echo $this->Html->link($book['Book']['title'], array('controller' => 'books', 'action' => 'detail',"detail?isbn=".$book['Book']['isbn'])); ?></td>
        <td><?php echo $this->Html->link($book['Book']['author'], '/books/author?author='.$book['Book']['author']); ?></td>
        <td><?php echo $book['Book']['publication']; ?></td>
        <td><?php $id = $book['Book']['id'];
                  $user_ids = $User->Favorite->find('all', array(
                    'conditions' => array(
                        'Favorite.book_id' => $id
                        )));
                  foreach ($user_ids as $user_id){
                    echo $this->Html->link($user_id['User']['username'], '/users/mypage/'.$user_id['User']['id']);
                  } ?></td>
    </tr>
    <?php endforeach; ?>
     
</table>
<?php 
    echo $this->Form->create('User', array('action' => 'book', 'type' => 'get'));
    echo $this->Form->input('userid', array('type'=>'hidden','value'=>$this->request->params['pass'][0]));
    echo $this->Form->end('もっと見る');
?>