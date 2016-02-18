<?php
	$this->start('topbar');
	echo $this->element('top-bar');
	$this->end();
?>

<div class = "evoke profile">
	<div class = "bg" style = "height: 450px">
<!--		<img src = '<?= $this->webroot.'img/user_avatar.jpg' ?>' style = "height:150px; border-radius:50%; margin-top:30px">-->
        
        <div id="example"></div>
        
        <div class="row text-center">
          <div class="large-4 small-centered columns">
            <img src = '<?= $this->webroot.'img/user_avatar.jpg' ?>' style = "height:150px; border-radius:50%; margin-top:30px" class = "text-center">
            <h3 class = "margin-top-1em text-center font-green font-weight-bold"><?= $user['User']['name'] ?></h3>
            <p class = "text-center"><?= $user['User']['mini_biography'] ?></p>

            <div class = "text-align-center"><?php echo $this->element('social_networks_bar', array('social_networks_user' => $user['User'])) ?></div>
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
            <!-- <div class = "left margin-left-3em">
                <?php echo $this->element('level_progress_bar', array('class' => 'margin left-1 right-1 top-05')); ?>
            </div> -->

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
					<a class="button small" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?>">
                        <?php echo __('Edit profile'); ?>
                    </a>

				<?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row margin-top-1em">
    <div class="row">
        <div class="large-3 columns">

					<div class = "gray-block margin-bottom-1em">
							<h3 class = "font-green uppercase font-weight-bold"><?= __('My Allies') ?></h3>

							<?php if (count($friends) > 0): ?>
							<ul class="full-width small-block-grid-1">

								<?php
										$counter = 0;
										foreach($friends as $ally):
											 ?>
											<li class="text-center">
												<!-- PICTURE -->

												<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $ally['Friend']['id'], false)); ?>">

													<?= $this->Picture->showUserCircularPicture(
														$ally['Friend'],
														'square-60px',
														__("%s's profile picture",$ally['Friend']['name'])
													); ?>

													<p class="text-center text-glow-on-hover"><?= $ally['Friend']['name'] ?></p>
												</a>

												<!-- MODAL USER BIOGRAPHY -->
												<?php echo $this->element('user_biography', array('modal' => true, 'counter' => $counter, 'user' => $ally, 'add_button' => false)); ?>
											</li>
										<?php
											$counter++;
										endforeach;
									?>
							</ul>

							<?php //Doesn't have allies and it's not me
							elseif ($user['User']['id'] != $users['User']['id']): ?>
								<div data-alert="" class="alert-box radius">
									<?= __('This user has no allies yet.') ?>
								</div><?php

							//Doesn't have allies and it's me
							else: ?>
								<div data-alert="" class="alert-box radius">
									<?= __('You have no allies! Get started looking at people similar to you!') ?>
								</div><?php
							endif; ?>

						<a class="button small" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view_all')); ?>"><?php echo __('SEE ALL USERS'); ?></a>

				</div>

            <div class = "gray-block margin-bottom-1em">
                <h3 class = "font-green uppercase font-weight-bold"><?= __('Potential Allies') ?></h3>
                <ul class="full-width small-block-grid-1">

								<?php
									$counter = 0;
									foreach($similar_users as $similar_user): ?>

									<li>
										<!-- PANEL -->
										<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile', $similar_user['User']['id'], false)); ?>">

											<div class="table full-width profile-content padding top-1">
												<!-- USER PICTURE -->
						          	<div class="table-cell vertical-align-middle square-40px">
													<?= $this->Picture->showUserCircularPicture(
														$similar_user['User'],
														'square-40px',
														__("%s's profile picture",$similar_user['User']['name'])
													); ?>
												</div>

												<!-- USER INFO -->
												<div class="table-cell vertical-align-middle padding left-1">
													<?= $similar_user['User']['name'] ?>
													<small>Level <?= $similar_user['User']['level'] ?></small>
												</div>
											</div>
										</a>

										<!-- VIEW AGENT DETAILS MODAL -->
										<?php echo $this->element('user_biography', array('modal' => true, 'counter' => 'PotentialAllies'.$counter, 'user' => $similar_user, 'add_button' => true)); ?>
									</li>

								<?php
									$counter++;
								endforeach;
								?>
							</ul>

              <a class="button small" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view_all')); ?>"><?php echo __('SEE ALL USERS'); ?></a>

          </div>

        </div>
        <div class="large-6 columns">

            <div class = "gray-block margin-bottom-1em">
                <h3 class = "font-green uppercase font-weight-bold"><?= __('Your Superhero Identity is: %s ', $superhero['SuperheroIdentity']['name']) ?></h3>
                <p><?php if(!empty($superhero['SuperheroIdentity']['description'])) $superhero['SuperheroIdentity']['description'] ?></p>
            </div>

            <div class = "gray-block margin-bottom-1em">
                <h3 class = "font-green uppercase font-weight-bold"><?= __('About me') ?></h3>
                <p><?= $user['User']['biography'] ?></p>
            </div>

        </div>
        <div class="large-3 columns">

            <div class = "gray-block margin-bottom-1em">
                <h3 class = "font-green uppercase font-weight-bold"><?= __('Badges') ?></h3>
								<?php echo $this->element('badges'); ?>
            </div>

            <div class = "gray-block margin-bottom-1em">
                <h3 class = "font-green uppercase font-weight-bold"><?= __('Leaderboard') ?></h3>
                <?php echo $this->element('leaderboard'); ?>
            </div>

        </div>
    </div>
</div>

<!-- The core React library -->
<script src="https://fb.me/react-0.14.7.js"></script>
<!-- The ReactDOM Library -->
<script src="https://fb.me/react-dom-0.14.7.js"></script>

<script type="text/jsx">
    
    var Counter = React.createClass({  incrementCount: function(){    this.setState({      count: this.state.count + 1    });  },  getInitialState: function(){     return {       count: 0     }  },  render: function(){    return (      <div className="counter">        <h1>{this.state.count}</h1>        <button type="button" onClick={this.incrementCount}>Increment</button>      </div>    );  }});React.renderComponent(<Counter/>, document.getElementById('example'));
);

    
</script>