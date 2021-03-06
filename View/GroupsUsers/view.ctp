<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $this->Html->link(strtoupper(__('Evoke')), array('controller' => 'users', 'action' => 'dashboard', $users['User']['id'])); ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="right">
			<li class="name">
				<h1><?= sprintf(__('Hi %s'), $users['User']['name']) ?></h1>
			</li>
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cog fa-2x"></i></a>
				<ul class="dropdown">
					<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $users['User']['id'])); ?></h1></li>
					<li><h1><?php echo $this->Html->link(__('Sign Out'), array('controller' => 'users', 'action' => 'logout')); ?></h1></li>
				</ul>
			</li>
			<li  class="has-dropdown">
				<a href="#"><?= __('Language') ?></a>
				<ul class="dropdown">
					<li><?= $this->Html->link(__('English'), array('action'=>'changeLanguage', 'en')) ?></li>
					<li><?= $this->Html->link(__('Spanish'), array('action'=>'changeLanguage', 'es')) ?></li>
				</ul>
			</li>
		</ul>

		<h3><?php echo sprintf(__('Welcome to Evoke Virtual Station'));?></h3>

	</section>
</nav>

<?php $this->end(); ?>

<!-- Medium Editor CSS -->
<?php echo $this->Html->css('/components/medium-editor/dist/css/medium-editor'); ?>
<?php echo $this->Html->css('/components/medium-editor/dist/css/themes/default'); ?>

<section class="evoke margin top">
	<div class="row full-width">
		<aside>
			<div class="small-2 medium-2 large-2 columns evoke chat">
				<h6 class="subheader"><?php echo __('ASSETS'); ?></h6>
				
				<!-- Here are the related resources, limited to 4 -->
				<dl class="accordion evoke margin top bottom" data-accordion>
					<dd>
						<a href="#panel1">Accordion 1</a>
						<div id="panel1" class="content active">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex.
							</p>
						</div>
					</dd>
					<dd>
						<a href="#panel2">Accordion 2</a>
						<div id="panel2" class="content">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex.
						</div>
					</dd>
					<dd>
						<a href="#panel3">Accordion 2</a>
						<div id="panel3" class="content">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex.
						</div>
					</dd>
				</dl>

				<button class="button expand"><?php echo __('Edit project info'); ?></button>

				<h6 class="subheader"><?php echo __('CHAT'); ?></h6>
			</div>
		</aside>

		<div class="small-8 medium-8 large-8 columns evoke">
			<h1 class="evoke typeface strong" id="groupname"><small><?php echo __('Group'); ?> </small><?php echo $group['Group']['title']; ?></h1>

			<!-- The Evokation project, with data from de DB and from Google Drive -->
			<?php
				// The field Evokation.id will exist after the project is created
				echo $this->Form->input('Evokation.id', array(
					'id' => 'evokation_id'
				));
				echo $this->Form->input('Group.id', array(
					'id' => 'evokation_group',
					'value' => $group['Group']['id']
				));
				echo $this->Form->input('Evokation.title', array(
					'label' => '',
					'id' => 'evokation_title',
					'placeholder' => __('Your Evokation title')
				));
				echo $this->Form->input('Evokation.abstract', array(
					'label' => '',
					'id' => 'evokation_abstract',
					'placeholder' => __('Your Evokation abstract')
				));
			 ?>

			<textarea id="evokation_txt" class="hidden"></textarea>

			<a class="button" contenteditable="false" href="#"><i class="fa fa-img"></i></a>
			<div id="evokation_div" class="evoke project page" contenteditable="true" data-placeholder=" "></div>
			
			<!--/ Evokation page -->

		</div>

		<aside>
			<div class="small-2 medium-2 large-2 columns evoke toolbar">
				<h6 class="subheader"><?php echo __('MEMBERS'); ?></h6>
				<ul class="no-bullet">
					<?php foreach ($users as $user): ?>
						<li><?php echo $user['User']['name']; ?></li>
					<?php endforeach ?>
				</ul>

				<button class="button expand" id="evokation_draft_button"><?php echo __('Save Evokation Draft'); ?></button>
				<button class="button expand disabled"><?php echo __('Send Final Evokation'); ?></button>

				<h6 class="subheader"><?php echo __('RELATED DOCUMENTS'); ?></h6>
				<ul class="no-bullet">
					<li><a href="#">Document</a></li>
					<li><a href="#">Document</a></li>
					<li><a href="#">Document</a></li>
					<li><a href="#">Document</a></li>
				</ul>

				<h6 class="subheader"><?php echo __('CALENDAR'); ?></h6>
				<ul class="no-bullet">
					<li><a href="#">Event</a></li>
					<li><a href="#">Event</a></li>
					<li><a href="#">Event</a></li>
					<li><a href="#">Event</a></li>
				</ul>

			</div>
		</aside>
	</div>
</section>

<script type="text/javascript">
	var WEBROOT  = <?php echo $this->webroot; ?>;
	var ACCESS_TOKEN = <?php echo $this->Session->read('access_token'); ?>;
	var CLIENT_ID = "<?php echo Configure::read('google_client_id'); ?>";
</script>
<?php if (!empty($this->request->data['Evokation'])): ?>
	<script type="text/javascript">
		var FILE_ID = "<?php echo $this->request->data['Evokation']['gdrive_file_id']; ?>";
	</script>
<?php else: ?>
	<script type="text/javascript">
		var FILE_ID = false;
	</script>
<?php endif; ?>

<?php echo $this->Html->script('/components/medium-editor/dist/js/medium-editor.min', array('inline' => false)); ?>
<?php echo $this->Html->script('https://apis.google.com/js/api.js', array('inline' => false)); ?>
<?php echo $this->Html->script('evokation', array('inline' => false)); ?>