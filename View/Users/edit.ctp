<section class="evoke background-green padding top-2">
	<div class="row full-width">
		<div class="small-9 small-centered columns">

			<div class="row full-width">

			  <div class="small-3 medium-3 large-3 columns evoke no-padding">
			  <div class = "evoke edit-agent-tag">
			  		<div class = "evoke text-align">
			  			<h1><?= strtoupper(__('Evoke Account')) ?></h1>
			  			<img src="https://graph.facebook.com/<?php echo $user['User']['facebook_id']; ?>/picture?type=large" style = "margin: 10%; width: 40%;"/>
		  			</div>
		  			<div class = "evoke text-align">
			  			<i class="fa fa-upload fa-5x"></i>
		  			</div>

		  			<div class = "evoke border-bottom"></div>

			  		<div class = "evoke text-align dashboard agent info">
			  			<h5><?php echo __('Points');?>&nbsp;&nbsp;<div><?= $userPoints ?></div></h5>
				  		<h5><?php echo __('Level');?>&nbsp;&nbsp;&nbsp;<div><?= $userLevel ?></div></h5>
				  	</div>

				  	<div class = "evoke border-bottom"></div>

					<img src = "<?= $this->webroot.'img/circuit.png' ?>" width="100%" />
				</div>
			  </div>

			  <div class="small-9 medium-9 large-9 columns evoke no-padding">
			  	<div class="evoke edit-bg users form">
					<?php echo $this->Form->create('User', array('name' => 'editUser')); ?>
						<?php
							//echo $sumMyPoints;
							echo $this->Form->input('id');
							echo $this->Form->input('name', array('label' => __('Name'), 'class' => 'evoke'));
							echo $this->Form->input('username', array('label' => __('Username')));
							echo $this->Form->input('email', array('type' => 'email', 'required' => true));
							echo $this->Form->input('birthdate', array('type' => 'date', 'required' => true, 
								'dateFormat' => 'MDY',
						        'minYear'       => date('Y') - 100,
						        'maxYear'       => date('Y') - 20,
					        ));
							echo $this->Form->input('sex', array('type' => 'radio', 'options' => array(__('male'), __('female')), 'legend' => '', 'before' => '<label for = "UserSex">'.__('Sex').'</label>'));
							echo $this->Form->input('biography', array('required' => true, 'label' => __('Biography')));
							echo $this->Form->input('facebook');
							echo $this->Form->input('twitter');
							echo $this->Form->input('instagram');
							echo $this->Form->input('website', array('label' => __('Website')));
							echo $this->Form->input('blog');
							echo $this->Form->input('UserIssue.issue_id', array('class' => 'edit-user-issues', 'type' => 'select', 'multiple' => 'checkbox', 'selected' => $selectedIssues));
						?>
					<div class = "evoke text-align"><button type="submit" class= "evoke button general submit-button-margin margin top-2"><i class="fa fa-floppy-o fa-2x">&nbsp;&nbsp;</i><?= strtoupper(__('Save and proceed to your dashboard')) ?></button> </div>
				</div>
			  </div>

			</div>
		</div>
	</div>
</section>
