<!DOCTYPE html>
<html lang="<?php echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'BlogLanguage'); ?>">
<head>
	
		<meta charset="UTF-8" />

		
	<title><?php echo __('Archives'); ?> - <?php echo context::global_filter(dt::dt2str('%B %Y',$_ctx->archives->dt),0,0,0,0,0,0,'ArchiveDate'); ?> - <?php echo context::global_filter($core->blog->name,1,0,0,0,0,0,'BlogName'); ?></title>
	<!-- head-title -->

		
			<meta name="copyright" content="<?php echo context::global_filter($core->blog->settings->system->copyright_notice,1,0,0,0,0,0,'BlogCopyrightNotice'); ?>" />
			
	<meta name="ROBOTS" content="<?php echo context::robotsPolicy($core->blog->settings->system->robots_policy,'NOINDEX'); ?>" />
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
			
	<meta property="dc.title" lang="<?php echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'BlogLanguage'); ?>" content="<?php echo __('Archives'); ?> - <?php echo context::global_filter(dt::dt2str('%B %Y',$_ctx->archives->dt),0,0,0,0,0,0,'ArchiveDate'); ?> - <?php echo context::global_filter($core->blog->name,1,0,0,0,0,0,'BlogName'); ?>" />
	<meta property="dc.language" content="<?php echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'BlogLanguage'); ?>" />
	<meta property="dc.date" content="<?php echo context::global_filter(dt::iso8601($core->blog->upddt,$core->blog->settings->system->blog_timezone),0,0,0,0,0,0,'BlogUpdateDate'); ?>" />
	<!-- dc-entry -->
			<!-- head-dc -->

		
	<link rel="top" href="<?php echo context::global_filter($core->blog->url,0,0,0,0,0,0,'BlogURL'); ?>" title="<?php echo __('Home'); ?>" />
	<link rel="up" href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("archive"),0,0,0,0,0,0,'BlogArchiveURL'); ?>" title="<?php echo __('Archives'); ?>" />
	<link rel="contents" href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("archive"),0,0,0,0,0,0,'BlogArchiveURL'); ?>" title="<?php echo __('Archives'); ?>" />

	<?php
if (!isset($params)) $params = array();
$params['type'] = 'month';
$params['next'] = $_ctx->archives->dt;$_ctx->archives = $core->blog->getDates($params); unset($params);
?>
<?php while ($_ctx->archives->fetch()) : ?><link rel="next" href="<?php echo context::global_filter($_ctx->archives->url($core),0,0,0,0,0,0,'ArchiveURL'); ?>" title="<?php echo context::global_filter(dt::dt2str('%B %Y',$_ctx->archives->dt),1,0,0,0,0,0,'ArchiveDate'); ?>" /><?php endwhile; $_ctx->archives = null; ?>
	<?php
if (!isset($params)) $params = array();$params['type'] = 'month';
$params['previous'] = $_ctx->archives->dt;$_ctx->archives = $core->blog->getDates($params); unset($params);
?>
<?php while ($_ctx->archives->fetch()) : ?><link rel="prev" href="<?php echo context::global_filter($_ctx->archives->url($core),0,0,0,0,0,0,'ArchiveURL'); ?>" title="<?php echo context::global_filter(dt::dt2str('%B %Y',$_ctx->archives->dt),1,0,0,0,0,0,'ArchiveDate'); ?>" /><?php endwhile; $_ctx->archives = null; ?>

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
		<link rel="chapter" href="<?php echo context::global_filter($_ctx->posts->getURL(),0,0,0,0,0,0,'EntryURL'); ?>" title="<?php echo context::global_filter($_ctx->posts->post_title,1,0,0,0,0,0,'EntryTitle'); ?>" />
	<?php endwhile; $_ctx->posts = null; $_ctx->post_params = null; ?>
	<!-- head-linkrel -->

		<?php try { echo $core->tpl->getData('_head.html'); } catch (Exception $e) {} ?>

		<!-- html-head -->
