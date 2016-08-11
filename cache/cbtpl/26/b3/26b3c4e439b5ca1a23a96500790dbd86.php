<!DOCTYPE html>
<html lang="<?php echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'BlogLanguage'); ?>">
<head>
	
		<meta charset="UTF-8" />

		
	<title><?php echo __('Archives'); ?> - <?php echo context::global_filter($core->blog->name,1,0,0,0,0,0,'BlogName'); ?></title>
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
			
	<meta property="dc.title" lang="<?php echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'BlogLanguage'); ?>" content="<?php echo __('Archives'); ?> - <?php echo context::global_filter($core->blog->name,1,0,0,0,0,0,'BlogName'); ?>" />
	<meta property="dc.description" lang="<?php echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'BlogLanguage'); ?>" content="<?php echo context::global_filter($core->blog->desc,1,0,0,0,0,0,'BlogDescription'); ?>" />
	<meta property="dc.language" content="<?php echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'BlogLanguage'); ?>" />
	<meta property="dc.date" content="<?php echo context::global_filter(dt::iso8601($core->blog->upddt,$core->blog->settings->system->blog_timezone),0,0,0,0,0,0,'BlogUpdateDate'); ?>" />
	<!-- dc-entry -->
			<!-- head-dc -->

		
	<link rel="top" href="<?php echo context::global_filter($core->blog->url,0,0,0,0,0,0,'BlogURL'); ?>" title="<?php echo __('Home'); ?>" />
	<?php
if (!isset($params)) $params = array();
$params['type'] = 'month';
if ($_ctx->exists("categories")) { $params['cat_id'] = $_ctx->categories->cat_id; }
$_ctx->archives = $core->blog->getDates($params); unset($params);
?>
<?php while ($_ctx->archives->fetch()) : ?>
		<link rel="chapter" href="<?php echo context::global_filter($_ctx->archives->url($core),0,0,0,0,0,0,'ArchiveURL'); ?>" title="<?php echo context::global_filter(dt::dt2str('%B %Y',$_ctx->archives->dt),1,0,0,0,0,0,'ArchiveDate'); ?>" />
	<?php endwhile; $_ctx->archives = null; ?>
	<link rel="contents" title="<?php echo __('Archives'); ?>" href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("archive"),0,0,0,0,0,0,'BlogArchiveURL'); ?>" />
	<?php
if (!isset($params)) $params = array();
$_ctx->categories = $core->blog->getCategories($params);
?>
<?php while ($_ctx->categories->fetch()) : ?>
		<link rel="section" href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("category",$_ctx->categories->cat_url),0,0,0,0,0,0,'CategoryURL'); ?>" title="<?php echo context::global_filter($_ctx->categories->cat_title,1,0,0,0,0,0,'CategoryTitle'); ?>" />
	<?php endwhile; $_ctx->categories = null; unset($params); ?>
	<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("feed","atom"),0,0,0,0,0,0,'BlogFeedURL'); ?>" />
	<!-- head-linkrel -->

		<?php try { echo $core->tpl->getData('_head.html'); } catch (Exception $e) {} ?>

		<!-- html-head -->
