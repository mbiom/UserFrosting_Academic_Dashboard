<!DOCTYPE html>
<html lang="<?php echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'BlogLanguage'); ?>">
<head>
	
		<meta charset="UTF-8" />

		
			<title><?php echo context::global_filter($core->blog->name,1,0,0,0,0,0,'BlogName'); ?><?php if(!context::PaginationStart()) : ?> - <?php echo __('page'); ?> <?php echo context::global_filter(context::PaginationPosition(0),0,0,0,0,0,0,'PaginationCurrent'); ?><?php endif; ?></title>
			<!-- head-title -->

		
			<meta name="copyright" content="<?php echo context::global_filter($core->blog->settings->system->copyright_notice,1,0,0,0,0,0,'BlogCopyrightNotice'); ?>" />
			
				<meta name="ROBOTS" content="<?php echo context::robotsPolicy($core->blog->settings->system->robots_policy,''); ?>" />
				<!-- meta-robots -->
			
				<meta name="description" lang="<?php echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'BlogLanguage'); ?>" content="<?php echo context::global_filter($core->blog->desc,1,0,180,0,0,0,'BlogDescription'); ?><?php if(!context::PaginationStart()) : ?> - <?php echo __('page'); ?> <?php echo context::global_filter(context::PaginationPosition(0),0,0,0,0,0,0,'PaginationCurrent'); ?><?php endif; ?>" />
				<meta name="author" content="<?php echo context::global_filter($core->blog->settings->system->editor,1,0,0,0,0,0,'BlogEditor'); ?>" />
				<meta name="date" content="<?php echo context::global_filter(dt::iso8601($core->blog->upddt,$core->blog->settings->system->blog_timezone),0,0,0,0,0,0,'BlogUpdateDate'); ?>" />
				<!-- meta-entry -->
			<!-- head-meta -->

		
			<link rel="schema.dc" href="http://purl.org/dc/elements/1.1/" />
			<meta property="dc.publisher" content="<?php echo context::global_filter($core->blog->settings->system->editor,1,0,0,0,0,0,'BlogEditor'); ?>" />
			<meta property="dc.rights" content="<?php echo context::global_filter($core->blog->settings->system->copyright_notice,1,0,0,0,0,0,'BlogCopyrightNotice'); ?>" />
			<meta property="dc.type" content="text" />
			<meta property="dc.format" content="text/html" />
			
				<meta property="dc.title" lang="<?php echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'BlogLanguage'); ?>" content="<?php echo context::global_filter($core->blog->name,1,0,0,0,0,0,'BlogName'); ?><?php if(!context::PaginationStart()) : ?> - <?php echo __('page'); ?> <?php echo context::global_filter(context::PaginationPosition(0),0,0,0,0,0,0,'PaginationCurrent'); ?><?php endif; ?>" />
				<meta property="dc.description" lang="<?php echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'BlogLanguage'); ?>" content="<?php echo context::global_filter($core->blog->desc,1,0,0,0,0,0,'BlogDescription'); ?>" />
				<meta property="dc.language" content="<?php echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'BlogLanguage'); ?>" />
				<meta property="dc.date" content="<?php echo context::global_filter(dt::iso8601($core->blog->upddt,$core->blog->settings->system->blog_timezone),0,0,0,0,0,0,'BlogUpdateDate'); ?>" />
				<!-- dc-entry -->
			<!-- head-dc -->

		
			<link rel="contents" title="<?php echo __('Archives'); ?>" href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("archive"),0,0,0,0,0,0,'BlogArchiveURL'); ?>" />
			<?php
