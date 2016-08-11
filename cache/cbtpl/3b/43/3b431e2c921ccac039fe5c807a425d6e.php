<?php
$params = $_ctx->post_params;
$_ctx->pagination = $core->blog->getPosts($params,true); unset($params);
?>
<?php if ($_ctx->pagination->f(0) > $_ctx->posts->count()) : ?>
	<p class="pagination">
		<?php if(!context::PaginationEnd()) : ?>
			<a href="<?php echo context::global_filter(context::PaginationURL(1),0,0,0,0,0,0,'PaginationURL'); ?>" class="prev">&#171; <?php echo __('previous entries'); ?></a> -
		<?php endif; ?>

		<?php echo __('page'); ?> <?php echo context::global_filter(context::PaginationPosition(0),0,0,0,0,0,0,'PaginationCurrent'); ?> <?php echo __('of'); ?> <?php echo context::global_filter(context::PaginationNbPages(),0,0,0,0,0,0,'PaginationCounter'); ?>

		<?php if(!context::PaginationStart()) : ?> - <a href="<?php echo context::global_filter(context::PaginationURL(-1),0,0,0,0,0,0,'PaginationURL'); ?>" class="next">
			<?php echo __('next entries'); ?> &#187;</a>
		<?php endif; ?>
	</p>
<?php endif; ?>
