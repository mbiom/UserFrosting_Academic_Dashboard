<div class="post simple" id="p<?php echo context::global_filter($_ctx->posts->post_id,0,0,0,0,0,0,'EntryID'); ?>" role="article">
	<h2 class="post-title"><?php echo context::global_filter($_ctx->posts->post_title,1,0,0,0,0,0,'EntryTitle'); ?></h2>

	<div class="post-meta">
		<p class="post-info">
			<span class="post-author"><?php echo __('By'); ?> <?php echo context::global_filter($_ctx->posts->getAuthorLink(),0,0,0,0,0,0,'EntryAuthorLink'); ?>, </span>
			<span class="post-date"><?php echo context::global_filter($_ctx->posts->getDate('',''),0,0,0,0,0,0,'EntryDate'); ?>. </span>
			<span class="post-permalink"><a href="<?php echo context::global_filter($_ctx->posts->getURL(),0,0,0,0,0,0,'EntryURL'); ?>"><?php echo __('Permalink'); ?></a></span>
			<?php if($_ctx->posts->cat_id) : ?>
				<span class="post-cat"><?php
$_ctx->categories = $core->blog->getCategoryParents($_ctx->posts->cat_id);
while ($_ctx->categories->fetch()) : ?><a
				href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("category",$_ctx->categories->cat_url),0,0,0,0,0,0,'CategoryURL'); ?>"><?php echo context::global_filter($_ctx->categories->cat_title,1,0,0,0,0,0,'CategoryTitle'); ?></a> › <?php endwhile; $_ctx->categories = null; ?><a
				href="<?php echo context::global_filter($_ctx->posts->getCategoryURL(),0,0,0,0,0,0,'EntryCategoryURL'); ?>"><?php echo context::global_filter($_ctx->posts->cat_title,1,0,0,0,0,0,'EntryCategory'); ?></a></span>
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
	</div>

	<?php if ($core->hasBehavior('publicEntryBeforeContent')) { $core->callBehavior('publicEntryBeforeContent',$core,$_ctx);} ?>

	<?php if($_ctx->posts->isExtended()) : ?>
		<div class="post-excerpt"><?php echo context::global_filter($_ctx->posts->getExcerpt(0),0,0,0,0,0,0,'EntryExcerpt'); ?></div>
	<?php endif; ?>

	<div class="post-content"><?php echo context::global_filter($_ctx->posts->getContent(0),0,0,0,0,0,0,'EntryContent'); ?></div>

	<?php if ($core->hasBehavior('publicEntryAfterContent')) { $core->callBehavior('publicEntryAfterContent',$core,$_ctx);} ?>

<?php
if ($_ctx->posts !== null && $core->media) {
$_ctx->attachments = new ArrayObject($core->media->getPostMedia($_ctx->posts->post_id,null,"attachment"));
?>
<?php foreach ($_ctx->attachments as $attach_i => $attach_f) : $GLOBALS['attach_i'] = $attach_i; $GLOBALS['attach_f'] = $attach_f;$_ctx->file_url = $attach_f->file_url; ?>
	<?php if ($attach_i == 0) : ?>
	<div class="post-attachments" id="attachments">
		<h3 class="post-attachments-title"><?php echo __('Attachments'); ?></h3>
		<ul class="post-attachments-list">
	<?php endif; ?>
				<li class="post-attachments-item <?php echo context::global_filter($attach_f->media_type,0,0,0,0,0,0,'AttachmentType'); ?>">
					<?php if($attach_f->type_prefix == "audio") : ?>
						<?php try { echo $core->tpl->getData('_audio_player.html'); } catch (Exception $e) {} ?>

					<?php endif; ?>
					<?php if($attach_f->type_prefix == "video") : ?>
						<?php if($attach_f->type != "video/x-flv") : ?>
							<?php try { echo $core->tpl->getData('_video_player.html'); } catch (Exception $e) {} ?>

						<?php else: ?>
							<?php try { echo $core->tpl->getData('_flv_player.html'); } catch (Exception $e) {} ?>

						<?php endif; ?>
					<?php endif; ?>
					<?php if($attach_f->type_prefix != "audio" && $attach_f->type_prefix != "video") : ?>
						<a href="<?php echo context::global_filter($attach_f->file_url,0,0,0,0,0,0,'AttachmentURL'); ?>"
						 title="<?php echo context::global_filter($attach_f->basename,0,0,0,0,0,0,'AttachmentFileName'); ?> (<?php echo context::global_filter(files::size($attach_f->size),0,0,0,0,0,0,'AttachmentSize'); ?>)"><?php echo context::global_filter($attach_f->media_title,0,0,0,0,0,0,'AttachmentTitle'); ?></a>
					<?php endif; ?>
				</li>
	<?php if ($attach_i+1 == count($_ctx->attachments)) : ?>
			</ul>
		</div>
	<?php endif; ?>
<?php endforeach; $_ctx->attachments = null; unset($attach_i,$attach_f,$_ctx->file_url); ?><?php } ?>

</div>