</head>
<body class="dc-archive">
	
		<div id="page">
			
				
					<?php try { echo $core->tpl->getData('_top.html'); } catch (Exception $e) {} ?>

					<!-- page-top -->

				<div id="wrapper">
					
						<div id="main" role="main">
							
								
									<?php echo tplBreadcrumb::displayBreadcrumb(''); ?>
								
								<div id="content">
									
	<div id="content-info">
		<h2><?php echo __('Archives'); ?></h2>
	</div>

	<div class="content-inner">

		<div id="time-criteria"><!-- entries sorted by date -->
			<div id="arch-by-year" class="arch-block arch-by-year">
				<h3><?php echo __('By date'); ?></h3>
				<p class="fromto"><?php echo __('FromDay'); ?> <?php if ($_ctx->exists("meta") && ($_ctx->meta->meta_type == "tag")) { if (!isset($params)) { $params = array(); }
if (!isset($params['from'])) { $params['from'] = ''; }
if (!isset($params['sql'])) { $params['sql'] = ''; }
$params['from'] .= ', '.$core->prefix.'meta META ';
$params['sql'] .= 'AND META.post_id = P.post_id ';
$params['sql'] .= "AND META.meta_type = 'tag' ";
$params['sql'] .= "AND META.meta_id = '".$core->con->escape($_ctx->meta->meta_id)."' ";
} ?>
<?php
if (!isset($_page_number)) { $_page_number = 1; }
$params['limit'] = 1;
$nb_entry_first_page = $nb_entry_per_page = 1;
if (($core->url->type == 'default') || ($core->url->type == 'default-page')) {
    $params['limit'] = array(($_page_number == 1 ? 0 : ($_page_number - 2) * $nb_entry_per_page + $nb_entry_first_page),$params['limit']);
} else {
    $params['limit'] = array(($_page_number - 1) * $nb_entry_per_page,$params['limit']);
}
if ($_ctx->exists("users")) { $params['user_id'] = $_ctx->users->user_id; }
if ($_ctx->exists("categories")) { $params['cat_id'] = $_ctx->categories->cat_id.($core->blog->settings->system->inc_subcats?' ?sub':'');}
if ($_ctx->exists("archives")) { $params['post_year'] = $_ctx->archives->year(); $params['post_month'] = $_ctx->archives->month(); }
if ($_ctx->exists("langs")) { $params['post_lang'] = $_ctx->langs->post_lang; }
if (isset($_search)) { $params['search'] = $_search; }
$params['order'] = 'post_dt asc';
$params['no_content'] = true;
$_ctx->post_params = $params;
$_ctx->posts = $core->blog->getPosts($params); unset($params);
?>
<?php while ($_ctx->posts->fetch()) : ?><a href="<?php echo context::global_filter($_ctx->posts->getURL(),0,0,0,0,0,0,'EntryURL'); ?>"><?php echo context::global_filter($_ctx->posts->getDate('%e %B %Y',''),0,0,0,0,0,0,'EntryDate'); ?></a><?php endwhile; $_ctx->posts = null; $_ctx->post_params = null; ?> <?php echo __('toDay'); ?> <?php if ($_ctx->exists("meta") && ($_ctx->meta->meta_type == "tag")) { if (!isset($params)) { $params = array(); }
if (!isset($params['from'])) { $params['from'] = ''; }
if (!isset($params['sql'])) { $params['sql'] = ''; }
$params['from'] .= ', '.$core->prefix.'meta META ';
$params['sql'] .= 'AND META.post_id = P.post_id ';
$params['sql'] .= "AND META.meta_type = 'tag' ";
$params['sql'] .= "AND META.meta_id = '".$core->con->escape($_ctx->meta->meta_id)."' ";
} ?>
<?php
if (!isset($_page_number)) { $_page_number = 1; }
$params['limit'] = 1;
$nb_entry_first_page = $nb_entry_per_page = 1;
if (($core->url->type == 'default') || ($core->url->type == 'default-page')) {
    $params['limit'] = array(($_page_number == 1 ? 0 : ($_page_number - 2) * $nb_entry_per_page + $nb_entry_first_page),$params['limit']);
} else {
    $params['limit'] = array(($_page_number - 1) * $nb_entry_per_page,$params['limit']);
}
if ($_ctx->exists("users")) { $params['user_id'] = $_ctx->users->user_id; }
if ($_ctx->exists("categories")) { $params['cat_id'] = $_ctx->categories->cat_id.($core->blog->settings->system->inc_subcats?' ?sub':'');}
if ($_ctx->exists("archives")) { $params['post_year'] = $_ctx->archives->year(); $params['post_month'] = $_ctx->archives->month(); }
if ($_ctx->exists("langs")) { $params['post_lang'] = $_ctx->langs->post_lang; }
if (isset($_search)) { $params['search'] = $_search; }
$params['order'] = 'post_dt desc';
$params['no_content'] = true;
$_ctx->post_params = $params;
$_ctx->posts = $core->blog->getPosts($params); unset($params);
?>
<?php while ($_ctx->posts->fetch()) : ?><a href="<?php echo context::global_filter($_ctx->posts->getURL(),0,0,0,0,0,0,'EntryURL'); ?>"><?php echo context::global_filter($_ctx->posts->getDate('%e %B %Y',''),0,0,0,0,0,0,'EntryDate'); ?></a><?php endwhile; $_ctx->posts = null; $_ctx->post_params = null; ?></p>
				<?php
