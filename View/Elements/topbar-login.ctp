<!-- Form with Foundation validation -->
<?php echo $this->Form->create('User', array('data-abide',
											 'url' => array('controller' => 'users', 'action' => 'login'))); ?>

<ul class="<?php echo isset($ulClass) ? $ulClass : ''; ?>">
	<!-- USERNAME, PASSWORD, AND SUBMIT BUTTON -->
	<li>
		<div class="column">
			<?php 
				echo $this->Form->input('username', array('label' => false, 'type' => 'text', 'placeholder' =>  __('username'), 'class' => 'radius', 'required' => true));
			?>
		</div>
	</li>
	<li>
		<div class="column">
			<?php 
				echo $this->Form->input('password', array('label' => false, 'type' => 'password', 'placeholder' =>  __('password'), 'class' => 'radius', 'required'));
			?>
		</div>
	</li>
	<li>
		<div class="column">
			<button type="submit"><?php echo __('Sign in'); ?></button>
		</div>
	</li>

	<!-- OTHER SIGN IN METHODS -->
	<li>
		<div class="right">
			<?php echo __('OR'); ?>

			<a href="<?php echo $fbLoginUrl; ?>">
				<span class="fa-stack fa-lg">
					<i class="fa fa-square fa-stack-2x evoke login facebook-icon"></i>
					<i class="fa fa-facebook fa-stack-1x fa-inverse "></i>
				</span>
			</a>

			<a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'google_login')); ?>">
				<span class="fa-stack fa-lg">
					<i class="fa fa-square fa-stack-2x evoke login google-icon"></i>
					<i class="fa fa-google-plus fa-stack-1x fa-inverse "></i>
				</span>
			</a>
		</div>
	</li>
	<!-- FORGOT PASSWORD (NOT USED FOR NOW) -->
	<!--<a href = "#" class = "evoke login password"><?php //echo __('Forgot your password?');?></a> -->
	<!--send to correct address-->
</ul>
<?php echo $this->Form->end(); ?>