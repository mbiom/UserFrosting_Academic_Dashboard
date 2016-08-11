<!-- media queries -->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- compat media queries -->
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo context::global_filter($core->blog->settings->system->themes_url."/".$core->blog->settings->system->theme,0,0,0,0,0,0,'BlogThemeURL'); ?>/ie.css" media="screen" />
<![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo context::global_filter($core->blog->settings->system->themes_url."/".$core->blog->settings->system->theme,0,0,0,0,0,0,'BlogThemeURL'); ?>/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo context::global_filter($core->blog->getQmarkURL(),0,0,0,0,0,0,'BlogQmarkURL'); ?>pf=print.css" media="print" />

<script type="text/javascript" src="<?php echo context::global_filter($core->blog->getQmarkURL(),0,0,0,0,0,0,'BlogQmarkURL'); ?>pf=<?php echo context::global_filter($core->blog->getJsJQuery(),0,0,0,0,0,0,'BlogJsJQuery'); ?>/jquery.js"></script>
<script type="text/javascript" src="<?php echo context::global_filter($core->blog->getQmarkURL(),0,0,0,0,0,0,'BlogQmarkURL'); ?>pf=<?php echo context::global_filter($core->blog->getJsJQuery(),0,0,0,0,0,0,'BlogJsJQuery'); ?>/jquery.cookie.js"></script>

<?php try { echo $core->tpl->getData('user_head.html'); } catch (Exception $e) {} ?>

<?php if ($core->hasBehavior('publicHeadContent')) { $core->callBehavior('publicHeadContent',$core,$_ctx);} ?>
