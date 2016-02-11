<?php
	// TOPBAR MENU -->
	$this->start('topbar');
	echo $this->element('topbar');
	$this->end();

	

	/* Image header */
	$this->start('image_header');
	echo $this->element('image_header',array('imgHeaderTitle' => __('Admin Panel'), 'imgSrc' => ($this->webroot.'img/header-leaderboard-2.jpg'), 'margin' => false, 'hidden' => true));
	$this->end();

	echo $this->Html->css(
		array(
			'evoke',
			'panels',
			'circle'
		)
	);

?>

<div class="row full-width" data-equalizer>
	
	<?php
		echo $this->element('panel/admin_sidebar');
		$this->end();
	?>

	<div class="large-10 columns hidden" id="panel-content" data-equalizer-watch>	
		<div class="forumCategories form">
		<?php echo $this->Form->create('ForumCategory'); ?>
			<fieldset>
				<legend><?php echo __('Admin Add Forum Category'); ?></legend>
			<?php
				echo $this->Form->input('title');
				echo $this->Form->input('slug');
				echo $this->Form->input('description');
				echo $this->Form->input('user_id');
				echo $this->Form->input('forum_id');
			?>
			</fieldset>
		<?php echo $this->Form->end(__('Submit')); ?>
		</div>
		<div class="actions">
			<h3><?php echo __('Actions'); ?></h3>
			<ul>

				<li><?php echo $this->Html->link(__('List Forum Categories'), array('action' => 'index')); ?></li>
				<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
				<li><?php echo $this->Html->link(__('List Forums'), array('controller' => 'forums', 'action' => 'index')); ?> </li>
				<li><?php echo $this->Html->link(__('New Forum'), array('controller' => 'forums', 'action' => 'add')); ?> </li>
			</ul>
		</div>
	</div>
</div>