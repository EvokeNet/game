<?php $this->extend('/Common/admin_panel'); ?>

<?php $this->start('page_content'); ?>

<div style = "padding:1em">	

	<div class="panels">
        <div class="panels-heading">
            <div class="panels-heading-btn">
                <a title="" data-original-title="" href="<?php echo $this->Html->url(array('action' => 'add')); ?>" class="font-gray" data-click="panels-expand">
                    <i class="fa fa-plus-circle fa-lg"></i>
                </a>
            </div>
            <h4 class="uppercase font-gray font-weight-bold"><?php echo __('Matching Questions'); ?></h4>
        </div>
		<table cellpadding="0" cellspacing="0" class="table table-td-valign-middle" style="width:100%">
			<thead>
				<tr>
					<th class = "width-500"><?php echo $this->Paginator->sort('description'); ?></th>
					<th><?php echo $this->Paginator->sort('type'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($matchingQuestions as $matchingQuestion): ?>
					<tr>
						<td><p style="color: #222222" class="ellipsis-content width-500"><?php echo h($matchingQuestion['MatchingQuestion']['description']); ?>&nbsp;</p></td>
						<td><?php echo h($matchingQuestion['MatchingQuestion']['type']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__('View'), array('action' => 'view', $matchingQuestion['MatchingQuestion']['id'])); ?>
							<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $matchingQuestion['MatchingQuestion']['id'])); ?>
							<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $matchingQuestion['MatchingQuestion']['id']), array(), __('Are you sure you want to delete # %s?', $matchingQuestion['MatchingQuestion']['id'])); ?>
						</td>
					</tr>
	            <?php endforeach; ?>
	        </tbody>
        </table>
    </div>

	<div class = "margin-top-2">
        <p class = "left">
            <?php
                echo $this->Paginator->counter(array(
                    'format' => __('Mostrando {:start} a {:end} de {:count} registros') // 'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                ));
            ?>
        </p>
        <div class="paging right">
            <?php
                echo $this->Paginator->prev('< ' . __('Anterior') . ' ', array(), null, array('class' => 'prev disabled'));
                echo $this->Paginator->numbers(array('separator' => ''));
                echo $this->Paginator->next(' ' . __('Próximo') . ' >', array(), null, array('class' => 'next disabled'));
            ?>
        </div>
    </div>
</div>

<?php $this->end(); ?>