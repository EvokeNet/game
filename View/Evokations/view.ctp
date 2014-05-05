<?php

	$this->extend('/Common/topbar');
	$this->start('menu');
	$comments_count = sprintf(' (%s) ', count($comment));

	echo $this->element('header', array('user' => $user));
	$this->end(); 

?>

<?php $this->start('social-metatags'); ?>

	<meta property="og:locale" content="en_US">
		 
	<meta property="og:url" content="<?php echo $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $evokation['Evokation']['id'])); ?>">
	 
	<meta property="og:title" content="<?= $evokation['Evokation']['title'] ?>">
	<meta property="og:site_name" content="<?= __('Evoke') ?>">
	 
	<!-- <meta property="og:description" content="<?= $evokation['Evokation']['content'] ?>"> -->

	<!-- <meta property="og:title" content="pagina" /> -->
	<!-- [...] -->

<?php $this->end(); ?>

<section class="evoke default-background">

	<?php echo $this->Session->flash(); ?>

	<div class="evoke default row full-width-alternate">

	  <div class="small-2 medium-2 large-2 columns">
	  	<?php echo $this->element('menu', array('user' => $user));?>
	  </div>

	  <div class="small-9 medium-9 large-9 columns maincolumn">

	  	<nav class="evoke breadcrumbs">
			<?php //echo $this->Html->link(__('Missions'), array('controller' => 'missions', 'action' => 'index'));?>
			<a class="unavailable" href="#"><?php echo __('Mission: ').$group['Mission']['title']; ?></a>
			<a class="unavailable" href="#"><?php echo __('Projects'); ?></a>
			<a class="current" href="#"><?php echo $evokation['Evokation']['title'];?></a>
		  </nav>

	  	<div class="evoke default row full-width-alternate">

  		<div class="small-3 medium-3 large-3 columns">
		  	<div class="evoke evidence-tag text-align">
		  		<!-- <img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" style = "max-width: 150px; margin: 20px 0px; max-height: 200px;"/> -->
			 	
		  		<?php if(isset($user['User'])) :?>
			 		<a href = "<?= $this->Html->url(array('controller' => 'groups', 'action' => 'view', $group['Group']['id']))?>">
			 			<?php if($group['Group']['photo_dir'] == null) :?>
		  					<img src="https://graph.facebook.com//picture?type=large" style="max-width: 10vw; margin: 20px 0px; max-height: 200px;"/>
			  			<?php else : ?>
								<img src="<?= $this->webroot.'files/attachment/attachment/'.$group['Group']['photo_dir'].'/thumb_'.$group['Group']['photo_attachment'] ?>" style="max-width: 10vw; margin: 20px 0px; max-height: 200px;"/>
					  	<?php endif; ?>
			 			<h1><?= $group['Group']['title']?></h1>
			 		</a>
			 	<?php else : ?>
					<a href = "<?= $this->Html->url(array('controller' => 'users', 'action' => 'login'))?>">
						<?php if($group['Group']['photo_dir'] == null) :?>
		  					<img src="https://graph.facebook.com//picture?type=large" style="max-width: 10vw; margin: 20px 0px; max-height: 200px;"/>
			  			<?php else : ?>
								<img src="<?= $this->webroot.'files/attachment/attachment/'.$group['Group']['photo_dir'].'/thumb_'.$group['Group']['photo_attachment'] ?>" style="max-width: 10vw; margin: 20px 0px; max-height: 200px;"/>
					  	<?php endif; ?>
						<h1><?= $group['Group']['title']?></h1>
					</a>
				<?php endif;?>


			 	<div class = "evoke border-bottom"></div>

			 	<p><?php echo $group['Group']['description'] ?></p>

			 	<div class = "evoke border-bottom"></div>
			 	
			 	<i class="fa fa-facebook-square fa-2x"></i>&nbsp;
				<i class="fa fa-google-plus-square fa-2x"></i>&nbsp;
				<i class="fa fa-twitter-square fa-2x"></i>

				<div class = "evoke border-bottom"></div>

				<?php if($can_edit) : ?>
					<div class = "evoke evidence margin-button"><a href = "<?php echo $this->Html->url(array('controller' => 'groupsUsers', 'action' => 'edit', $evokation['Evokation']['group_id'])); ?>" class = "button general"><?php echo __('GO TO PROJECT');?></a></div>
				<?php else : ?>
					<?php if(isset($user['User']) && $Follows) :?>
						<div class = "evoke evidence margin-button"><a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $evokation['Evokation']['id'])); ?>" class = "button general"><?php echo __('Unfollow');?></a></div>
					<?php else :?>
						<div class = "evoke evidence margin-button"><a href = "<?php echo $this->Html->url(array('controller' => 'evokationFollowers', 'action' => 'add', $evokation['Evokation']['id'])); ?>" class = "button general"><?php echo __('Follow');?></a></div>
					<?php endif; ?>	
				<?php endif; ?>
		 	</div>
		  </div>

		  <div class="small-7 medium-7 large-7 columns">
		 	<div class = "evoke evidence-body view">
			  	<h1><?php echo h($evokation['Evokation']['title']); ?></h1>
			  	<?php if($evokation['Evokation']['final_sent'] == 0) :?>
			  		<h6><?php echo h('Status: work in progress.'); ?></h6>
			  	<?php else : ?>	
			  		<?php if($evokation['Evokation']['approved'] == 0) :?>
			  			<h6><?php echo h('Status: Waiting for approval.'); ?></h6>
			  		<?php else : ?>	
			  			<h6><?php echo h('Status: Approved!'); ?></h6>
			  		<?php endif ?>	
			  	<?php endif ?>

			  	
				<?php if(!empty($allUpdates)) :?>
					<div id="showHistory"><small><?=  __('show update history') ?></small></div>
			  		<div id="history" style="display:none">
			  			<?php foreach ($allUpdates as $update) :?>
			  				<a href="<?= $this->Html->url(array('controller' => 'evokations', 'action' => 'view', $evokation['Evokation']['id'], $update['EvokationsUpdate']['id']))?>"><?= $update['EvokationsUpdate']['created'] . ': '. $update['EvokationsUpdate']['description']?></a>
			  				<br>
			  			<?php endforeach ?>
			  		</div>
			  	<?php endif ?>
			  	<?php if(!empty($newUpdate)) :?>
				  	<h4>
				  		<?= __('Current update:')?>
				  	</h4>
				  	<h5><?= $newUpdate['EvokationsUpdate']['created'] . ': '. $newUpdate['EvokationsUpdate']['description'] ?></h5>
				<?php endif ?>
			  	<div id="evokation_div" data-placeholder="">
			  		<?php if(isset($newUpdate['EvokationsUpdate'])) : ?>
			  			<?php echo urldecode($newUpdate['EvokationsUpdate']['content']); ?>
			  		<?php endif ?>
			  	</div>
			  	
			  	<h2><?= strtoupper(__('Share a Thought')) ?></h2>
			  	
			  	<?php foreach ($comment as $c): 
						echo $this->element('comment_box', array('c' => $c, 'user' => $user));
		  			endforeach; 
	  			?>
			</div>
		  </div>
	  <div class="small-2 medium-2 large-2 columns padding-right">

		<h3> <?= strtoupper(__('Rating')) ?> </h3>

		<div class = "evoke evidence-share">
		  	
		  	<!-- Voting lightbox button -->
		  	<div class = "evoke button-bg"><div class="evoke button like-button" data-reveal-id="myModalVote" data-reveal><i class="fa fa-heart-o fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Vote');?></h6></div><span><?= sizeof($votes)?></span></div>

		  	<!-- Commenting lightbox button -->
		  	<div class = "evoke button-bg"><div class="evoke button like-button comment-button" data-reveal-id="myModalComment" data-reveal><i class="fa fa-comment-o fa-flip-horizontal fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Comment');?></h6></div><span><?= count($comment) ?></span></div>
			
		</div>

		<h3> <?= strtoupper(__('Share')) ?> </h3>

	  	<div class = "evoke evidence-share">
		  	
		  	<div class="evoke button-bg">
	  			<a href="javascript:fbShare('<?= $_SERVER['SERVER_NAME']."/evokations/view/".$evokation['Evokation']['id'] ?>', 'Fb Share', '<?= $evokation['Evokation']['title'] ?>', 'http://goo.gl/dS52U', 520, 350)"><div class="evoke button like-button facebook-button"><i class="fa fa-facebook fa-lg"></i>&nbsp;&nbsp;&nbsp;<h6><?= __('Share on Facebook');?></h6></div></a>
  			</div>

  			<div class="evoke button-bg">
	  			<a href="#" onclick="popUp=window.open('https://plus.google.com/share?url=<?= $_SERVER['SERVER_NAME']."/evokations/view/".$evokation['Evokation']['id'] ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400');popUp.focus();return false"><div class="evoke button like-button google-button"><i class="fa fa-google-plus fa-lg"></i>&nbsp;&nbsp;<h6><?= __('Share on Google+');?></h6></div></a>
  			</div>

		</div>

	  </div>

	  	</div>

	  </div>

	  <div class="medium-1 end columns"></div>

  	</div>
