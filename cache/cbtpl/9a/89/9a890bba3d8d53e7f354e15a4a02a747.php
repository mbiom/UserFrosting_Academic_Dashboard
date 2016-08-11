<?php echo "<?"; ?>xml version="1.0" encoding="utf-8"<?php echo "?>"; ?>
<feed xmlns="http://www.w3.org/2005/Atom"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:wfw="http://wellformedweb.org/CommentAPI/"
  xml:lang="<?php echo context::global_filter($core->blog->settings->system->lang,0,0,0,0,0,0,'BlogLanguage'); ?>">

  <title type="html"><?php echo context::global_filter($core->blog->name,1,0,0,0,0,0,'BlogName'); ?><?php if ($_ctx->feed_subtitle !== null) { echo context::global_filter($_ctx->feed_subtitle,1,0,0,0,0,0,'SysFeedSubtitle');} ?></title>
  <subtitle type="html"><?php echo context::global_filter($core->blog->desc,1,0,0,0,0,0,'BlogDescription'); ?></subtitle>
  <link href="<?php echo context::global_filter(http::getSelfURI(),0,0,0,0,0,0,'SysSelfURI'); ?>" rel="self" type="application/atom+xml"/>
  <link href="<?php echo context::global_filter($core->blog->url,0,0,0,0,0,0,'BlogURL'); ?>" rel="alternate" type="text/html"
  title="<?php echo context::global_filter($core->blog->desc,1,0,0,0,0,0,'BlogDescription'); ?>"/>
  <updated><?php echo context::global_filter(dt::iso8601($core->blog->upddt,$core->blog->settings->system->blog_timezone),0,0,0,0,0,0,'BlogUpdateDate'); ?></updated>
  <author>
    <name><?php echo context::global_filter($core->blog->settings->system->editor,1,0,0,0,0,0,'BlogEditor'); ?></name>
  </author>
  <id><?php echo context::global_filter("urn:md5:".$core->blog->uid,0,0,0,0,0,0,'BlogFeedID'); ?></id>
  <generator uri="http://www.dotclear.org/">Dotclear</generator>

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

  <entry>
    <title><?php echo context::global_filter($_ctx->posts->post_title,1,0,0,0,0,0,'EntryTitle'); ?></title>
    <link href="<?php echo context::global_filter($_ctx->posts->getURL(),0,0,0,0,0,0,'EntryURL'); ?>" rel="alternate" type="text/html"
    title="<?php echo context::global_filter($_ctx->posts->post_title,1,0,0,0,0,0,'EntryTitle'); ?>" />
    <id><?php echo context::global_filter($_ctx->posts->getFeedID(),0,0,0,0,0,0,'EntryFeedID'); ?></id>
    <published><?php echo context::global_filter($_ctx->posts->getISO8601Date(''),0,0,0,0,0,0,'EntryDate'); ?></published>
    <?php if((boolean)$_ctx->posts->isRepublished()) : ?>
      <updated><?php echo context::global_filter($_ctx->posts->getISO8601Date('upddt'),0,0,0,0,0,0,'EntryDate'); ?></updated>
    <?php endif; ?>
    <?php if(!(boolean)$_ctx->posts->isRepublished()) : ?>
      <updated><?php echo context::global_filter($_ctx->posts->getISO8601Date(''),0,0,0,0,0,0,'EntryDate'); ?></updated>
    <?php endif; ?>
    <author><name><?php echo context::global_filter($_ctx->posts->getAuthorCN(),1,0,0,0,0,0,'EntryAuthorCommonName'); ?></name></author>
    <?php if($_ctx->posts->cat_id) : ?>
    <dc:subject><?php echo context::global_filter($_ctx->posts->cat_title,1,0,0,0,0,0,'EntryCategory'); ?></dc:subject>
    <?php endif; ?>
    <?php
$_ctx->meta = $core->meta->getMetaRecordset($_ctx->posts->post_meta,'tag'); $_ctx->meta->sort('meta_id_lower','asc'); ?><?php while ($_ctx->meta->fetch()) : ?><dc:subject><?php echo context::global_filter($_ctx->meta->meta_id,0,0,0,0,0,0,'TagID'); ?></dc:subject><?php endwhile; $_ctx->meta = null; ?>

    <content type="html"><?php echo context::global_filter($_ctx->posts->getExcerpt(1),1,0,0,0,0,0,'EntryExcerpt'); ?>
    <?php echo context::global_filter($_ctx->posts->getContent(1),1,0,0,0,0,0,'EntryContent'); ?></content>

    <?php
if ($_ctx->posts !== null && $core->media) {
$_ctx->attachments = new ArrayObject($core->media->getPostMedia($_ctx->posts->post_id,null,"attachment"));
?>
<?php foreach ($_ctx->attachments as $attach_i => $attach_f) : $GLOBALS['attach_i'] = $attach_i; $GLOBALS['attach_f'] = $attach_f;$_ctx->file_url = $attach_f->file_url; ?>
      <link rel="enclosure" href="<?php echo context::global_filter($attach_f->file_url,0,0,0,0,0,0,'AttachmentURL'); ?>"
      length="<?php echo context::global_filter($attach_f->size,0,0,0,0,0,0,'AttachmentSize'); ?>" type="<?php echo context::global_filter($attach_f->type,0,0,0,0,0,0,'AttachmentMimeType'); ?>" />
    <?php endforeach; $_ctx->attachments = null; unset($attach_i,$attach_f,$_ctx->file_url); ?><?php } ?>



    <?php if($_ctx->posts->commentsActive()) : ?>
      <wfw:comment><?php echo context::global_filter($_ctx->posts->getURL(),0,0,0,0,0,0,'EntryURL'); ?>#comment-form</wfw:comment>
      <wfw:commentRss><?php echo context::global_filter($core->blog->url.$core->url->getURLFor("feed","atom"),0,0,0,0,0,0,'BlogFeedURL'); ?>/comments/<?php echo context::global_filter($_ctx->posts->post_id,0,0,0,0,0,0,'EntryID'); ?></wfw:commentRss>
    <?php endif; ?>
  </entry>
  <?php endwhile; $_ctx->posts = null; $_ctx->post_params = null; ?>

</feed>
