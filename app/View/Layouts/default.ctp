<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Simple Blog');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('main');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'https://cakephp.org'); ?></h1>
		</div>
		<div id="content">

			<?php echo $this->Flash->render(); ?>
            <?php echo $this->Flash->render('auth'); ?>

            <div class="actions">
                <h3>Actions</h3>
                <?php if(AuthComponent::user('username')): ?>
                <h4>Hello, <?php echo AuthComponent::user('username'); ?></h4>
                <?php endif; ?> 
                <ul>
                    <?php echo $this->fetch('actions'); ?>
                    <li><?php 
                    if(AuthComponent::user('id'))
                        echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); 
                    else
                        echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login')); 
                    
                    ?></li>
                    <?php if(!AuthComponent::user('id')): ?>
                    <li><?php echo $this->Html->link('Register', array('controller' => 'users', 'action' => 'add')); ?></li>
                    <?php else: ?>
                    <li><?php echo $this->Html->link('Create Post', array('controller' => 'posts', 'action' => 'add')); ?></li>
                    <?php endif; ?>
                    <li><?php echo $this->Html->link('List Posts', array('controller' => 'posts', 'action' => 'index')); ?></li>
                    <li><?php echo $this->Html->link('List Users', array('controller' => 'users', 'action' => 'index')); ?></li>
                </ul>
            </div>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'https://cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<!--<?php echo $this->element('sql_dump'); ?>-->
</body>
</html>
