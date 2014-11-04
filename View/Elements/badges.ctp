<div class="row">
  <div class="large-6 columns">
  	<h4 class="margin bottom-1"><?= strtoupper(__('Badges')) ?>&nbsp;&nbsp;(<?= count($badges) ?>)</h4>
  </div>
  <div class="large-6 columns text-right">
  	<a href = "<?php echo $this->Html->url(array('controller' => 'badges', 'action' => 'index')); ?>" class = "button thin"><?php echo __('See All');?></a>
  </div>
</div>

<ul class="small-block-grid-2 medium-block-grid-3">

<?php 
	$count = 0;
	foreach($badges as $badge): 
		$count++;
		if($count > 12)
			break;
		if(isset($badge['Badge']['img_dir'])) : ?>
			<li><img src = '<?= $this->webroot.'files/attachment/attachment/'.$badge['Badge']['img_dir'].'/'.$badge['Badge']['img_attachment'] ?>' width = "95%"></li>
		<?php else: ?>
			<li><img src = '<?= $this->webroot.'img/badge4.png' ?>' width = "100%"></li>
		<?php endif ?>
<?php endforeach;?>

</ul>