if (!isset($params)) $params = array();
$_ctx->categories = $core->blog->getCategories($params);
?>
<?php while ($_ctx->categories->fetch()) : ?>
				<link rel="section" href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("category",$_ctx->categories->cat_url),0,0,0,0,0,0,'CategoryURL'); ?>" title="<?php echo context::global_filter($_ctx->categories->cat_title,1,0,0,0,0,0,'CategoryTitle'); ?>" />
			<?php endwhile; $_ctx->categories = null; unset($params); ?>

			<?php if ($_ctx->exists("meta") && ($_ctx->meta->meta_type == "tag")) { if (!isset($params)) { $params = array(); }
if (!isset($params['from'])) { $params['from'] = ''; }
if (!isset($params['sql'])) { $params['sql'] = ''; }
$params['from'] .= ', '.$core->prefix.'meta META ';
$params['sql'] .= 'AND META.post_id = P.post_id ';
$params['sql'] .= "AND META.meta_type = 'tag' ";
$params['sql'] .= "AND META.meta_id = '".$core->con->escape($_ctx->meta->meta_id)."' ";
} ?>
<?php
if (!isset($_page_number)) { $_page_number = 1; }
$nb_entry_first_page=$_ctx->nb_entry_first_page; $nb_entry_per_page = $_ctx->nb_entry_per_page;
if (($core->url->type == 'default') || ($core->url->type == 'default-page')) {
    $params['limit'] = ($_page_number == 1 ? $nb_entry_first_page : $nb_entry_per_page);
} else {
    $params['limit'] = $nb_entry_per_page;
}
if (($core->url->type == 'default') || ($core->url->type == 'default-page')) {
    $params['limit'] = array(($_page_number == 1 ? 0 : ($_page_number - 2) * $nb_entry_per_page + $nb_entry_first_page),$params['limit']);
} else {
    $params['limit'] = array(($_page_number - 1) * $nb_entry_per_page,$params['limit']);
}
if ($_ctx->exists("users")) { $params['user_id'] = $_ctx->users->user_id; }
if ($_ctx->exists("categories")) { $params['cat_id'] = $_ctx->categories->cat_id.($core->blog->settings->system->inc_subcats?' ?sub':'');}
if ($_ctx->exists("archives")) { $params['post_year'] = $_ctx->archives->year(); $params['post_month'] = $_ctx->archives->month(); unset($params['limit']); }
if ($_ctx->exists("langs")) { $params['post_lang'] = $_ctx->langs->post_lang; }
if (isset($_search)) { $params['search'] = $_search; }
$params['order'] = 'post_dt desc';
$params['no_content'] = true;
$_ctx->post_params = $params;
$_ctx->posts = $core->blog->getPosts($params); unset($params);
?>
<?php while ($_ctx->posts->fetch()) : ?>
				<?php if ($_ctx->posts->isStart()) : ?>
					<?php
$params = $_ctx->post_params;
$_ctx->pagination = $core->blog->getPosts($params,true); unset($params);
?>
<?php if ($_ctx->pagination->f(0) > $_ctx->posts->count()) : ?>
						<?php if(!context::PaginationEnd()) : ?>
							<link rel="prev" title="<?php echo __('previous entries'); ?>" href="<?php echo context::global_filter(context::PaginationURL(1),0,0,0,0,0,0,'PaginationURL'); ?>" />
						<?php endif; ?>

						<?php if(!context::PaginationStart()) : ?>
							<link rel="next" title="<?php echo __('next entries'); ?>" href="<?php echo context::global_filter(context::PaginationURL(-1),0,0,0,0,0,0,'PaginationURL'); ?>" />
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>

				<link rel="chapter" href="<?php echo context::global_filter($_ctx->posts->getURL(),0,0,0,0,0,0,'EntryURL'); ?>" title="<?php echo context::global_filter($_ctx->posts->post_title,1,0,0,0,0,0,'EntryTitle'); ?>" />
			<?php endwhile; $_ctx->posts = null; $_ctx->post_params = null; ?>

			<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("feed","atom"),0,0,0,0,0,0,'BlogFeedURL'); ?>" />
			<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor('rsd'),0,0,0,0,0,0,'BlogRSDURL'); ?>" />
			<link rel="meta" type="application/xbel+xml" title="Blogroll" href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("xbel"),0,0,0,0,0,0,'BlogrollXbelLink'); ?>" />
			<!-- head-linkrel -->

		<?php try { echo $core->tpl->getData('_head.html'); } catch (Exception $e) {} ?>

		<!-- html-head -->
