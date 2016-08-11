<div id="p<?php echo context::global_filter($_ctx->posts->post_id,0,0,0,0,0,0,'EntryID'); ?>" class="post <?php if (($_ctx->posts->index()+1)%2 == 1) { echo 'odd'; } ?> <?php if ($_ctx->posts->index() == 0) { echo 'first'; } ?> full" lang="<?php if ($_ctx->posts->post_lang) { echo context::global_filter($_ctx->posts->post_lang,0,0,0,0,0,0,'EntryLang'); } else {echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'EntryLang'); } ?>" role="article">

	<?php if ($_ctx->posts->firstPostOfDay()) : ?><p class="post-day-date"><?php echo context::global_filter($_ctx->posts->getDate('',''),0,0,0,0,0,0,'EntryDate'); ?></p><?php endif; ?>

	<h2 class="post-title"><a href="<?php echo context::global_filter($_ctx->posts->getURL(),0,0,0,0,0,0,'EntryURL'); ?>"><?php echo context::global_filter($_ctx->posts->post_title,1,0,0,0,0,0,'EntryTitle'); ?></a></h2>

	<?php if ($core->hasBehavior('publicEntryBeforeContent')) { $core->callBehavior('publicEntryBeforeContent',$core,$_ctx);} ?>

	<?php if($_ctx->posts->isExtended()) : ?>
	<div class="post-excerpt"><?php echo context::global_filter($_ctx->posts->getExcerpt(0),0,0,0,0,0,0,'EntryExcerpt'); ?></div>
	<?php endif; ?>

	<div class="post-content"><?php echo context::global_filter($_ctx->posts->getContent(0),0,0,0,0,0,0,'EntryContent'); ?></div>

	<?php if ($core->hasBehavior('publicEntryAfterContent')) { $core->callBehavior('publicEntryAfterContent',$core,$_ctx);} ?>

	<div class="post-meta">
		<p class="post-info">
			<span class="post-author"><?php echo __('By'); ?> <?php echo context::global_filter($_ctx->posts->getAuthorLink(),0,0,0,0,0,0,'EntryAuthorLink'); ?>, </span>
			<span class="post-date"><?php echo context::global_filter($_ctx->posts->getDate('',''),0,0,0,0,0,0,'EntryDate'); ?>.</span>
			<?php if($_ctx->posts->cat_id) : ?>
			<span class="post-cat"><?php
$_ctx->categories = $core->blog->getCategoryParents($_ctx->posts->cat_id);
while ($_ctx->categories->fetch()) : ?><a
				href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("category",$_ctx->categories->cat_url),0,0,0,0,0,0,'CategoryURL'); ?>"><?php echo context::global_filter($_ctx->categories->cat_title,1,0,0,0,0,0,'CategoryTitle'); ?></a> › <?php endwhile; $_ctx->categories = null; ?><a
				href="<?php echo context::global_filter($_ctx->posts->getCategoryURL(),0,0,0,0,0,0,'EntryCategoryURL'); ?>"><?php echo context::global_filter($_ctx->posts->cat_title,1,0,0,0,0,0,'EntryCategory'); ?></a>
			</span>
			<?php endif; ?>
		</p>

		<?php
$_ctx->meta = $core->meta->getMetaRecordset($_ctx->posts->post_meta,'tag'); $_ctx->meta->sort('meta_id_lower','asc'); ?><?php while ($_ctx->meta->fetch()) : ?>
			<?php if ($_ctx->meta->isStart()) : ?>
			<ul class="post-tags-list">
			<?php endif; ?>
				<li class="post-tags-item"><a href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("tag",rawurlencode($_ctx->meta->meta_id)),0,0,0,0,0,0,'TagURL'); ?>"><?php echo context::global_filter($_ctx->meta->meta_id,0,0,0,0,0,0,'TagID'); ?></a></li>
			<?php if ($_ctx->meta->isEnd()) : ?>
			</ul>
			<?php endif; ?>
		<?php endwhile; $_ctx->meta = null; ?>

		<?php if(($_ctx->posts->hasComments() || $_ctx->posts->commentsActive()) || ($_ctx->posts->hasTrackbacks() || $_ctx->posts->trackbacksActive()) || $_ctx->posts->countMedia('attachment')) : ?>
			<p class="post-info-co">
			<?php if(($_ctx->posts->hasComments() || $_ctx->posts->commentsActive())) : ?>
			<a href="<?php echo context::global_filter($_ctx->posts->getURL(),0,0,0,0,0,0,'EntryURL'); ?>#comments" class="comment_count"><?php if ($_ctx->posts->nb_comment == 0) {
  printf(__('no comments'),$_ctx->posts->nb_comment);
} elseif ($_ctx->posts->nb_comment == 1) {
  printf(__('one comment'),$_ctx->posts->nb_comment);
} else {
  printf(__('%d comments'),$_ctx->posts->nb_comment);
} ?></a>
			<?php endif; ?>
			<?php if(($_ctx->posts->hasTrackbacks() || $_ctx->posts->trackbacksActive())) : ?>
			<a href="<?php echo context::global_filter($_ctx->posts->getURL(),0,0,0,0,0,0,'EntryURL'); ?>#pings" class="ping_count"><?php if ($_ctx->posts->nb_trackback == 0) {
  printf(__('no trackbacks'),$_ctx->posts->nb_trackback);
} elseif ($_ctx->posts->nb_trackback == 1) {
  printf(__('one trackback'),$_ctx->posts->nb_trackback);
} else {
  printf(__('%d trackbacks'),$_ctx->posts->nb_trackback);
} ?></a><?php endif; ?>
			<?php if($_ctx->posts->countMedia('attachment')) : ?>
			<a href="<?php echo context::global_filter($_ctx->posts->getURL(),0,0,0,0,0,0,'EntryURL'); ?>#attachments" class="attach_count"><?php if ($_ctx->posts->countMedia('attachment') == 0) {
  printf(__('no attachments'),$_ctx->posts->countMedia('attachment'));
} elseif ($_ctx->posts->countMedia('attachment') == 1) {
  printf(__('one attachment'),$_ctx->posts->countMedia('attachment'));
} else {
  printf(__('%d attachments'),$_ctx->posts->countMedia('attachment'));
} ?></a><?php endif; ?>
			</p>
		<?php endif; ?>
	</div>
</div>