if (!isset($params)) $params = array();
$params['type'] = 'month';
if ($_ctx->exists("categories")) { $params['cat_id'] = $_ctx->categories->cat_id; }
$params['order'] = 'asc';
 $_ctx->archives = $core->blog->getDates($params); unset($params);
?>
<?php while ($_ctx->archives->fetch()) : ?>
					<?php if ($_ctx->archives->yearHeader()) : ?>
						<div class="arch-by-year__each-year">
							<h4><?php echo context::global_filter(dt::dt2str('%Y',$_ctx->archives->dt),0,0,0,0,0,0,'ArchiveDate'); ?></h4>
							<ul class="arch-list arch-year-list">
					<?php endif; ?>
								<li><a href="<?php echo context::global_filter($_ctx->archives->url($core),0,0,0,0,0,0,'ArchiveURL'); ?>" title="<?php echo context::global_filter(dt::dt2str('%B %Y',$_ctx->archives->dt),1,0,0,0,0,0,'ArchiveDate'); ?>"><?php echo context::global_filter(dt::dt2str('%B',$_ctx->archives->dt),1,0,0,0,0,0,'ArchiveDate'); ?></a>
									<span>(<?php echo context::global_filter($_ctx->archives->nb_post,0,0,0,0,0,0,'ArchiveEntriesCount'); ?>)</span></li>
					<?php if ($_ctx->archives->yearFooter()) : ?>
							</ul>
						</div>
					<?php endif; ?>
				<?php endwhile; $_ctx->archives = null; ?>
			</div>
		</div>

		<div id="other-criteria"><!-- entries sorted by others criterias -->
			<?php
if (!isset($params)) $params = array();
$params['level'] = 1;
$_ctx->categories = $core->blog->getCategories($params);
?>
<?php while ($_ctx->categories->fetch()) : ?>
				<?php if ($_ctx->categories->isStart()) : ?>
					<div id="arch-by-cat" class="arch-block arch-by-cat">
						<h3><?php echo __('By category'); ?></h3>
						<ul class="arch-list arch-cat-list">
							<?php endif; ?>
							<li><a href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("category",$_ctx->categories->cat_url),0,0,0,0,0,0,'CategoryURL'); ?>"><?php echo context::global_filter($_ctx->categories->cat_title,1,0,0,0,0,0,'CategoryTitle'); ?></a>
							<?php
$_ctx->categories = $core->blog->getCategoryFirstChildren($_ctx->categories->cat_id);
while ($_ctx->categories->fetch()) : ?>
								<?php if ($_ctx->categories->isStart()) : ?>
								<ul class="arch-list arch-sub-cat-list">
								<?php endif; ?>
									<li><a href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("category",$_ctx->categories->cat_url),0,0,0,0,0,0,'CategoryURL'); ?>"><?php echo context::global_filter($_ctx->categories->cat_title,1,0,0,0,0,0,'CategoryTitle'); ?></a></li>
								<?php if ($_ctx->categories->isEnd()) : ?>
								</ul>
								<?php endif; ?>
							<?php endwhile; $_ctx->categories = null; ?>
							</li>
					<?php if ($_ctx->categories->isEnd()) : ?>
						</ul>
					</div>
					<?php endif; ?>
			<?php endwhile; $_ctx->categories = null; unset($params); ?>

			<?php