</head>
<body class="dc-archive-month">
	
		<div id="page">
			
				
					<?php try { echo $core->tpl->getData('_top.html'); } catch (Exception $e) {} ?>

					<!-- page-top -->

				<div id="wrapper">
					
						<div id="main" role="main">
							
								
									<?php echo tplBreadcrumb::displayBreadcrumb(''); ?>
								
								<div id="content">
									
	<p class="navlinks topnl">
		<?php
if (!isset($params)) $params = array();$params['type'] = 'month';
$params['previous'] = $_ctx->archives->dt;$_ctx->archives = $core->blog->getDates($params); unset($params);
?>
<?php while ($_ctx->archives->fetch()) : ?><a href="<?php echo context::global_filter($_ctx->archives->url($core),0,0,0,0,0,0,'ArchiveURL'); ?>" class="prev">&#171; <?php echo context::global_filter(dt::dt2str('%B %Y',$_ctx->archives->dt),1,0,0,0,0,0,'ArchiveDate'); ?></a> - <?php endwhile; $_ctx->archives = null; ?>
		<?php echo context::global_filter(dt::dt2str('%B %Y',$_ctx->archives->dt),0,0,0,0,0,0,'ArchiveDate'); ?>
		<?php
if (!isset($params)) $params = array();
$params['type'] = 'month';
$params['next'] = $_ctx->archives->dt;$_ctx->archives = $core->blog->getDates($params); unset($params);
?>
<?php while ($_ctx->archives->fetch()) : ?> - <a href="<?php echo context::global_filter($_ctx->archives->url($core),0,0,0,0,0,0,'ArchiveURL'); ?>" class="next"><?php echo context::global_filter(dt::dt2str('%B %Y',$_ctx->archives->dt),1,0,0,0,0,0,'ArchiveDate'); ?> &#187;</a><?php endwhile; $_ctx->archives = null; ?>
	</p>

	<div id="content-info">
		<h2><?php echo context::global_filter(dt::dt2str('%B %Y',$_ctx->archives->dt),0,0,0,0,0,0,'ArchiveDate'); ?> <span>(<?php echo context::global_filter($_ctx->archives->nb_post,0,0,0,0,0,0,'ArchiveEntriesCount'); ?>)</span></h2>
	</div>

	<div class="content-inner">
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
			<?php try { echo $core->tpl->getData('_entry-short.html'); } catch (Exception $e) {} ?>

		<?php endwhile; $_ctx->posts = null; $_ctx->post_params = null; ?>
	</div>

	<p class="navlinks">
		<?php
if (!isset($params)) $params = array();$params['type'] = 'month';
$params['previous'] = $_ctx->archives->dt;$_ctx->archives = $core->blog->getDates($params); unset($params);
?>
<?php while ($_ctx->archives->fetch()) : ?><a href="<?php echo context::global_filter($_ctx->archives->url($core),0,0,0,0,0,0,'ArchiveURL'); ?>" class="prev">&#171; <?php echo context::global_filter(dt::dt2str('%B %Y',$_ctx->archives->dt),1,0,0,0,0,0,'ArchiveDate'); ?></a> - <?php endwhile; $_ctx->archives = null; ?>
		<?php echo context::global_filter(dt::dt2str('%B %Y',$_ctx->archives->dt),0,0,0,0,0,0,'ArchiveDate'); ?>
		<?php
if (!isset($params)) $params = array();
$params['type'] = 'month';
$params['next'] = $_ctx->archives->dt;$_ctx->archives = $core->blog->getDates($params); unset($params);
?>
<?php while ($_ctx->archives->fetch()) : ?> - <a href="<?php echo context::global_filter($_ctx->archives->url($core),0,0,0,0,0,0,'ArchiveURL'); ?>" class="next"><?php echo context::global_filter(dt::dt2str('%B %Y',$_ctx->archives->dt),1,0,0,0,0,0,'ArchiveDate'); ?> &#187;</a><?php endwhile; $_ctx->archives = null; ?>
	</p>
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
