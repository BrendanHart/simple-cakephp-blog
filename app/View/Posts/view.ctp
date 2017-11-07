<div class="index">
<h1><?php echo h($post['Post']['title']); ?></h1>
    <div class="post">
        <div><?php echo h($post['Post']['body']); ?></div>
        <small>Created by <?php 
            if($post['User']['found']) { 
                echo $this->Html->link(h($post['User']['username']), 
                array('controller' => 'users', 'action' => 'view', $post['Post']['user_id'])); 
            } else {
                echo '[deleted]';
            } 
            ?> on <?php echo $post['Post']['created']; ?>
        </small>
    </div>
</div>

<?php $this->start('actions'); ?>
<li>
<?php
    echo $this->Html->link(
        'Edit Post',
        array('action' => 'edit', $post['Post']['id'])
    );
?>
</li>
<li>
<?php
    echo $this->Form->postLink(
        'Delete Post',
        array('action' => 'delete', $post['Post']['id']),
        array('confirm' => 'Are you sure?')
    );
?>
</li>
<hr style="width: 60%;margin:10px auto;color:#eee;" />
<?php $this->end(); ?>
