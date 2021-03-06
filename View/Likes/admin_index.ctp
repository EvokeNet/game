<div class="likes index">
	<h2><?php echo __('Likes'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('evidence_id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($likes as $like): ?>
	<tr>
		<td><?php echo h($like['Like']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($like['Evidence']['title'], array('controller' => 'evidences', 'action' => 'view', $like['Evidence']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($like['User']['name'], array('controller' => 'users', 'action' => 'view', $like['User']['id'])); ?>
		</td>
		<td><?php echo h($like['Like']['created']); ?>&nbsp;</td>
		<td><?php echo h($like['Like']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $like['Like']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $like['Like']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $like['Like']['id']), null, __('Are you sure you want to delete # %s?', $like['Like']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Like'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Evidences'), array('controller' => 'evidences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Evidence'), array('controller' => 'evidences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
