<div class="index">
<h1>Users</h1>
<?php if(count($users) === 0): ?>
<div class="text-align:center">
    There are no users.
</div>
<?php else: ?>
<table>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Total Posts</th>
        <th>Role</th>
        <th>Created</th>
    </tr>

    <?php foreach ($users as $user): ?>
    <tr>
        <td>
            <?php
                echo $user['User']['id'];
            ?>
        </td>
        <td>
            <?php
                echo $this->Html->link(
                    $user['User']['username'],
                    array('controller' => 'users', 'action' => 'view', $user['User']['id'])
                );
            ?>
        </td>
        <td>
            <?php
                echo $user['User']['post_count'];
            ?>
        </td>
        <td>
            <?php
                echo $user['User']['role'];
            ?>
        </td>
        <td>
            <?php
                echo $user['User']['created'];
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>
<?php endif; ?>
</div>
