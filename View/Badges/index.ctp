<?php

	$this->extend('/Common/topbar');
	$this->start('menu');

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<section class="evoke background">

	<div class="small-2 medium-2 large-2 columns padding-left">
	  		<?php echo $this->element('menu', array('user' => $user));?>
	</div>	
	
	<div class="row full-width">
		
		<div class="small-11 small-centered columns">
			<?= $this->element('left_titlebar', array('title' => __('Badges'))) ?>
			<div class = "evoke black-bg badges-bg">
				<ul class="small-block-grid-3 medium-block-grid-3 large-block-grid-3">
				  	<?php 

					foreach($badges as $badge): ?>
						<li>
							<?php if(isset($badge['Badge']['img_dir'])) : ?>
								<img src = '<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>'>
							<?php else: ?>
								<img src = '<?= $this->webroot.'img/badge.png' ?>'>
							<?php endif ?>
							<h1><?= $badge['Badge']['name'] . '(' .$badge['Badge']['owns'] . ')';?></h1>
				  			<p><?= $badge['Badge']['description']?></p>
						</li>
					<?php endforeach;?>
				  	<!-- <img src = '<?= $this->webroot.'img/badge.png' ?>'> -->
				  	<!-- 
			  	  <li>
				  	<img src = '<?= $this->webroot.'img/badge.png' ?>'>
				  	<h1> Badge </h1>
				  	<p>Cras at tellus et lorem volutpat bibendum. Integer ut metus nunc.</p>
			  	  </li>
			  	  <li>
				  	<img src = '<?= $this->webroot.'img/badge.png' ?>'>
				  	<h1> Badge </h1>
				  	<p>Cras at tellus et lorem volutpat bibendum. Integer ut metus nunc. Phasellus nec auctor diam, in ornare magna. Phasellus hendrerit dolor augue, et feugiat ligula consequat vel.</p>
			  	  </li>
			  	  <li>
				  	<img src = '<?= $this->webroot.'img/badge.png' ?>'>
				  	<h1> Badge </h1>
				  	<p>Cras at tellus et lorem volutpat bibendum. Integer ut metus nunc. Phasellus nec auctor diam, in ornare magna. Phasellus hendrerit dolor augue, et feugiat ligula consequat vel.</p>
			  	  </li>
			  	  <li>
				  	<img src = '<?= $this->webroot.'img/badge.png' ?>'>
				  	<h1> Badge </h1>
				  	<p>Cras at tellus et lorem volutpat bibendum. Integer ut metus nunc.</p>
			  	  </li>
			  	  <li>
				  	<img src = '<?= $this->webroot.'img/badge.png' ?>'>
				  	<h1> Badge </h1>
				  	<p>Cras at tellus et lorem volutpat bibendum. Integer ut metus nunc. Phasellus nec auctor diam, in ornare magna. Phasellus hendrerit dolor augue, et feugiat ligula consequat vel.</p>
			  	  </li>
			  	  <li>
				  	<img src = '<?= $this->webroot.'img/badge.png' ?>'>
				  	<h1> Badge </h1>
				  	<p>Cras at tellus et lorem volutpat bibendum. Integer ut metus nunc. Phasellus nec auctor diam, in ornare magna. Phasellus hendrerit dolor augue, et feugiat ligula consequat vel.</p>
			  	  </li>
			  	  <li>
				  	<img src = '<?= $this->webroot.'img/badge.png' ?>'>
				  	<h1> Badge </h1>
				  	<p>Cras at tellus et lorem volutpat bibendum. Integer ut metus nunc. Phasellus nec auctor diam, in ornare magna. Phasellus hendrerit dolor augue, et feugiat ligula consequat vel.</p>
			  	  </li>
			  	  <li>
				  	<img src = '<?= $this->webroot.'img/badge.png' ?>'>
				  	<h1> Badge </h1>
				  	<p>Cras at tellus et lorem volutpat bibendum. Integer ut metus nunc. Phasellus nec auctor diam, in ornare magna. Phasellus hendrerit dolor augue, et feugiat ligula consequat vel.</p>
			  	  </li> -->
				</ul>
			</div>
		</div>
	</div>
</section>
<!-- <div class="badges index">
	<h2><?php echo __('Badges'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('trigger'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($badges as $badge): ?>
	<tr>
		<td><?php echo h($badge['Badge']['id']); ?>&nbsp;</td>
		<td><?php echo h($badge['Badge']['name']); ?>&nbsp;</td>
		<td><?php echo h($badge['Badge']['description']); ?>&nbsp;</td>
		<td><?php echo h($badge['Badge']['trigger']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $badge['Badge']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $badge['Badge']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $badge['Badge']['id']), null, __('Are you sure you want to delete # %s?', $badge['Badge']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Badge'), array('action' => 'add')); ?></li>
	</ul>
</div>
 -->