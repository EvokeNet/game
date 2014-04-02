<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><?php echo $this->Html->link(strtoupper(__('Evoke')), array('controller' => 'users', 'action' => 'dashboard', $userid)); ?></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="evoke top-bar-section">

		<!-- Right Nav Section -->
		<ul class="right">
			<li class="name">
				<h1><?= sprintf(__('Hi %s'), $username[0]) ?></h1>
			</li>
			<li class="has-dropdown">
				<a href="#"><i class="fa fa-cog fa-2x"></i></a>
				<ul class="dropdown">
					<li><h1><?php echo $this->Html->link(__('Edit informations'), array('controller' => 'users', 'action' => 'edit', $userid)); ?></h1></li>
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

<section class="margin top-2">
	<div class="row max-width">
		<div class="large-12 columns">
			<h1><?= __('Admin Panel') ?></h1>
			<dl class="tabs" data-tab>
				<dd class="<?php echo $organizations_tab; ?>"><a href="#organizations"><?= __('Organizations') ?></a></dd>
				<dd class="<?php echo $missions_tab; ?>"><a href="#missions"><?= __('Missions') ?></a></dd>
				<?php if($flags['_admin']) echo '<dd class="<?php echo $levels_tab; ?>"><a href="#levels">'.__('Levels').'</a></dd>'; ?>
				<dd class="<?php echo $badges_tab; ?>"><a href="#badges"><?= __('Badges') ?></a></dd>
				<dd class="<?php echo $users_tab; ?>"><a href="#users"><?= __('Users') ?></a></dd>
				<?php if($flags['_admin']) echo '<dd class="<?php echo $media_tab; ?>"><a href="#media">'.__('Media').'</a></dd>'; ?>
				<dd class="<?php echo $statistics_tab; ?>"><a href="#statistics"><?= __('Statistics') ?></a></dd>
			</dl>
			<div class="tabs-content">
				<div class="content <?php echo $organizations_tab; ?>" id="organizations">
					<?php
						if($flags['_admin']) :
							echo '<h4>'. __('Organizations in EVOKE:') .'</h4>';
						else :
							echo '<h4>'. __('My organizations in EVOKE:') .'</h4>';
						endif;
					?>
					<table class="paginated">
						<?php foreach ($organizations as $organization) { ?>
							<tr>
								<td><?php echo $this->Html->Link($organization['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $organization['Organization']['id'])); ?></td>
								<td><?php echo $this->Html->Link(__('Edit'), array('controller' => 'organizations', 'action' => 'edit', $organization['Organization']['id']), array( 'class' => 'button tiny')) . $this->Form->PostLink(__('Delete'), array('controller' => 'organizations', 'action' => 'delete', $organization['Organization']['id']), array( 'class' => 'button tiny alert')); ?></td>
								</tr>
						<?php }	?>
					</table>

					<button class="button small" data-reveal-id="myModalOrganization" data-reveal><?php echo __('New Organization');?></button>
					<div id="myModalOrganization" class="reveal-modal tiny" data-reveal>
						<?php echo $this->Form->create('Organization', array(
 						   		'url' => array(
 						   			'controller' => 'panels',
 						   			'action' => 'add_org')
								)); ?>
						<fieldset>
							<legend><?php echo __('Add an Organization'); ?></legend>
							<?php
								echo $this->Form->input('name', array('label' => __('Name'), 'required' => true));
								echo $this->Form->input('birthdate', array('label' => __('Birthdate')));
								echo $this->Form->input('description', array('label' => __('Description'), 'required' => true));
								echo $this->Form->input('website', array('label' => __('Website')));
								echo $this->Form->input('facebook');
								echo $this->Form->input('twitter');
								echo $this->Form->input('blog');
								if($flags['_admin']) {
									//if its an admin, use $possible_managers..
									echo $this->Form->input('UserOrganization.users_id', array(
										'label' => __('Possible Managers'),
										'options' => $possible_managers,
										'multiple' => 'checkbox',
										'required' => true
									));
								} else {
									//else use my id
									echo $this->Form->hidden('UserOrganization.user_id', array('value' => $userid));
								}				
							?>
						</fieldset>
						<button class="button small" type="submit">
							<?php echo __('Add') ?>
						</button>
						<?php echo $this->Form->end(); ?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
				</div>
				<div class="content <?php echo $missions_tab; ?> large-12 columns" id="missions">
					<div class="large-2 columns filter">
			  			<fieldset>
			    			<legend><?= __('Issues') ?></legend>
			    			<ul id="filters">
			    			 	<?php foreach ($issues as $issue) { ?>
							    	<li>
							        	<input type="checkbox" checked="true" value="issue_<?php echo $issue['Issue']['id'];?>" id="filter-issue_<?php echo $issue['Issue']['id'];?>" />
							        	<label for="filter-issue_<?php echo $issue['Issue']['id'];?>">
							        		<?php echo $issue['Issue']['name']; ?>
							        	</label>
							        	<?php if($flags['_admin']) echo $this->Form->PostLink('[x]', array('controller' => 'panels', 'action' => 'delete_issue', $issue['Issue']['id']));?>
							    	</li>
							    <?php } ?>
							</ul>

			    			<?php if($flags['_admin']) : ?>
			    				<button class="button tiny" data-reveal-id="myModalIssue" data-reveal><?php echo __('New Issue');?></button>
			    				<div id="myModalIssue" class="reveal-modal tiny" data-reveal>
									<?php echo $this->Form->create('Issue', array(
		 							   		'url' => array(
		 							   			'controller' => 'panels',
		 							   			'action' => 'add_issue')
											)); ?>
									<fieldset>
										<legend><?php echo __('Add an Issue'); ?></legend>
										<?php
											//echo $this->Form->input('parent_id');
											echo $this->Form->input('name', array('label' => __('Name')));
											echo $this->Form->input('slug', array('label' => __('Slug')));
										?>
									</fieldset>
									<button class="button small" type="submit">
										<?php echo __('Add'); ?>
									</button>
									<?php echo $this->Form->end(); ?>
									<a class="close-reveal-modal">&#215;</a>
								</div>
			    			<?php endif; ?>
						</fieldset>
					</div>
					<div class="large-8 columns filteredContent">
						<?php echo $this->Html->Link(__('Add new Mission'), array('controller' => 'panels', 'action' => 'add_mission'), array( 'class' => 'button'));?>
				  		<table> <!-- class="paginated"> -->
					  		<?php foreach ($missions_issues as $mi) : ?>
					  			<!-- colocar paginação -->
								<tr class="<?php foreach ($mi['MissionIssue'] as $i) echo ' issue_'.$i['issue_id'];?>">
									<td><?php echo $this->Html->Link($mi['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $mi['Mission']['id'], 1)); ?></td>
									<td><?php echo $this->Html->Link(__('Edit'), array('controller' => 'panels', 'action' => 'edit_mission', $mi['Mission']['id']), array( 'class' => 'button tiny')) . $this->Form->PostLink(__('Delete'), array('controller' => 'missions', 'action' => 'delete', $mi['Mission']['id']), array( 'class' => 'button tiny alert')); ?></td>
								</tr>
							<?php endforeach; ?>
						</table>
					</div>
				</div>
				<div class="content <?php echo $levels_tab; ?>" id="levels">
					<p>Not defined.. levels details go here.</p>
				</div>
				<div class="content <?php echo $badges_tab; ?>" id="badges">
					<button class="button small" data-reveal-id="myModalBadge" data-reveal><?php echo __('New Badge');?></button>
					<div id="myModalBadge" class="reveal-modal tiny" data-reveal>
						<?php echo $this->Form->create('Badge', array(
 						   		'url' => array(
 						   			'controller' => 'panels',
 						   			'action' => 'add_badge')
								)); ?>
							<fieldset>
								<legend><?php echo __('Add a Badge'); ?></legend>
							<?php
								echo $this->Form->input('name', array('label' => __('Name'), 'required' => true));
								echo $this->Form->input('description', array('label' => __('Description'), 'required' => true));
								echo $this->Form->input('organization_id', array(
									'label' => __('Organization'),
									'options' => $organizations_list
								));
							?>
							</fieldset>
						<button class="button small" type="submit">
							<?php echo __('Add') ?>
						</button>
						<?php echo $this->Form->end(); ?>
						<a class="close-reveal-modal">&#215;</a>
					</div>
					<table class="paginated">
						<?php foreach ($badges as $badge) : ?>
							<tr>
								<td><?php echo $this->Html->Link($badge['Badge']['name'], array('controller' => 'badges', 'action' => 'view', $badge['Badge']['id'])); ?></td>
								<td><?php echo $this->Html->Link(__('Edit'), array('controller' => 'badges', 'action' => 'edit', $badge['Badge']['id']), array( 'class' => 'button tiny')) . $this->Form->PostLink(__('Delete'), array('controller' => 'badges', 'action' => 'delete', $badge['Badge']['id']), array( 'class' => 'button tiny alert')); ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
				<div class="content <?php echo $users_tab; ?>" id="users">
					<div class="large-2 columns filter">
			  			<fieldset>
			    			<?php if($flags['_admin']) : ?>
					    		<legend><?= __('Roles') ?></legend>
			    			 	<ul id="filters2">
					    		<?php foreach ($roles as $role) : ?>
								    <li>
								       	<input type="checkbox" checked="true" value="role_<?php echo $role['Role']['id'];?>" id="filter-role_<?php echo $role['Role']['id'];?>" />
								       	<label for="filter-role_<?php echo $role['Role']['id'];?>">
								       		<?php echo $role['Role']['name'];?>
								       	</label>
								    </li>
							<?php endforeach; ?>
							<?php else : ?>
					    		<legend><?= __('My Missions') ?></legend>
			    			 	<ul id="filters2">
					    		<?php foreach ($missions_issues as $mission) : ?>
									<li>
								       	<input type="checkbox" checked="true" value="mission_<?php echo $mission['Mission']['id'];?>" id="filter-mission_<?php echo $mission['Mission']['id'];?>" />
								       	<label for="filter-mission_<?php echo $mission['Mission']['id'];?>">
								       		<?php echo $mission['Mission']['title'];?>
								       	</label>
								    </li>
								<?php endforeach; ?>
							<?php endif; ?>
							</ul>
						</fieldset>
					</div>
					<div class="large-8 columns filteredContent">
						<input placeholder="<?= __('Search by name') ?>..." id="box" type="text" /> 
						<ul class='userList'>
							<!-- colocar paginação -->
							<?php if($flags['_admin']) :
								foreach ($all_users as $user) : ?>
									<li class="role_<?php echo $user['User']['role_id'];?> <?php echo str_replace(' ', '_', $user['User']['name']); ?> shownR shownN">
										<?php echo $this->Html->Link($user['User']['name'], array('controller' => 'users', 'action' => 'view', $user['User']['id'])) . ' | ' . "<a href='#' data-reveal-id='user-". $user['User']['id'] ."' data-reveal>" . __('permissions') . "</a>" ; ?>
									</li>

									<!-- Lightbox for editing user role -->
									<div id="user-<?php echo $user['User']['id']; ?>" class="reveal-modal tiny" data-reveal>
										<?php 
											echo $this->Form->create('User', array(
										 		'url' => array(
										 			'controller' => 'panels',
										 			'action' => 'edit_user_role', 
										 			$user['User']['id']
										 		)
											));
										 ?>
										<fieldset>
											<legend><?php echo __('Change role') .': '. $user['User']['name']; ?></legend>
										<?php
											echo $this->Form->hidden('id', array('value' => $user['User']['id']));
											echo $this->Form->input('role_id', array(
												'label' => __('Role'),
												'options' => $roles_list,
												'value' => $user['User']['role_id']
											));
										?>
										</fieldset>
											<button class="button tiny" type="submit">
												<?php echo __('Save Changes')?>
											</button>
											<?php echo $this->Form->end(); ?>
										<a class="close-reveal-modal">&#215;</a>
									</div>
								<?php endforeach; ?>
							<?php else :
									foreach ($users_of_my_missions as $user) : ?>
										<!-- colocar paginação -->
										<li class="mission_<?php echo $user['UserMission']['mission_id'];?> <?php echo str_replace(' ', '_', $user['User']['name']); ?> shownR shownN">
											<?php echo $this->Html->Link($user['User']['name'], array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?>
										</li>
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<div class="content <?php echo $media_tab; ?>" id="media">
					<p>Upload videos/images and choose actions that triggers them...</p>
				</div>
				<div class="content <?php echo $statistics_tab; ?>" id="statistics">
					<p><?php echo __('Users') . ": " . sizeof($all_users);?></p>
					<p><?php echo __('Groups') . ": " . sizeof($groups);?></p>
					<p><?php echo __('Organizations') . ": " . sizeof($organizations);?></p>
					<p><?php echo __('Badges') . ": ".sizeof($badges);?></p>
					<p>AND MORE!</p>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
	echo $this->Html->script('panels');
?>