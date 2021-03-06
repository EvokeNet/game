<?php 
	$showFollowButton = true;
	if(!isset($mine)) {
		$follows = false;
		$follower = null;

		foreach ($evokationsFollowing as $following) {
			if($following['Evokation']['id'] == $e['Evokation']['id']){
				$follows = true;
				$follower = $following;
				break;
			}
		}
	} else {
		$showFollowButton = false;
	}
?>

<a href = "<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $e['Evokation']['id']));?>">
	<div class="row evoke evokation-box">
		<div class="small-2 medium-2 large-2 columns">
	  		<div class = "evoke dashboard text-align">
	  			<h6><?= $e['Group']['title']?></h6>
			</div>
		</div>
		
		<div class="small-6 medium-6 large-7 columns">
			<h1><?= $e['Evokation']['title']?></h1>
		</div>

		<div class="small-4 medium-4 large-3 columns padding">
			<div>
				<ul>
			  		<li><i class="fa fa-comment-o fa-horizontal fa-lg"></i>&nbsp;&nbsp;<?= count($e['Comment']) ?><!-- <i class="fa fa-heart-o fa-lg"></i>&nbsp;<?= count($e['Like']) ?> --></li>
				  	<?php if($showFollowButton) : ?>
				  		<?php if($follows) : ?>
				  			<li><div class = "evoke evokation follow"><a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'delete', $follower['EvokationFollower']['id'])); ?>" class = "evoke button general"><?php echo __('Unfollow');?></a></div></li>
				  		<?php else : ?>
				  			<li><div class = "evoke evokation follow"><a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $e['Evokation']['id'], $users['User']['id'])); ?>" class = "evoke button general"><?php echo __('Follow');?></a></div></li>
				  		<?php endif; ?>
				  	<?php else: ?>
				  		<li><div class = "evoke evokation follow"><a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'edit', $e['Group']['id'])); ?>" class = "evoke button general"><?php echo __('GO TO PROJECT');?></a></div></li>
				  	<?php endif; ?>
				</ul>
			</div>
		</div>	
	</div>
</a>