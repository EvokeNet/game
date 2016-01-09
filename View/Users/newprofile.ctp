<?php
	$this->start('topbar');
	echo $this->element('top-bar');
	$this->end();
?>

<div class = "evoke profile">
	<div class = "bg" style = "height: 450px">
<!--		<img src = '<?= $this->webroot.'img/user_avatar.jpg' ?>' style = "height:150px; border-radius:50%; margin-top:30px">-->
        
        <div class="row">
          <div class="small-8 large-centered columns">
            <img src = '<?= $this->webroot.'img/user_avatar.jpg' ?>' style = "height:150px; border-radius:50%; margin-top:30px" class = "text-center">
            <h3 class = "margin-top-1em text-center font-green font-weight-bold"><?= $user['User']['name'] ?></h3>
            <p class = "text-center"><?= $user['User']['mini_biography'] ?></p>
              
            <?php echo $this->element('social_networks_bar', array('social_networks_user' => $user['User'])) ?>
          </div>
        </div>
        
        <div class="strip clearfix">
            <div class = "left margin-left-3em">
                <label class = "font-green uppercase font-weight-bold">
                    <?= __('Date of Birth') ?>
                    <h5><?= date("F j, Y", strtotime($user['User']['birthdate'])) ?></h5>
                </label>                
            </div>
            <div class = "left margin-left-3em">
                <label class = "font-green uppercase font-weight-bold">
                    <?= __('Country') ?>
                    <h5><?= $user['User']['country'] ?></h5>
                </label>                
            </div>
            <div class = "left margin-left-3em">
                <?php echo $this->element('level_progress_bar', array('class' => 'margin left-1 right-1 top-05')); ?>              
            </div>
            
            <div class = "right margin-left-2em">
                <!-- IF NOT AN ALLY -->
                <?php if(empty($is_friend) && ($user['User']['id'] != $users['User']['id'])): ?>
					<a class="button small" href="<?php echo $this->Html->url(array('controller' => 'UserFriends', 'action' => 'add', $user['User']['id'], $loggedInUser['id'], false)); ?>">
                        <?php echo __('Add Ally'); ?>
                    </a>

				<!-- ALREADY AN ALLY -->
				<?php elseif(!empty($is_friend) && ($user['User']['id'] != $users['User']['id'])): ?>
					<a class="button small disabled" href="<?php echo $this->Html->url(array('controller' => 'UserFriends', 'action' => 'add', $user['User']['id'], $loggedInUser['id'], false)); ?>">
                        <?php echo __('Already an ally!'); ?>
                    </a>
                
                <?php elseif($user['User']['id'] == $users['User']['id']): ?>
					<a class="button small" href="<?php echo $this->Html->url(array('controller' => 'UserFriends', 'action' => 'add', $user['User']['id'], $loggedInUser['id'], false)); ?>">
                        <?php echo __('Edit profile'); ?>
                    </a>
                
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row margin-top-1em">
    <div class="row">
        <div class="small-3 columns">

            <div style = "background-color:#202023; border-radius:7px; padding: 20px; margin-bottom:2em">
                <h3 class = "font-green uppercase font-weight-bold"><?= __('Potential Allies') ?></h3>
                <p><?= $user['User']['biography'] ?></p>
            </div>

        </div>
        <div class="small-6 columns">
          
            <div style = "background-color:#202023; border-radius:7px; padding: 20px; margin-bottom:2em">
                <h3 class = "font-green uppercase font-weight-bold"><?= __('You are: %s agent!', $superhero['SuperheroIdentity']['name']) ?></h3>
                <p><?= __('Congratulations, Agent! Most do not make it this far. Your profile shows great promise.') ?></p>
            </div>

            <div style = "background-color:#202023; border-radius:7px; padding: 20px; margin-bottom:2em">
                <h3 class = "font-green uppercase font-weight-bold"><?= __('About me') ?></h3>
                <p><?= $user['User']['biography'] ?></p>
            </div>

        </div>
        <div class="small-3 columns">
            
            <div style = "background-color:#202023; border-radius:7px; padding: 20px; margin-bottom:2em">
                <h3 class = "font-green uppercase font-weight-bold"><?= __('Badges') ?></h3>
            </div>
            
            <div style = "background-color:#202023; border-radius:7px; padding: 20px; margin-bottom:2em">
                <h3 class = "font-green uppercase font-weight-bold"><?= __('Leaderboard') ?></h3>
            </div>
            
        </div>
    </div>
</div>
