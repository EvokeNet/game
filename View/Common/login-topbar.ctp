<section class="login-bg-topbar">

	<div class="row">
		<div class="large-12 columns">
			<h1><?php //echo strtoupper(__('Evoke'));?><img src = '<?= $this->webroot.'img/Logo-Evoke-Vectorizado.png' ?>' width = "60%"></h1>
			<h6><?php echo __('WELCOME TO EVOKE NETWORK');?></h6>
			<?php echo $this->fetch('menu'); ?>
		</div>
	</div>
</section>

<?php echo $this->fetch('content'); ?>