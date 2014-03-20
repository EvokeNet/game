<?php
	$this->extend('/Common/topbar');
	$this->start('menu');
?>

<nav class="top-bar" data-topbar>
	<ul class="title-area">
		<li class="name">
			<h1><a href="#">Agent <?php echo $username[0]; ?></a></h1>
		</li>
		<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
	</ul>

	<section class="top-bar-section">
		<!-- Right Nav Section -->
		<ul class="right">
			<li class="has-dropdown">
				<a href="#">Settings</a>
				<ul class="dropdown">
					<li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>">Sign out</a></li>
				</ul>
			</li>
		</ul>

		<!-- Left Nav Section -->
		<ul class="left">
			<li><a href="#">Dashboard</a></li>
		</ul>
	</section>
</nav>

<?php $this->end();?>

<section class="evoke margin top-2">
	<div class="row evoke max-width">
		<div class="large-12 columns">
			<h1>Admin Panel</h1>
			<dl class="tabs" data-tab>
				<dd class="<?php echo $organizations_tab; ?>"><a href="#organizations">Organizations</a></dd>
				<dd class="<?php echo $missions_tab; ?>"><a href="#missions">Missions</a></dd>
				<?php if($flags['_admin']) echo '<dd class="<?php echo $levels_tab; ?>"><a href="#levels">Levels</a></dd>'; ?>
				<dd class="<?php echo $badges_tab; ?>"><a href="#badges">Badges</a></dd>
				<dd class="<?php echo $users_tab; ?>"><a href="#users">Users</a></dd>
				<?php if($flags['_admin']) echo '<dd class="<?php echo $media_tab; ?>"><a href="#media">Media</a></dd>'; ?>
				<dd class="<?php echo $statistics_tab; ?>"><a href="#statistics">Statistics</a></dd>
			</dl>
			<div class="tabs-content">
				<div class="content <?php echo $organizations_tab; ?>" id="organizations">
					<?php echo $this->Form->submit('+ Organizations', array('id' => 'new_org', 'class' => 'button small')); ?>
						<div id="orgsForm">
							<?php echo $this->Form->create('Organization', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'add_org')
									)); ?>
							<fieldset>
								<legend><?php echo __('Add Organization'); ?></legend>
								<?php
									echo $this->Form->input('name');
									echo $this->Form->input('birthdate');
									echo $this->Form->input('description');
									echo $this->Form->input('website');
									echo $this->Form->input('facebook');
									echo $this->Form->input('twitter');
									echo $this->Form->input('blog');
									if($flags['_admin']) {
										//if its an admin, use $possible_managers..
										echo $this->Form->input('UserOrganization.users_id', array(
											'options' => $possible_managers,
											'multiple' => 'checkbox'
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
						</div>

						<table class="paginated">
							<?php foreach ($organizations as $organization) { ?>
								<tr>
									<td><?php echo $this->Html->Link($organization['Organization']['name'], array('controller' => 'organizations', 'action' => 'view', $organization['Organization']['id'])); ?></td>
									<td><?php echo $this->Html->Link('edit', array('controller' => 'organizations', 'action' => 'edit', $organization['Organization']['id']), array( 'class' => 'button tiny')) . $this->Form->PostLink('delete', array('controller' => 'organizations', 'action' => 'delete', $organization['Organization']['id']), array( 'class' => 'button tiny alert')); ?></td>
									</tr>
							<?php }	?>
						</table>					
				</div>
				<div class="content <?php echo $missions_tab; ?> large-12 columns" id="missions">
					<div class="large-4 columns filter">
			  			<fieldset>
			    			<legend>Issues</legend>
			    			<?php if($flags['_admin']) echo $this->Form->submit('+ Issues', array('id' => 'new_issue', 'class' => 'button tiny')); ?>
			    			<ul id="filters">
			    			 	<?php foreach ($issues as $issue) { ?>
							    	<li>
							        	<input type="checkbox" checked="true" value="issue_<?php echo $issue['Issue']['id'];?>" id="filter-issue_<?php echo $issue['Issue']['id'];?>" />
							        	<label for="filter-issue_<?php echo $issue['Issue']['id'];?>">
							        		<?php echo $issue['Issue']['name']; ?>
							        	</label>
							        	<?php if($flags['_admin']) echo $this->Form->PostLink('delete', array('controller' => 'panels', 'action' => 'delete_issue', $issue['Issue']['id']));?>
							    	</li>
							    <?php } ?>
							</ul>
						</fieldset>
					</div>
					<div class="large-5 columns filteredContent">
						<!-- issues' hidden add form -->
						<div id="issuesForm">
							<?php echo $this->Form->create('Issue', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'add_issue')
									)); ?>
								<fieldset>
									<legend><?php echo __('Add Issue'); ?></legend>
								<?php
									//echo $this->Form->input('parent_id');
									echo $this->Form->input('name');
									echo $this->Form->input('slug');
								?>
								</fieldset>
							<button class="button small" type="submit">
								<?php echo __('Add'); ?>
							</button>
							<?php echo $this->Form->end(); ?>
						</div>

						<ul class="button-group">
				  			<li><?php echo $this->Html->Link('+ missions', array('controller' => 'panels', 'action' => 'add_mission'), array( 'class' => 'button'));?></li>
				  		</ul>
				  		<table>
					  		<?php foreach ($missions_issues as $mi) { ?>
					  			<!-- colocar paginação -->
								<tr class="<?php foreach ($mi['MissionIssue'] as $i) echo ' issue_'.$i['issue_id'];?>">
									<td><?php echo $this->Html->Link($mi['Mission']['title'], array('controller' => 'missions', 'action' => 'view', $mi['Mission']['id'])); ?></td>
									<td><?php echo $this->Html->Link('edit', array('controller' => 'panels', 'action' => 'edit_mission', $mi['Mission']['id']), array( 'class' => 'button tiny')) . $this->Form->PostLink('delete', array('controller' => 'missions', 'action' => 'delete', $mi['Mission']['id']), array( 'class' => 'button tiny alert')); ?></td>
								</tr>
							<?php }?>	
						</table>
					</div>
				</div>
				<div class="content <?php echo $levels_tab; ?>" id="levels">
					<p>Not defined.. levels details go here.</p>
				</div>
				<div class="content <?php echo $badges_tab; ?>" id="badges">
					<p>
						<?php echo $this->Form->submit('+ Badges', array('id' => 'new_badge', 'class' => 'button small')); ?>
						<div id="badgesForm">
							<?php echo $this->Form->create('Badge', array(
 							   		'url' => array(
 							   			'controller' => 'panels',
 							   			'action' => 'add_badge')
									)); ?>
								<fieldset>
									<legend><?php echo __('Add Badge'); ?></legend>
								<?php
									echo $this->Form->input('name');
									echo $this->Form->input('description');
									echo $this->Form->input('organization_id', array(
												'options' => $organizations_list
									));
								?>
								</fieldset>
							<button class="button small" type="submit">
								<?php echo __('Add') ?>
							</button>
							<?php echo $this->Form->end(); ?>
						</div>

						<table>				
							<?php foreach ($badges as $badge) { ?>
								<tr>
									<td><?php echo $this->Html->Link($badge['Badge']['name'], array('controller' => 'badges', 'action' => 'view', $badge['Badge']['id'])); ?></td>
									<td><?php echo $this->Html->Link('edit', array('controller' => 'badges', 'action' => 'edit', $badge['Badge']['id']), array( 'class' => 'button tiny')) . $this->Form->PostLink('delete', array('controller' => 'badges', 'action' => 'delete', $badge['Badge']['id']), array( 'class' => 'button tiny alert')); ?></td>
								</tr>
							<?php }	?>
						</table>
					</p>
				</div>
				<div class="content <?php echo $users_tab; ?>" id="users">
					<div class="large-5 columns filter evoke">
			  			<fieldset>
			    			<?php 
			    				if($flags['_admin']) {
					    	?>
					    			<legend>Roles</legend>
			    			 		<ul id="filters2">
					    	<?php 
					    			foreach ($roles as $role) { 
					    	?>
								    	<li>
								        	<input type="checkbox" checked="true" value="role_<?php echo $role['Role']['id'];?>" id="filter-role_<?php echo $role['Role']['id'];?>" />
								        	<label for="filter-role_<?php echo $role['Role']['id'];?>">
								        		<?php echo $role['Role']['name'];?>
								        	</label>
								    	</li>
							<?php
							   		}
							  	} else {
							?>
					    			<legend>My missions</legend>
			    			 		<ul id="filters2">
					    	<?php    	
							   		foreach ($missions_issues as $mission) {
							?>
										<li>
								        	<input type="checkbox" checked="true" value="mission_<?php echo $mission['Mission']['id'];?>" id="filter-mission_<?php echo $mission['Mission']['id'];?>" />
								        	<label for="filter-mission_<?php echo $mission['Mission']['id'];?>">
								        		<?php echo $mission['Mission']['title'];?>
								        	</label>
								    	</li>
							<?php
							   		}
							   	} 
							?>
							</ul>
						</fieldset>
					</div>
					<div class="large-6 columns filteredContent evoke">
						<input placeholder="Search user" id="box" type="text" /> 
						<ul class='userList'>
							<!-- colocar paginação -->
							<?php
								if($flags['_admin']) {
									foreach ($all_users as $user) { 
							?>
										<li class="role_<?php echo $user['User']['role_id'];?> <?php echo str_replace(' ', '', $user['User']['name']); ?> shownR shownN">
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
												<legend><?php echo __('Change role: '. $user['User']['name']); ?></legend>
											<?php
												echo $this->Form->hidden('id', array('value' => $user['User']['id']));
												echo $this->Form->input('role_id', array(
													'options' => $roles_list,
													'value' => $user['User']['role_id']
												));
												
											?>
												</fieldset>
												<button class="button tiny" type="submit">
													<?php echo __('Confirm')?>
												</button>
												<?php echo $this->Form->end(); ?>
											<a class="close-reveal-modal">&#215;</a>
										</div>
							<?php
									}
								} else {
									foreach ($users_of_my_missions as $user) {
							?>
										<!-- colocar paginação & filtragem por missions -->
										<li class="mission_<?php echo $user['UserMission']['mission_id'];?> <?php echo str_replace(' ', '', $user['User']['name']); ?> shownR shownN">
											<?php echo $this->Html->Link($user['User']['name'], array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?>
										</li>
							<?php
									}
								}
							?>
						</ul>
					</div>
				</div>
				<div class="content <?php echo $media_tab; ?>" id="media">
					<p>Upload videos/images and choose actions that triggers them...</p>
				</div>
				<div class="content <?php echo $statistics_tab; ?>" id="statistics">
					<p>Some statistics to view..</p>
					<p><?php echo "Users: " . sizeof($all_users);?></p>
					<p><?php echo "Groups: " . sizeof($groups);?></p>
					<p><?php echo "Organizations: " . sizeof($organizations);?></p>
					<p><?php echo "Badges: ".sizeof($badges);?></p>
					<p>AND MORE!</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- pagination scheme for org -->
<script type="text/javascript">
	$('table.paginated').each(function() {
	    var currentPage = 0;
	    var numPerPage = 2;
	    var $table = $(this);
	    $table.bind('repaginate', function() {
	        $table.find('tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
	    });
	    $table.trigger('repaginate');
	    var numRows = $table.find('tr').length;
	    var numPages = Math.ceil(numRows / numPerPage);
	    var $pager = $('<div class="pager"></div>');
	    for (var page = 0; page < numPages; page++) {
	        $('<span class="page-number"></span>').text(page + 1).bind('click', {
	            newPage: page
	        }, function(event) {
	            currentPage = event.data['newPage'];
	            $table.trigger('repaginate');
	            $(this).addClass('active').siblings().removeClass('active');
	        }).appendTo($pager).addClass('clickable');
	    }
	    $pager.insertBefore($table).find('span.page-number:first').addClass('active');
	});
</script>

<!-- issues & roles' filtering script -->
<script type="text/javascript">
	$("#filters :checkbox").click(function() {
	   	$("#filters :checkbox").each(function() {
	       	if($(this).is(':checked')) {
	            $("." + $(this).val()).fadeTo("slow", 1);
			} else {
	            $("." + $(this).val()).hide();
	        }
	 	});
	});

	$("#filters2 :checkbox").click(function() {
		$('#box').val('');
	   	$("#filters2 :checkbox").each(function() {
	       	if($(this).is(':checked')) {
   				$("." + $(this).val()).fadeTo("slow", 1);
		        $("." + $(this).val()).addClass("shownR");
			} else {
				$("." + $(this).val()).hide();
	            $("." + $(this).val()).removeClass("shownR");
	        }
	 	});
	});

	//filter by name
	$('#box').keyup(function(){
   		var valThis = $(this).val().toLowerCase();
   		valThis.replace(' ', '');
    	$('.userList>li').each(function(){
    		var text = $(this).attr('class').split(' ')[1].toLowerCase();
	        if(text.indexOf(valThis) > -1) {
	        	if($(this).hasClass('shownR')) {//only show if its supposed to be seen by role
	        		$(this).show();
	        		$(this).addClass('shownN');
		        }
	        } else {
	        	$(this).hide();
	        	//remove shownN
	        	$(this).removeClass('shownN');
	        } 
   		});
	});

</script>

<!-- hide and show '+ orgs', '+ badges', '+ issues' forms -->
<script type="text/javascript">
	$( document ).ready(function() {
  		$("#orgsForm").hide();
  		<?php //foreach ($organizations as $organization) echo  '$("#edit_org_'. $organization['Organization']['id'].'").hide();'; ?>

  		$("#badgesForm").hide();
  		$("#issuesForm").hide();
	});
	
	$("#new_org").click(function() {
	   	if($("#orgsForm").is(":visible")) {
	   		$("#orgsForm").hide();	
	   	} else {
	   		$("#orgsForm").fadeTo("slow", 1);
	   	}
	});

	$("#new_badge").click(function() {
	   	if($("#badgesForm").is(":visible")) {
	   		$("#badgesForm").hide();	
	   	} else {
	   		$("#badgesForm").fadeTo("slow", 1);
	   	}
	});

	$("#new_issue").click(function() {
	   	if($("#issuesForm").is(":visible")) {
	   		$("#issuesForm").hide();	
	   	} else {
	   		$("#issuesForm").fadeTo("slow", 1);
	   	}
	});
</script>