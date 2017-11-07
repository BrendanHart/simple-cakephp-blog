<div class="index">
<h1>Blog posts</h1> 
<?php if(count($posts) === 0): ?>
    <div class="text-align:center">
        There are no posts to display.
    </div>
<?php endif; ?>
 
<?php foreach ($posts as $post): ?>
    <div class="post">
        <h2>
        <?php echo $this->Html->link(
            h($post['Post']['title']),
                array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])
            );
        ?>
        </h2>
        <div class="preview"><?php echo h($post['Post']['body']); ?></div>
        <small>Created by <?php 
            if($post['User']['found']) { 
                echo $this->Html->link(h($post['User']['username']), 
                array('controller' => 'users', 'action' => 'view', $post['Post']['user_id'])); 
            } else {
                echo '[deleted]';
            } 
            ?> on <?php echo $post['Post']['created']; ?>
            <?php
            echo $this->Html->link(
                'Edit',
                array('action' => 'edit', $post['Post']['id'])
            );
            echo ' ';
            echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $post['Post']['id']),
                array('confirm' => 'Are you sure?')
            );
            ?>
        </small>
    </div>
<?php endforeach; ?>
<?php unset($post); ?>
</div>
