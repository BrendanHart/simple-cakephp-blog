<div class="actions">
    <h3>Actions</h3>
    <?php if(AuthComponent::user('username')): ?>
    <h4>Hello, <?php echo AuthComponent::user('username'); ?></h4>
    <?php endif; ?> 
    <ul>
        <li><?php 
        if(AuthComponent::user('id'))
            echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); 
        else
            echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); 
        
        ?></li>

        <?php if(!AuthComponent::user('id')): ?>
        <li><?php echo $this->Html->link('Register', array('controller' => 'users', 'action' => 'add')); ?></li>
        <?php endif; ?>
        <li><?php echo $this->Html->link('List Posts', array('controller' => 'posts', 'action' => 'index')); ?></li>
        <?php if(AuthComponent::user('id')): ?>
        <li><?php echo $this->Html->link('Create Post', array('controller' => 'posts', 'action' => 'add')); ?></li>
        <?php endif; ?>
        <li><?php echo $this->Html->link('List Users', array('controller' => 'users', 'action' => 'index')); ?></li>
    </ul>
</div>