</section>

<!-- Lightbox for voting form -->
<div id="myModalVote" class="reveal-modal tiny" data-reveal>
  <?php 
	if(isset($user['User'])) {
		if(!$vote) echo $this->element('vote', array('evokation_id' => $evokation['Evokation']['id'], 'user_id' => $user['User']['id'], 'update_id' => $updateId));
		else echo $this->element('see_vote', array('evokation_id' => $evokation['Evokation']['id'], 'user_id' => $user['User']['id'], 'vote_id' => $vote['Vote']['id'], 'vote_value' => $vote['Vote']['value'], 'update_id' => $updateId));
	} else {
		echo $this->element('vote', array('evokation_id' => $evokation['Evokation']['id'], 'user_id' => null));
	}
  ?>
  <a class="close-reveal-modal">&#215;</a>
</div>

<!-- Lightbox for commenting form -->
<div id="myModalComment" class="reveal-modal tiny evoke lightbox-bg" data-reveal>
  	<?php if(isset($user['User'])) :?>
  		<?php echo $this->element('comment_evokation', array('evokation_id' => $evokation['Evokation']['id'], 'user_id' => $user['User']['id'], 'update_id' => $updateId)); ?>
  	<?php else :?>
  		<?php echo $this->element('comment_evokation', array('evokation_id' => $evokation['Evokation']['id'], 'user_id' => null, 'update_id' => $updateId)); ?>
  	<?php endif; ?>
  <a class="close-reveal-modal">&#215;</a>
</div>

<?php

	echo $this->Html->script('/components/jquery/jquery.min');//, array('inline' => false));
	echo $this->Html->script('menu_height', array('inline' => false));
	echo $this->Html->script('facebook_share', array('inline' => false));
	echo $this->Html->script('google_share', array('inline' => false));

	echo $this->Html->css('evidences');
?>

<script type="text/javascript" charset="utf-8">
	var hidden = true;
	$( "#showHistory" ).click(function() {
  		if(hidden) {
	  		$( "#history" ).show("slow");
	  		$( "#showHistory>small" ).remove('');
	  		$( "#showHistory" ).append('<small>hide update history</small>');
	  		hidden = false;
	  	} else {
	  		$( "#history" ).hide();
	  		$( "#showHistory>small" ).remove('');
	  		$( "#showHistory" ).append('<small>show update history</small>');
	  		hidden = true;
	  	}
	});
</script>