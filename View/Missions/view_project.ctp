<?php

	echo $this->Html->css('jcarousel');
	echo $this->Html->css('sticky_note');
	echo $this->Html->css('ribbon');

	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><a href = "<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'dashboard', $users['User']['id'])); ?>"><?= strtoupper(__('Evoke')) ?></a></h1>
		</li>
		<!-- <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li> -->
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="evoke right">

			<li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $users['User']['id'])); ?>"><img src='<?= $this->webroot.'img/Leslie_Knope.png' ?>' class = "evoke top-bar icon"/></a></li>
			
			<li class = "name">
				<h3><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action' => 'dashboard', $users['User']['id'])); ?>" class = "evoke top-bar-name"><?= $users['User']['name'] ?></a></h3>
			</li>

			<li class="evoke divider"></li>

			<li class = "evoke top-bar-level"><h5><?= __('Points') ?>&nbsp;&nbsp;&nbsp;<span>120</span></h5></li>

			<!-- <li class = "evoke top-bar-padding"><h5><?= __('Points') ?></h5>&nbsp;&nbsp;<h4>8</h4></li> -->

			<li class="evoke divider"></li>

			<li class = "evoke top-bar-level"><h5><?= __('Level') ?>&nbsp;&nbsp;&nbsp;<span>21</span></h5></li>
			<!-- <li class = "evoke top-bar-padding"><h5><?= __('Level') ?></h5>&nbsp;&nbsp;<h4>8</h4></li> -->
			
			<li class="evoke divider"></li>

			<li class = "evoke top-bar-padding bar">
				<div class="evoke top-bar progress small-9 large-9 round" style = "width:250px">
				  <span class="evoke top-bar meter" style="width: 50%"></span>
				</div>
			</li>

			<li class="evoke divider"></li>

			<li  class="has-dropdown">
				<a href="#"><?= __('Language') ?></a>
				<ul class="dropdown">
					<li><?= $this->Html->link(__('English'), array('action'=>'changeLanguage', 'en')) ?></li>
					<li><?= $this->Html->link(__('Spanish'), array('action'=>'changeLanguage', 'es')) ?></li>
				</ul>
			</li>

			<li class="evoke divider"></li>
			
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cog fa-2x"></i></a>
				<ul class="dropdown">
					<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $users['User']['id'])); ?></h1></li>
					<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
				</ul>
			</li>

		</ul>

		<!-- <h3><?php echo sprintf(__('Welcome to Evoke Virtual Station'));?></h3> -->

	</section>
</nav>

<?php $this->end(); ?>