</head>

	<body class="dc-home <?php if($core->url->type == 'default') : ?>dc-home-first<?php endif; ?>">

	
		<div id="page">
			
				
					<?php try { echo $core->tpl->getData('_top.html'); } catch (Exception $e) {} ?>

					<!-- page-top -->

				<div id="wrapper">
					
						<div id="main" role="main">
							
								
									<?php echo tplBreadcrumb::displayBreadcrumb(''); ?>
								
								<div id="content">
									

										<?php if ($_ctx->exists("meta") && ($_ctx->meta->meta_type == "tag")) { if (!isset($params)) { $params = array(); }
if (!isset($params['from'])) { $params['from'] = ''; }
if (!isset($params['sql'])) { $params['sql'] = ''; }
$params['from'] .= ', '.$core->prefix.'meta META ';
$params['sql'] .= 'AND META.post_id = P.post_id ';
$params['sql'] .= "AND META.meta_type = 'tag' ";
$params['sql'] .= "AND META.meta_id = '".$core->con->escape($_ctx->meta->meta_id)."' ";
} ?>
<?php
if (!isset($_page_number)) { $_page_number = 1; }
$nb_entry_first_page=$_ctx->nb_entry_first_page; $nb_entry_per_page = $_ctx->nb_entry_per_page;
if (($core->url->type == 'default') || ($core->url->type == 'default-page')) {
    $params['limit'] = ($_page_number == 1 ? $nb_entry_first_page : $nb_entry_per_page);
} else {
    $params['limit'] = $nb_entry_per_page;
}
if (($core->url->type == 'default') || ($core->url->type == 'default-page')) {
    $params['limit'] = array(($_page_number == 1 ? 0 : ($_page_number - 2) * $nb_entry_per_page + $nb_entry_first_page),$params['limit']);
} else {
    $params['limit'] = array(($_page_number - 1) * $nb_entry_per_page,$params['limit']);
}
if ($_ctx->exists("users")) { $params['user_id'] = $_ctx->users->user_id; }
if ($_ctx->exists("categories")) { $params['cat_id'] = $_ctx->categories->cat_id.($core->blog->settings->system->inc_subcats?' ?sub':'');}
if ($_ctx->exists("archives")) { $params['post_year'] = $_ctx->archives->year(); $params['post_month'] = $_ctx->archives->month(); unset($params['limit']); }
if ($_ctx->exists("langs")) { $params['post_lang'] = $_ctx->langs->post_lang; }
if (isset($_search)) { $params['search'] = $_search; }
$params['order'] = 'post_dt desc';
$_ctx->post_params = $params;
$_ctx->posts = $core->blog->getPosts($params); unset($params);
?>
<?php while ($_ctx->posts->fetch()) : ?>

											<!-- First page -->
											<?php if($core->url->type == 'default') : ?>
												<?php if ($_ctx->loopPosition(0,1,null,null)) : ?>
													<?php try { echo $core->tpl->getData('_entry-full.html'); } catch (Exception $e) {} ?>

												<?php endif; ?>

												<?php if ($_ctx->loopPosition(1,null,null,null)) : ?>
													<?php try { echo $core->tpl->getData('_entry-short.html'); } catch (Exception $e) {} ?>

												<?php endif; ?>
											<?php endif; ?>

											<!-- Next pages -->
											<?php if($core->url->type != 'default') : ?>
												<?php try { echo $core->tpl->getData('_entry-short.html'); } catch (Exception $e) {} ?>

											<?php endif; ?>

											<!-- Pagination -->
											<?php if ($_ctx->posts->isEnd()) : ?>
												<?php try { echo $core->tpl->getData('_pagination.html'); } catch (Exception $e) {} ?>

											<?php endif; ?>

										<?php endwhile; $_ctx->posts = null; $_ctx->post_params = null; ?>

										<!-- main-content -->
								</div> <!-- End #content -->
								<!-- wrapper-main -->
						</div> <!-- End #main -->

						
							<?php try { echo $core->tpl->getData('_sidebar.html'); } catch (Exception $e) {} ?>

							<!-- wrapper-sidebar -->
						<!-- page-wrapper -->
				</div> <!-- End #wrapper -->

				
					<?php try { echo $core->tpl->getData('_footer.html'); } catch (Exception $e) {} ?>

					<!-- page-footer -->
				<!-- body-page -->
		</div> <!-- End #page -->
		<!-- html-body -->
</body>
</html>