$_ctx->meta = $core->meta->computeMetaStats($core->meta->getMetadata(array('meta_type'=>'tag','limit'=>null))); $_ctx->meta->sort('count','desc'); ?><?php while ($_ctx->meta->fetch()) : ?>
				<?php if ($_ctx->meta->isStart()) : ?>
					<div id="arch-by-tag" class="arch-block arch-by-tag">
						<h3><?php echo __('By tag'); ?></h3>
						<ul class="arch-list arch-tag-list">
				<?php endif; ?>
							<li><a href="<?php echo context::global_filter($core->blog->url.$core->url->getURLFor("tag",rawurlencode($_ctx->meta->meta_id)),0,0,0,0,0,0,'TagURL'); ?>" class="tag<?php echo $_ctx->meta->roundpercent; ?>"><?php echo context::global_filter($_ctx->meta->meta_id,0,0,0,0,0,0,'TagID'); ?></a></li>
				<?php if ($_ctx->meta->isEnd()) : ?>
						</ul>
					</div>
				<?php endif; ?>
			<?php endwhile; $_ctx->meta = null; ?>
		</div>

		<div id="more-arch"><!-- others things -->
			<div id="arch-by-page" class="arch-block arch-by-page">
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
$params['post_type'] = preg_split('/\s*,\s*/','page',-1,PREG_SPLIT_NO_EMPTY);
if ($_ctx->exists("users")) { $params['user_id'] = $_ctx->users->user_id; }
if ($_ctx->exists("categories")) { $params['cat_id'] = $_ctx->categories->cat_id.($core->blog->settings->system->inc_subcats?' ?sub':'');}
if ($_ctx->exists("archives")) { $params['post_year'] = $_ctx->archives->year(); $params['post_month'] = $_ctx->archives->month(); }
if ($_ctx->exists("langs")) { $params['post_lang'] = $_ctx->langs->post_lang; }
if (isset($_search)) { $params['search'] = $_search; }
$params['order'] = 'post_dt desc';
$params['no_content'] = true;
$params['post_selected'] = 0;$_ctx->post_params = $params;
$_ctx->posts = $core->blog->getPosts($params); unset($params);
?>
<?php while ($_ctx->posts->fetch()) : ?>
					<?php if ($_ctx->posts->isStart()) : ?>
						<h3><?php echo __('Pages'); ?></h3>
						<ul class="arch-list arch-page-list">
					<?php endif; ?>
							<li><a href="<?php echo context::global_filter($_ctx->posts->getURL(),0,0,0,0,0,0,'EntryURL'); ?>"><?php echo context::global_filter($_ctx->posts->post_title,1,0,0,0,0,0,'EntryTitle'); ?></a></li>
					<?php if ($_ctx->posts->isEnd()) : ?>
						</ul>
					<?php endif; ?>
				<?php endwhile; $_ctx->posts = null; $_ctx->post_params = null; ?>
			</div>
		</div>
	</div> <!-- End .content-inner -->
	<!-- main-content -->
								</div> <!-- End #content -->
								<!-- wrapper-main -->
						</div> <!-- End #main -->

						
	<div class="sidebar" id="sidebar" role="complementary">
		<div class="widgets blognav__widgets" id="blognav">
			<?php publicWidgets::widgetHandler('search','
			'); ?>
		</div> <!-- End #blognav -->

		<?php if(publicWidgets::ifWidgetsHandler('extra','')) : ?>
			<div class="widgets blogextra__widgets" id="blogextra">
		        <h2 class="blogextra__title"><?php echo __('Extra menu'); ?></h2>
				<?php publicWidgets::widgetsHandler('extra',''); ?>
			</div> <!-- End #blogextra -->
		<?php endif; ?>
	</div> <!-- End #sidebar -->
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
