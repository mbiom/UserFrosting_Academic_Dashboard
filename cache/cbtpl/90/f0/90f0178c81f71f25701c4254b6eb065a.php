<div class="header">
	<nav role="navigation">
		<ul class="skip-links" id="prelude">
			<li><a href="#main"><?php echo __('To content'); ?></a></li>
			<li><a href="#blognav"><?php echo __('To menu'); ?></a></li>
			<li><a href="#search"><?php echo __('To search'); ?></a></li>
		</ul>
	</nav>

	<div class="banner" role="banner">
		<h1 class="site-title"><a class="site-title__link"
			href="<?php echo context::global_filter($core->blog->url,0,0,0,0,0,0,'BlogURL'); ?>"><span class="site-title__text"><?php echo context::global_filter($core->blog->name,1,0,0,0,0,0,'BlogName'); ?></span></a></h1>
		<p class="site-baseline"><?php echo context::global_filter($core->blog->desc,0,0,0,0,0,0,'BlogDescription'); ?></p>
	</div>

	<?php if ($core->hasBehavior('publicTopAfterContent')) { $core->callBehavior('publicTopAfterContent',$core,$_ctx);} ?>

	<?php echo tplSimpleMenu::displayMenu('nav header__nav','',''); ?>
</div>
