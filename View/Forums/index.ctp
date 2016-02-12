<?php
/* CSS */
	echo $this->Html->css('forums');

/* Top bar */
	$this->start('topbar');
	echo $this->element('top-bar');
	$this->end();
?>

<div class="centering-block">

	<!-- HEAD -->
	<div class="forums index">

		<div>
			<h2 class="evoke text-glow"><?php echo __('Forums'); ?></h2>

			<!-- PAGING -->
			<div class="forums paging">
				<?= $this->Paginator->prev('<<',array('class' => 'button thin')) ?>
				<?= $this->Paginator->numbers(array('separator' => ' ','class' => 'button thin')) ?>
				<?= $this->Paginator->next('>>',array('class' => 'button thin')) ?>
			</div>
		</div>

	</div>	

	<!-- FORUMS -->
	<d1 class="accordion forums accordion" data-accordion>

	<?php foreach ($forums as $forum): ?>
		<dd class="accordion-navigation">
			<a class = "forums title" href="#forum<?= $forum['Forum']['id'] ?>">
				<i class="fa fa-quote-right fa-2x text-color-highlight padding right-1"></i><?= $forum['Forum']['title'] ?>
			</a>
			<div class="content forums content" id="forum<?= $forum['Forum']['id'] ?>">
				<div class="forums description"><?= $forum['Forum']['description'] ?> </div>

				<!-- FORUM'S CATEGORIES -->
				<div>
					<?php foreach ($forumCategories[$forum['Forum']['id']] as $forumCategory): ?>
					<div class="forums category">
						<div class="evoke text-glow forums category-title">
							<?= $forumCategory['ForumCategory']['title'] ?>
						</div>
						<div class="forums category-description">
							<?= $forumCategory['ForumCategory']['description'] ?>
						</div>
						<a class="button thin" href="/evoke/forum_categories/view/<?php echo $forumCategory['ForumCategory']['id']?>">
							Enter Forum Discussion
						</a>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</dd>
	<?php endforeach; ?>

	</d1>

	<!-- PAGING -->
	<div class="forums paging">
		<?= $this->Paginator->prev('<<',array('class' => 'button thin')) ?>
		<?= $this->Paginator->numbers(array('separator' => ' ','class' => 'button thin')) ?>
		<?= $this->Paginator->next('>>',array('class' => 'button thin')) ?>
	</div>
</div>