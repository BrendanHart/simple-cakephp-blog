<div class="index">
    <span style="font-size:2.5em;">
        <?php echo h($user['User']['username']);
              echo ' (';
              echo h($user['User']['role']); echo ')'; ?>
    </span>
    <p>
        Total posts: <?php echo count($posts); ?>
    </p>
    <p>
        Joined: <?php echo $user['User']['created']; ?>
    </p>

    <h3>Posts</h3>
    <?php if(count($posts) === 0): ?>
    <div class="text-align:center">
        This user has yet to make a post.
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
            <div class="preview">
                <?php echo h($post['Post']['body']); ?>
            </div>
            <small>
                Created on <?php echo $post['Post']['created']; ?>
                <?php
                echo $this->Html->link(
                    'Edit',
                    array('controller' => 'posts', 'action' => 'edit', $post['Post']['id'])
                );
                echo ' ';
                echo $this->Form->postLink(
                    'Delete',
                    array('controller' => 'posts', 'action' => 'delete', $post['Post']['id']),
                    array('confirm' => 'Are you sure?')
                );
                ?>
            </small>
        </div>
    <?php endforeach; ?>
    <?php unset($post); ?>
</div>

<?php $this->start('actions'); ?>
<?php if(AuthComponent::user('role') === 'admin'): ?>
<li>
<?php echo $this->Form->postLink(
                'Delete User',
                array('action' => 'delete', $user['User']['id']),
                array('confirm' => 'Are you sure?')
            );
?>
</li>
    <?php if($user['User']['role'] !== 'admin'): ?>
    <li>
    <?php echo $this->Form->postLink(
                    'Make Admin',
                    array('action' => 'makeAdmin', $user['User']['id']),
                    array('confirm' => 'Are you sure?')
                );
        ?>
    </li>
    <?php endif; ?>
    <hr style="width: 60%;margin:10px auto;color:#eee;" />
<?php endif; ?>
<?php $this->end(); ?>