<section class="evoke background padding top-2">
	<div class = "evoke missions data">
  		<h1><?php echo __('Mission: '); echo h($mission['Mission']['title']); ?></h1>
	</div>
	<div class="row full-width">
		  <div class="large-6 columns">
		  	<div class = "evoke evokation-pink-border full-width">
			  	<?php foreach($evokations as $e):
			  		echo $this->element('evokation_box', array('e' => $e, 'evokationsFollowing' => $evokationsFollowing));
	  			endforeach;?>
			</div>
		  </div>
		  <div class="large-6 columns">
		  	<div class = "evoke evokation-green-border full-width">
			  	<?php foreach($evokations as $e):
			  		echo $this->element('evokation_red_box', array('e' => $e));
		  		endforeach;?>
			</div>

		  </div>
	</div>

	<!-- <div class = "evoke position">
		<img src = '<?= $this->webroot.'img/small_bar.png' ?>' class = "evoke horizontal_bar left">
		<div class = "evoke titles"><h4><?php echo strtoupper(__('Mission Activities'));?></h4></div>
	</div> -->


  	<?= $this->element('left_titlebar', array('title' => __('Mission Activities'))) ?>

	<div class="row full-width">
	  <div class="large-6 columns">
	  	<div class="jcarousel-wrapper carousel-width">

		  	<div class="jcarousel sticky">
                <ul>
                    <?php foreach ($quests as $q): ?>

						<li>
							<div class = "missionblock" style = "text-align: center;">
								<a href="" data-reveal-id="<?= $q['Quest']['id'] ?>" data-reveal>
								<span><?php echo $q['Quest']['title'];?></span>
								</a>
							</div>
						</li>

						<div id="<?= $q['Quest']['id'] ?>" class="reveal-modal small" data-reveal>
						  <?= $this->element('quest', array('q' => $q, 'questionnaires' => $questionnaires, 'answers' => $answers))?>
						  <a class="close-reveal-modal">&#215;</a>
						</div>

					<?php endforeach; ?>
                </ul>
            </div>
        
		<a href="#" class="jcarousel-control-prev">&lsaquo;</a>
		<a href="#" class="jcarousel-control-next">&rsaquo;</a>

	    </div>
	  </div>
	  <div class="large-6 columns padding-right">
	  	<div class = "evoke titles-right">
	  		<img src = '<?= $this->webroot.'img/dossier.png' ?>' width = "600px">
	  		<div>
	  		<dl class="tabs vertical evoke icons" data-tab>
			  <dd class="active"><a href="#panel31a"><i class="fa fa-file-text fa-2x"></i></a></dd>
			  <dd><a href="#panel32a"><i class="fa fa-link fa-2x"></i></a></dd>
			  <dd><a href="#panel33a"><i class="fa fa-picture-o fa-2x"></i></a></dd>
			  <dd><a href="#panel34a"><i class="fa fa-video-camera fa-2x"></i></a></dd>
			</dl>
			<div class="tabs-content vertical evoke icons">
			  <div class="content active" id="panel31a">

			  	<h1><?= __('Mission Dossier: Files')?></h1>
			    <ul>
				  	<?php 
						foreach ($dossier_files as $file):
							$type = explode('/', $file['Attachment']['type']);
							if($type[0] == 'application'): 
								$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

							<li><a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><?= $file['Attachment']['attachment']?></a></li>

							<!-- <a href="#" data-reveal-id="myModal" data-reveal>Click Me For A Modal</a> -->
							<div id="<?= $file['Attachment']['id']?>" class="reveal-modal large" data-reveal>
							  <!-- <h2>Awesome. I have it.</h2>
							  <p class="lead">Your couch.  It is mine.</p>
							  <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p> -->
							  	<object data="<?= $path ?>" type="application/pdf" width="100%" height="100%" style = "height:900px">

								  <p>It appears you don't have a PDF plugin for this browser.
								  No biggie... you can <a href="myfile.pdf">click here to
								  download the PDF file.</a></p>
								  
								</object>
							  <a class="close-reveal-modal">&#215;</a> 
							</div>

					<?php endif; endforeach; ?>
				</ul>

			  </div>
			  <div class="content" id="panel32a">
			  	<h1><?= __('Mission Dossier: Links')?></h1>
			  </div>
			  <div class="content" id="panel33a">
			    <h1><?= __('Mission Dossier: Pictures')?></h1>
			    <ul>
				  	<?php 
						foreach ($dossier_files as $file):
							$type = explode('/', $file['Attachment']['type']);
							if($type[0] == 'image'): 
								$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

							<li><a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><?= $file['Attachment']['attachment']?></a></li>

							<!-- <a href="#" data-reveal-id="myModal" data-reveal>Click Me For A Modal</a> -->
							<div id="<?= $file['Attachment']['id']?>" class="reveal-modal small" data-reveal>
							  <img src = "<?= $path?>"/>
							  <a class="close-reveal-modal">&#215;</a> 
							</div>

					<?php endif; endforeach; ?>
				</ul>

			  </div>
			  <div class="content" id="panel34a">
			    <h1><?= __('Mission Dossier: Videos')?></h1>
			    <ul>
				  	<?php 
						foreach ($dossier_files as $file):
							//echo $file['Attachment']['attachment'];
							//echo $file['Attachment']['type'];
							$type = explode('/', $file['Attachment']['type']);
							if($type[0] == 'video'): 
								$path = ' '.$this->webroot.'files/attachment/attachment/'.$file['Attachment']['dir'].'/'.$file['Attachment']['attachment'] . ''; ?>

							<li><a href="<?= $path ?>" data-reveal-id="<?= $file['Attachment']['id']?>" data-reveal><?= $file['Attachment']['attachment']?></a></li>

							<!-- <a href="#" data-reveal-id="myModal" data-reveal>Click Me For A Modal</a> -->
							<div id="<?= $file['Attachment']['id']?>" class="reveal-modal large" data-reveal>
							  <!-- <h2>Awesome. I have it.</h2>
							  <p class="lead">Your couch.  It is mine.</p>
							  <p>Im a cool paragraph that lives inside of an even cooler modal. Wins</p> -->
							  	<div class="flex-video">
								        <iframe width="420" height="315" src="<?= $path ?>" frameborder="0" allowfullscreen></iframe>
								</div>
							  <a class="close-reveal-modal">&#215;</a> 
							</div>

					<?php endif; endforeach; ?>
				</ul>
			  </div>
			</div>
			</div>

  		</div>
	  </div>
	</div>

    <div class="row full-width">
	  <div class="large-8 columns">
	  	<div class = "evoke position">
			<img src = '<?= $this->webroot.'img/small_bar.png' ?>' class = "evoke horizontal_bar left">
			<dl class="tabs evoke titles" data-tab>
				  <dd><h4><?php echo strtoupper(__('Projects'));?></h4></dd>
				  <dd class="active"><a href="#panel2-1"><?= strtoupper(__('Most Voted'))?></a></dd>
				  <dd><a href="#panel2-2"><?= strtoupper(__('Most Recent'))?></a></dd>
			</dl>

			<div class="evoke tabs-content screen-box dashboard panel">
			  <div class="content active" id="panel2-1">
				<?php
					foreach($evokations as $e):
						echo $this->element('evokation_box', array('e' => $e));
					endforeach;?>
			  </div>
			  <div class="content" id="panel2-2">
			  </div>
			</div>
		</div>
	  </div>
	  <div class="large-4 columns">
	  		

		<div class = "evoke position" style = "margin: 0px 1%;">
			<img src = '<?= $this->webroot.'img/espiral.png' ?>' style = " width: 100%;">
			<div class = "evoke todo-list">
				<div class = "evoke todo-list content">
					<h1><?= strtoupper(__('To-Do List')) ?></h1>
					<ul>
	                    <?php foreach ($quests as $q): ?>

							<li><?php echo $q['Quest']['title'];?></li>

						<?php endforeach; ?>
	                </ul>
                </div>
			</div>
			<!-- <img src = '/evoke/webroot/img/holdtwo.png' style = "position: absolute; top: 40%; right: -25px; width: 30%;"> -->
		</div>

		<?php if(isset($nextMP)){ ?>

	  	<a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $nextMP['Phase']['position'])); ?>" class = "button general blue"><?php echo sprintf(__('Go to %s'), $nextMP['Phase']['name']);?>&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-right fa-2x"></i></a>

	  	<?php } if(isset($prevMP)) {?>

	  	<a href = "<?php echo $this->Html->url(array('controller' => 'missions', 'action' => 'view', $mission['Mission']['id'], $prevMP['Phase']['position'])); ?>" class = "button general green"><i class="fa fa-arrow-left fa-2x"></i>&nbsp;&nbsp;&nbsp;<?php echo sprintf(__('Go back to %s'), $prevMP['Phase']['name']);?></a>

	  	<?php } ?>
	  	
	  </div>
	</div>

</section>

<?php

	echo $this->Html->script('/components/jquery/jquery.min', array('inline' => false));
	echo $this->Html->script('/components/jcarousel/dist/jquery.jcarousel', array('inline' => false));
	//echo $this->Html->script('/components/jcarousel/examples/basic/jcarousel.basic');
	//echo $this->Html->script('/components/jcarousel/examples/skeleton/jcarousel.skeleton');
	echo $this->Html->script('/components/jcarousel/examples/responsive/jcarousel.responsive', array('inline' => false));

?>

<script>

	$('.jcarousel').jcarousel('scroll', '3');

</script>