O:10:"feedParser":7:{s:9:"feed_type";s:8:"atom 1.0";s:5:"title";s:20:"Dotclear News - News";s:4:"link";s:26:"https://dotclear.org/blog/";s:11:"description";s:25:"Blog management made easy";s:7:"pubdate";s:25:"2016-05-06T13:49:50+02:00";s:9:"generator";s:8:"Dotclear";s:5:"items";a:20:{i:0;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2016/03/27/Dotclear-2.9.1";s:5:"title";s:14:"Dotclear 2.9.1";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:1003:"    <p>A new maintenance release which fixes several bugs of the previous 2.9. I remind you that Dotclear is fully compatible with the new PHP 7 (it's performances are highly improved comparing with PHP 5.n)<sup>[<a href="https://dotclear.org/blog/post/2016/03/27/Dotclear-2.9.1#pnote-1043-1" id="rev-pnote-1043-1">1</a>]</sup>.</p>


<p>Your dashboard should also offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.9-2.9.1.diff.gz">patch</a> for the developers who prefer this method.</p>
<div class="footnotes"><h4 class="footnotes-title">Note</h4>
<p>[<a href="https://dotclear.org/blog/post/2016/03/27/Dotclear-2.9.1#rev-pnote-1043-1" id="pnote-1043-1">1</a>] If you use MySQL for your database, take care to use the <strong>mysqli</strong> driver rather than the old <strong>mysql</strong> which is not more supported by PHP 7 (see in your configuration file <code>inc/config.php</code>).</p></div>
";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2016-03-27T11:16:00+02:00";s:2:"TS";i:1459070160;}i:1;O:8:"stdClass":8:{s:4:"link";s:54:"https://dotclear.org/blog/post/2016/02/29/Dotclear-2.9";s:5:"title";s:12:"Dotclear 2.9";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:2426:"    <blockquote><p>My lambs, it's time to update, the new 2.9 version awaits you!</p>
<p>
<em>Fédor Balanovitch</em> (coming out of the bus, almost) — Zazie in the metro, R. Queneau</p></blockquote>


<p>On the menu of this version essentially what make life a little easier for those who spend time on the side of the administration of their(s) blog(s). A search and last visited folders available in the media manager, better sorted menus and lists some more filterable, some welcome updates for the javascript libraries used<sup>[<a href="https://dotclear.org/blog/post/2016/02/29/Dotclear-2.9#pnote-1041-1" id="rev-pnote-1041-1">1</a>]</sup>.</p>


<p>And then we also need to make Dotclear run properly with the new version 7 of PHP, quite impressive release in terms of speed gain, and you will note in passing that the minimum required version of PHP 5.3, as it is had announced at the time of the release of <a href="https://dotclear.org/blog/post/2015/08/13/Dotclear-2.8">the release of the version 2.8</a><sup>[<a href="https://dotclear.org/blog/post/2016/02/29/Dotclear-2.9#pnote-1041-2" id="rev-pnote-1041-2">2</a>]</sup>.</p>


<p>A lot of bugs were eradicated, a few new opportunities have been implemented for developers of plugins and theme designers, and finally a more robust application for everyone.</p>


<p>The future version 2.10 will be mainly focused on two aspects. First an "overhaul" of JavaScript scripts used in the administration od Dotclear, as we have some old stuff in our "collection", and second, a "soft" migration to more HTML5 / CSS3 templates and themes side. But tell us if you'd prefer something else!</p>


<p>The updated proposal of your installation should appear on your dashboard today or tomorrow (depending on the settings of your accommodation) and a <a href="http://download.dotclear.org/patches/2.8.2-2.9.diff.gz">patch</a> is available to developers preferring to apply this method.</p>
<div class="footnotes"><h4 class="footnotes-title">Notes</h4>
<p>[<a href="https://dotclear.org/blog/post/2016/02/29/Dotclear-2.9#rev-pnote-1041-1" id="pnote-1041-1">1</a>] The jQuery 2.2.0 version is now available for the public side of your blogs, if necessary.</p>
<p>[<a href="https://dotclear.org/blog/post/2016/02/29/Dotclear-2.9#rev-pnote-1041-2" id="pnote-1041-2">2</a>] Hosting services with less than 5.3 version of PHP begins hard to find, and it's a good news.</p></div>
";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2016-02-29T13:17:00+01:00";s:2:"TS";i:1456748220;}i:2;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2015/10/25/Dotclear-2.8.2";s:5:"title";s:14:"Dotclear 2.8.2";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:987:"    <p>A new maintenance release which fixes one potential XSS vulnerability in comments's list and enforce media extension before upload<sup>[<a href="https://dotclear.org/blog/post/2015/10/25/Dotclear-2.8.2#pnote-1039-1" id="rev-pnote-1039-1">1</a>]</sup> (thanks to Tim Coen, Curesec Gmbh, for reporting them) and two other bugfixes.</p>


<p>Your dashboard should also offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.8.1-2.8.2.diff.gz">patch</a> for the developers who prefer this method.</p>
<div class="footnotes"><h4 class="footnotes-title">Note</h4>
<p>[<a href="https://dotclear.org/blog/post/2015/10/25/Dotclear-2.8.2#rev-pnote-1039-1" id="pnote-1039-1">1</a>] You may also create an <strong>.htaccess</strong> file at the root of your public folder, with an <strong>php_flag engine Off</strong> directive to prevent any PHP code execution from your media library.</p></div>
";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2015-10-25T09:41:00+01:00";s:2:"TS";i:1445762460;}i:3;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2015/09/23/Dotclear-2.8.1";s:5:"title";s:14:"Dotclear 2.8.1";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:451:"    <p>A new maintenance release which fixes one potential XSS vulnerabilities (thanks to Yuji Tounai of NTT Com Security (Japan) KK, via Keiko Yashiki from JPCERT/CC) and two other bugfixes.</p>


<p>Your dashboard should also offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.8-2.8.1.diff.gz">patch</a> for the developers who prefer this method.</p>";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2015-09-23T15:36:00+02:00";s:2:"TS";i:1443015360;}i:4;O:8:"stdClass":8:{s:4:"link";s:54:"https://dotclear.org/blog/post/2015/08/13/Dotclear-2.8";s:5:"title";s:12:"Dotclear 2.8";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:2611:"    <p>Some time after the 2.7.5 release, here it is, today, right on the Dotclear's 12th birthday, the 2.8 release which comes with a new companion, the proud <strong>Dotty</strong><sup>[<a href="https://dotclear.org/blog/post/2015/08/13/Dotclear-2.8#pnote-1034-1" id="rev-pnote-1034-1">1</a>]</sup>, our new mascot<sup>[<a href="https://dotclear.org/blog/post/2015/08/13/Dotclear-2.8#pnote-1034-2" id="rev-pnote-1034-2">2</a>]</sup>&nbsp;:</p>


<p><img src="https://dotclear.org/public/dotty.jpg" alt="Dotty the new Dotclear mascot" style="display:block; margin:0 auto;" title="Dotty the new Dotclear mascot, août 2015" /></p>
<p style="text-align: center;">Dotty</p>



<p>This new version introduces a new mechanism to cope with module dependencies (plugins for this release and will be declined for themes soon), also includes the Breadcrumb plugin that some of you already use, updates the CKEditor editor and the jQuery library, and fixes lots of bugs et somes minor cosmetic issues.</p>


<p>The heritage/extension templating system has been applied to the legacy <code>mustek</code> templateset, in order to simplify the developpement of themes using it&nbsp;; some new criteria and filters have been added for posts and comments (and spams) lists&nbsp;; the tags and widgets are now lexically sorted for latin languages, and so on… We will give you some details about all of this in further posts here.</p>


<p><strong>Important</strong>&nbsp;: If you have already installed the <strong>breadcrumb</strong> plugin, please uninstall it before doing this update.</p>


<p>Another point&nbsp;: we will drop the PHP 5.2 support and will require, at least, the PHP 5.3 version (which is already obsolete). Note that Dotclear has been tested with PHP versions 5.3 to 5.6.</p>


<p>Your dashboard should offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.7.5-2.8.diff.gz">patch</a> for the developers who prefer this method.</p>
<div class="footnotes"><h4 class="footnotes-title">Notes</h4>
<p>[<a href="https://dotclear.org/blog/post/2015/08/13/Dotclear-2.8#rev-pnote-1034-1" id="pnote-1034-1">1</a>] We due the pretty name to Noé (aka Lomalarch) and when we, french guys, have discovered what dotty means, we decided that was really suitable !</p>
<p>[<a href="https://dotclear.org/blog/post/2015/08/13/Dotclear-2.8#rev-pnote-1034-2" id="pnote-1034-2">2</a>] This illustration has been designed by our friend and artist <a href="https://fr.wikipedia.org/wiki/Alain_Korkos">Alain Korkos</a>.</p></div>
";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2015-08-13T08:59:00+02:00";s:2:"TS";i:1439449140;}i:5;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2015/03/25/Dotclear-2.7.5";s:5:"title";s:14:"Dotclear 2.7.5";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:470:"    <p>A new maintenance release which fixes two potential XSS vulnerabilities (thanks to the <a href="http://secpod.org/blog/" hreflang="en">SecPod Research Team Member</a> Shakeel) and three other bugfixes.</p>


<p>Your dashboard should also offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.7.4-2.7.5.diff.gz">patch</a> for the developers who prefer this method.</p>";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2015-03-25T10:39:00+01:00";s:2:"TS";i:1427276340;}i:6;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2015/02/13/Dotclear-2.7.4";s:5:"title";s:14:"Dotclear 2.7.4";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:368:"    <p>A maintenance release with some bugfixes and improvements. Nice friday the 13th with “The Cat“!</p>


<p>Your dashboard should also offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.7.3-2.7.4.diff.gz">patch</a> for the developers who prefer this method.</p>";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2015-02-13T09:59:00+01:00";s:2:"TS";i:1423817940;}i:7;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2015/01/13/Dotclear-2.7.3";s:5:"title";s:14:"Dotclear 2.7.3";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:437:"    <p>A bugfix release which restores advanced editing of category description, fixes some non-required warning messages, fixes also pagination in some specific contexts, …</p>


<p>Your dashboard should also offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.7.2-2.7.3.diff.gz">patch</a> for the developers who prefer this method.</p>";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2015-01-13T10:30:00+01:00";s:2:"TS";i:1421141400;}i:8;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2014/12/25/Dotclear-2.7.2";s:5:"title";s:14:"Dotclear 2.7.2";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:366:"    <p>A bugfix release in order to allow again normal user (not admin) to use the Dotclear Wiki editor.</p>


<p>Your dashboard should also offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.7.1-2.7.2.diff.gz">patch</a> for the developers who prefer this method.</p>";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2014-12-25T14:08:00+01:00";s:2:"TS";i:1419512880;}i:9;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2014/12/25/Dotclear-2.7.1";s:5:"title";s:14:"Dotclear 2.7.1";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:468:"    <p>You can now download Dotclear 2.7.1. This maintenance release includes several fixes for bugs discovered since the 2.7 release and some cosmetic enhancements in Berlin theme and Currywurst templateset.</p>


<p>Your dashboard should also offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.7-2.7.1.diff.gz">patch</a> for the developers who prefer this method.</p>";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2014-12-25T08:26:00+01:00";s:2:"TS";i:1419492360;}i:10;O:8:"stdClass":8:{s:4:"link";s:54:"https://dotclear.org/blog/post/2014/12/13/Dotclear-2.7";s:5:"title";s:12:"Dotclear 2.7";s:7:"creator";s:11:"Krazy Kitty";s:11:"description";s:0:"";s:7:"content";s:5460:"    <p>Woohoo!</p>


<p>TL;DR — There's a new WYSIWYG editor, and HTML5 all over. Update and enjoy :-)</p>


<p>It's now been thirteen months<sup>[<a href="https://dotclear.org/blog/post/2014/12/13/Dotclear-2.7#pnote-1019-1" id="rev-pnote-1019-1">1</a>]</sup> since 2.6 came out. It's now about time (at last!) to move on. Dotclear 2.7, being released today, is less spectacular than the previous version, with its updated administration graphics chart, but it brings forth significative changes for users (on the admin side) and its rendering (on the public side).</p>


<h3>On the admin side</h3>


<p>We have integrated (she typed, as if <em>she</em> had done any of that) a new editor, dcCKEditor, which is built, as you can imagine, on the CKEditor library. You will therefore find a more advanced editor (presentation-wise). The old editor is still here, and is now called dcLegacyEditor.</p>


<p>As several editors (two with this version) can be installed, you'll have to pick your favorite for each of the proposed syntaxes (wiki and XHTML, so far). Go and have a look at the "My Options" tab under "My Preferences", and check the "Edition" frame. You'll probably need to clear your browser's cache as well.</p>


<p>It's not all on the administration side, as we have also started to integrate, together with the switch to HTML5, the main ARIA Roles. (If, like the author of that note, you are wondering what ARIA Roles are, you can read <a href="http://www.webteacher.ws/2010/10/14/aria-roles-101/">this</a>, which is the first link she decided to click on that topic. If you don't want to read, know that the first of those As stands for Accessibility and that accessibility is A Good Thing.)</p>


<h3>On the rendering side</h3>


<p>Well let's talk about HTML5 some more. We've implemented two sets of templates, upon which the basic themes are built. The first one is called "mustek" and corresponds to Dotclear's old default theme (that good old Blowup). The second one is called "currywurst" and corresponds to Dotclear's shiny new default theme, named... you guessed it, Berlin.</p>


<p>Both sets of templates and themes are now in HTML5 and include ARIA Roles. For those of you who use Dotclear's wiki syntax, do note that the XHTML code it produces is now HTML5 compatible.</p>


<p>You'll note that it is not any longer mandatory to copy the <strong>default</strong> theme repository when using an external repertory. You can also choose, in the blog's parameters, the jQuery version that must be loaded on the public side (both 1.4.2 and 1.11.1 are shipped with this version of Dotclear).</p>


<p>We certainly advise you, after having upgraded, to clear the templates' cache (see the Maintenance plugin), to ensure that your blog's rendering is up to date.</p>


<p>Moreover, new options have been added to let you tune your blog's appearance more finely. You can for instance deactivate widgets without needing to delete them. You can also define a number of notes to be displayed specific to the home page (and which can be different from that of the following pages).</p>


<p>Back to HTML5, now that audio files and videos will, as much as possible, be integrated to your notes with HTML5 tags (&lt;audio&gt; and &lt;video&gt;), degraded to Flash when supported.</p>


<h3>Miscellaneous</h3>


<p>A couple more things about this version:</p>
<ul>
<li>Drag'n'drop on the admin side on touch screens is now possible;</li>
<li>You can activate protection against <a href="http://en.wikipedia.org/wiki/Clickjacking">clickjacking</a> in the blog settings;</li>
<li>Comments preview is now optional (see Blog settings);</li>
<li>Hidden folders (with a name starting with a dot) are now hidden in the media manager.</li>
</ul>

<p>In addition, the CHANGELOG file at the root of your brand new installation will give you a more detailed list of all changes.</p>


<h3>Conclusion</h3>


<p>I'll hope you'll enjoy these changes! There's still a lot more work planned for future versions, including better accessibility (ARIA, Opquast <a href="https://checklists.opquast.com/en/oqs-v2">good practices</a>, <a href="http://www.w3.org/WAI/intro/atag.php">ATAG</a>...), an alternate template engine (Twig), a new media library...</p>


<p>To conclude I'll thank all those who contributed (in particular <a href="http://open-time.net/">Franck</a>, <em>ahem</em>, but also all the others we don't dare naming in case we forget someone), to development, to design, to testing, to ideas, to the wild cheering by delirious fa... ah no wait, I was just supposed to translate something along the lines of support and cheers. More wild cheering by delirious fans for Franck et al., Dotclear users! It's crucial to people who contribute to an open source project like Dotclear on their free time only.</p>


<p>To sum it up, we (well, mostly <em>they</em>, as far as I am concerned) did a lot of work!</p>


<p>Your dashboard should offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.6.4-2.7.diff.gz">patch</a> for the developers who prefer this method.</p>
<div class="footnotes"><h4 class="footnotes-title">Note</h4>
<p>[<a href="https://dotclear.org/blog/post/2014/12/13/Dotclear-2.7#rev-pnote-1019-1" id="pnote-1019-1">1</a>] We love number 13 here at Dotclear. Almost as much as going live on a Friday. Especially a Friday the thirteenth.</p></div>
";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2014-12-13T00:01:00+01:00";s:2:"TS";i:1418425260;}i:11;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2014/08/18/Dotclear-2.6.4";s:5:"title";s:14:"Dotclear 2.6.4";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:421:"    <p>You can now download Dotclear 2.6.4. This maintenance release includes fixes for two potential security defaults on XML-RPC system and on media manager.</p>


<p>Your dashboard should also offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.6.3-2.6.4.diff.gz">patch</a> for the developers who prefer this method.</p>";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2014-08-18T14:13:00+02:00";s:2:"TS";i:1408363980;}i:12;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2014/01/20/Dotclear-2.6.2";s:5:"title";s:14:"Dotclear 2.6.2";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:456:"    <p>You can now download Dotclear 2.6.2. This maintenance release includes several fixes for a potential security default on password protected posts and pages, and for some other minor bugs.</p>


<p>Your dashboard should also offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.6.1-2.6.2.diff.gz">patch</a> for the developers who prefer this method.</p>";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2014-01-20T13:57:00+01:00";s:2:"TS";i:1390222620;}i:13;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2013/11/22/Dotclear-2.6.1";s:5:"title";s:14:"Dotclear 2.6.1";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:425:"    <p>You can now download Dotclear 2.6.1. This maintenance release includes several fixes for bugs discovered since the 2.6 release and some cosmetic enhancements.</p>


<p>Your dashboard should also offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.6-2.6.1.diff.gz">patch</a> for the developers who prefer this method.</p>";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2013-11-22T13:07:00+01:00";s:2:"TS";i:1385122020;}i:14;O:8:"stdClass":8:{s:4:"link";s:54:"https://dotclear.org/blog/post/2013/11/13/Dotclear-2.6";s:5:"title";s:12:"Dotclear 2.6";s:7:"creator";s:6:"Franck";s:11:"description";s:0:"";s:7:"content";s:1250:"    <p>Stop talking, play time now<sup>[<a href="https://dotclear.org/blog/post/2013/11/13/Dotclear-2.6#pnote-1004-1" id="rev-pnote-1004-1">1</a>]</sup>!</p>


<p>Some information about this version:</p>

<ul>
<li><a href="https://dotclear.org/blog/post/2013/10/20/Dotclear-2.6-RC-%E2%80%94-codename%3A-Traviata">Dotclear 2.6-RC — codename: Traviata</a></li>
<li><a href="https://dotclear.org/blog/post/2013/10/30/What-s-New-in-Dotclear-2.6-%E2%80%94-Chapter-1">What's New in Dotclear 2.6 — Chapter 1</a></li>
<li><a href="https://dotclear.org/blog/post/2013/11/07/What-s-new-in-Dotclear-2.6-%E2%80%94-Chapter-2">What's new in Dotclear 2.6 — Chapter 2</a></li>
<li><a href="https://dotclear.org/blog/post/2013/11/11/What-s-new-in-Dotclear-2.6-%E2%80%94-Chapter-3">What's new in Dotclear 2.6 — Chapter 3</a></li>
</ul>
<div class="footnotes"><h4 class="footnotes-title">Note</h4>
<p>[<a href="https://dotclear.org/blog/post/2013/11/13/Dotclear-2.6#rev-pnote-1004-1" id="pnote-1004-1">1</a>] Your dashboard should offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.5.3-2.6.diff.gz">patch</a> for the developers who prefer this method.</p></div>
";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2013-11-13T12:14:00+01:00";s:2:"TS";i:1384341240;}i:15;O:8:"stdClass":8:{s:4:"link";s:88:"https://dotclear.org/blog/post/2013/10/20/Dotclear-2.6-RC-%E2%80%94-codename%3A-Traviata";s:5:"title";s:38:"Dotclear 2.6-RC — codename: Traviata";s:7:"creator";s:11:"Krazy Kitty";s:11:"description";s:0:"";s:7:"content";s:5024:"    <p>It is not without emotion, as Violetta would say, that we are getting ready to unveil before your astonished eyes the candidate release of the next version of Dotclear. This version precedes the final one by a few weeks. We were so eager to expose it to your rigorous and nevertheless gracious testing that we indeed decided not to wait until the final version to make it public. Ladies and gentlemen, let me introduce to you Dotclear 2.6-RC.</p>



<h3>The set</h3>


<p>Because every show needs an appropriate set, we have entirely repainted the stage. We therefore present you with a new visual identity, together with a set of icons that match the new color scheme:</p>


<p><img src="https://dotclear.org/public/images/2.6/palette-traviata.png" alt="palette-traviata.png" style="display:block; margin:0 auto;" title="palette-traviata.png, Oct 2013" /></p>


<p>We have also taken advantage of this opportunity to create an additional variation to the Blowup theme, Plumetis. Let it be known that our secret plans <del>to take over the world</del> include projects for major improvements in the development and configuration of themes in the next version (2.7).</p>


<h3>Stage direction</h3>


<p>We have also carried on our ameliorations in terms of ergonomics and accessibility. There is still a long way to go—<a href="http://www.w3.org/TR/wai-aria/">ARIA</a>, <a href="http://www.w3.org/WAI/intro/atag.php">ATAG</a> and others aren't fully there yet—but we have made a number of noteworthy improvements in this domain.</p>


<p>The administration area will also be easier to use on various supports. Our objective for this version was to drastically improve the usage of the administration on mobile devices and small screens. Mission accomplished! A few pages aren't fully optimized yet, but we will work on them in the future.</p>


<h3>The orchestra</h3>


<p>Dotclear 2.6-RC is brought to you by a beautiful, merry, and prolific team work. We have sustained a few minor storms, but the mood was (almost) always delightfully good. While JcDenis, baby bottle in one hand, kid in the other, and keyboard on his lap was entirely recoding the maintenance and backup interface as well as the management of plugins and themes, nikrou was lovingly cooking up categories and media management in between two javascript implementations. Kozlika was making icons and torturing DOM, CSS, coders and users together. Lipki was aflutter around the widgets, closing ticket after ticket with artistic dexterity; so did sogox and bernardleroux. Dsls delved once again in the deepest of our basements to secure the stage and prepare the shows to come.</p>


<p>Franck Paul directed the whole with the big booming voice of the irrascible and grouchy dictator he ought to be. Cherry on top of this masterful production: a commit by Pep himself!</p>


<p><a href="https://dotclear.org/public/images/2.6/commits.jpg" title="commits.jpg"><img src="https://dotclear.org/public/images/2.6/.commits_m.jpg" alt="commits.jpg" style="display:block; margin:0 auto;" title="commits.jpg, Oct 2013" /></a></p>


<p>In the meanwhile, community managers Samantdi, Guillaume, Krazy Kitty (smoothly acknowledging yourself: one of the perks of translation) and Otir were, well, managing the community on the digital waves. Pinkilla, Tomer, Llu_ne, BG, mirovinbien, Jean-Michel, Aide Pour—yes, that's an odd name even for us—, Sacrip'Anne, Lomalarch, Philippe, xave, anthom, Patidou, Tetsuo, Cunégonde, Denis, Gilsoub, Pierre, brol, Armony and others also put their shoulders to the wheel, documenting, testing, animating the mailing list, writing whimsical minutes of our weekly IRC meetings, making coffee, updating the server's Dokuwiki, geolocalizing photos, and much more.</p>


<p>(Now's the point where we realize with utter dread that name-dropping will necessarily result, as we cannot but have forgotten people, in bitter chiding... and a few beers!)</p>


<h3>The singers</h3>


<p>That's you!</p>


<p>We need you to test this version, to <a href="http://dev.dotclear.org/2.0/newticket">report bugs</a>, to help updating <a href="http://fr.dotclear.org/documentation/2.6">the documentation</a>, to report potential translation mistakes (in French, English, and other languages while you're at it), to send us marshmallows.</p>


<p>So, in short: download, install, use, and let us know all about it!</p>


<p>We will publish here, before the final version of 2.6 comes out, more detailed information on the changes brought by this new version, particularly on the code side.</p>


<h3>Overture</h3>


<p>Paa, paa, paa, paa, papam... you can download version 2.6-RC <a href="http://download.dotclear.org/current/dotclear-2.6-RC.zip">here</a>. Avanti la musica \o/</p>


<p><a href="https://dotclear.org/public/images/2.6/dashboard.png" title="dashboard.png"><img src="https://dotclear.org/public/images/2.6/.dashboard_m.jpg" alt="dashboard.png" style="display:block; margin:0 auto;" title="dashboard.png, Oct 2013" /></a></p>";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2013-10-20T13:56:00+02:00";s:2:"TS";i:1382270160;}i:16;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2013/09/13/Dotclear-2.5.3";s:5:"title";s:14:"Dotclear 2.5.3";s:7:"creator";s:11:"Krazy Kitty";s:11:"description";s:0:"";s:7:"content";s:1516:"    <p>And, once again, a new version! This one is slightly ahead of plan—a good sign of sustained development activity—and arrives before the <a href="http://fr.dotclear.org/blog/post/2013/08/21/21-septembre-Dotclear-rencontre-ses-utilisateurs-chez-Mozilla" hreflang="fr">upcoming meeting at Mozilla Paris on September 21st</a>.</p>


<p>It features bug fixes, improved antispam filter management (to better address the ongoing plague polluting our favorite blogs), and a few minor improvements here and there, such as the newly implemented transparency for the thumbnails of PNG images.</p>


<p>Your dashboard should offer you to upgrade your installation today or tomorrow (depending on your settings). There's also a <a href="http://download.dotclear.org/patches/2.5.2-2.5.3.diff.gz">patch</a> for the developers who prefer this method.</p>


<p>This branch of Dotclear, containing all versions from 2.5 to 2.5.3, will from now on be under maintenance only, mostly to fix critical errors should there be any. Indeed, we are now focusing our efforts on the next "major" version, 2.6, which we plan to release in the coming weeks (ideally in October, but time does fly...).</p>


<p>Regarding this future version, let's just say that we're very impatient to have it out, because it's much sexier than the current one!</p>


<p>Finally, let's all congratulate JcDenis (and the mother!), esteemed long-term contributor, for the birth of his little boy \o/ Welcome to the baby and best wishes to his parents!</p>";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2013-09-13T10:33:00+02:00";s:2:"TS";i:1379061180;}i:17;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2013/08/15/Dotclear-2.5.2";s:5:"title";s:14:"Dotclear 2.5.2";s:7:"creator";s:11:"Krazy Kitty";s:11:"description";s:0:"";s:7:"content";s:1431:"    <p>We just waited until the excitation about <a href="http://dotclear.org/blog/post/2013/08/14/Dotclear-and-us%2C-a-love-story">Dotclear's 10th birthday</a> started to die down to give you the possibility to update to version 2.5.2.</p>


<p>You will find a number of bug fixes and technical and ergonomic improvements<sup>[<a href="https://dotclear.org/blog/post/2013/08/15/Dotclear-2.5.2#pnote-989-1" id="rev-pnote-989-1">1</a>]</sup>; talking about ergonomics, there's a lot of work going on about that for the future 2.6. We'll talk about it again soon.</p>


<p>Many people who have replied to our <a href="http://fr.dotclear.org/blog/post/2013/08/04/Que-faire-tome-2-tester-la-future-2.5.2" hreflang="fr">call</a> to test this version. You are very precious to us, many thanks!</p>


<p>The possibility to update your installation should have appeared on your dashboard. There's also a <a href="http://download.dotclear.org/patches/2.5.1-2.5.2.diff.gz">patch</a> for the developers who prefer this method.</p>


<p>We're already working on the future 2.5.3, which will hopefully be available some time in September.</p>
<div class="footnotes"><h4 class="footnotes-title">Note</h4>
<p>[<a href="https://dotclear.org/blog/post/2013/08/15/Dotclear-2.5.2#rev-pnote-989-1" id="pnote-989-1">1</a>] see <a href="http://dev.dotclear.org/2.0/browser/CHANGELOG?rev=9b5336221633fec32c9fae4ec304638e95bd1d91">CHANGELOG</a></p></div>
";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2013-08-15T19:10:00+02:00";s:2:"TS";i:1376586600;}i:18;O:8:"stdClass":8:{s:4:"link";s:73:"https://dotclear.org/blog/post/2013/08/14/Dotclear-and-us%2C-a-love-story";s:5:"title";s:29:"Dotclear and us, a love story";s:7:"creator";s:11:"Krazy Kitty";s:11:"description";s:0:"";s:7:"content";s:6838:"<p>It's still August 13 in parts of the world. And I've always liked birthday parties to last a little bit longer. I've already shouted my own personal love for Dotclear <a href="http://amrhaps.net/english/post/2013/08/13/Happy-10-Dotclear">within my own walls</a>, as if becoming part of the team that is the English-speaking window of Dotclear to the world wasn't proof enough. Today, I'm here to tell you more about how it all happened...</p>    <p>The story of Dotclear started ten years (and one day) ago when, on August 13, 2003, Olivier Meunier, a young, promising, fiery and possibly slightly temperamental French developer, <a href="http://neokraft.net/2003/08/13/nouveau-cms" hreflang="fr">shared with the world</a> a piece of software he had written for his own use.</p>


<p>At first, Dotclear is a simple zip file, hosted by Benoît Clair. Support merely consists in exchanging emails with Olivier.
But quickly, interest for Dotclear starts to grow. A mailing list, then a forum appear; the first team is put together. Xave and Kozlika join Olivier and Benoît. Dotclear gains a written documentation and a support forum.</p>


<p>From the start, the goals of the team are clear: helping users, regardless of their computer skills, and leading them to autonomy. They must be able to install their own blog and take control over it without being specialists. Back then, personal weblogs are booming, and multiple online platforms welcome, free of charge, users that are soon disappointed by invading advertising and haphazard maintenance. In contrast, the alternative offered by Dotclear makes it possible to feel entirely at home in your own blog, and to give your readers a visual environment both original and aesthetically pleasing—Kozlika's incredibly refined first themes are miles away from what's then typically done.</p>


<p>Respecting good practices, without limiting their application to those in the technical know; giving accessibility a prime role, so that every and anyone can use Dotclear, including disabled users; united around the same desires and objectives, the team members become a tight group of friends, and this will always remain one of the prime aspects of the project. One day, a ten-year old boy writes to the forum to say he used Dotclear to open his blog on his favorite topic: firefighters. The team tells themselves they've managed alright.</p>


<p>Bloggers of all kinds have adopted Dotclear. Big names like Tristan Nitot, then president of Mozilla Europe<sup>[<a href="https://dotclear.org/blog/post/2013/08/14/Dotclear-and-us%2C-a-love-story#pnote-988-1" id="rev-pnote-988-1">1</a>]</sup>, or Daniel Glazman, chairman of the CSS Working Group of W3C<sup>[<a href="https://dotclear.org/blog/post/2013/08/14/Dotclear-and-us%2C-a-love-story#pnote-988-2" id="rev-pnote-988-2">2</a>]</sup>. No-names that would soon become big names, like Maître Eolas<sup>[<a href="https://dotclear.org/blog/post/2013/08/14/Dotclear-and-us%2C-a-love-story#pnote-988-3" id="rev-pnote-988-3">3</a>]</sup>. And, above all, you, me, and all the others.</p>


<p>Along the years, how many blog notes written, read, passionately commented, in a frenzy! In the French-speaking world, Dotclear pages have been the theater of <a href="http://www.obni.net/dotclear2/?post/2006/11/13/870-kozlika-ou-l-art-d-etre-communicative" hreflang="fr">great friendships</a>, <a href="http://traou.net/blog/index.php?post/2006/03/12/91-ballade-de-jim-1-jim-en-bretagne" hreflang="fr">crushes</a>, <a href="http://sacripanne.net/post/2011/12/12/J-aime-le-voir-jouer" hreflang="fr">love</a>, <a href="http://soindesoi.free.fr/index.php?post/2011/01/17/Maternité" hreflang="fr">births</a>, <a href="http://open-time.net/post/2012/06/06/Aujourd-hui-un-jeu" hreflang="fr">the premature departures of beloved buddies</a>, <a href="http://lasoeurkaramazov.net/post/2013/04/08/Café-solidaire-et-frites-charitable" hreflang="fr">long discussions</a>, <a href="http://bricablog.net/dotclear/index.php/post/2005/05/04/522-ce-blog-ne-croit-pas-en-dieu" hreflang="fr">controverses</a>, <a href="http://www.kozlika.org/kozeries/post/2010/01/10/Les-bonnes-recettes-de-Maame-Kozlika-partie-2-%3A-la-galette" hreflang="fr">fits of laughter</a>, <a href="http://xave.org/post/2008/10/18/deception" hreflang="fr">disappointments</a>, <a href="http://www.mirovinben.com/blog/index.php?pages/Chic-des-Clics" hreflang="fr">beautiful pictures</a>, and <a href="http://archives.lanternebrisee.net/post/2013/04/20/Opéra%2C-premier-tableau" hreflang="fr">awe</a>. Or, in other words, life.</p>


<p>Year after year, the team grew bigger. Some had less time to give to the projects, others joined: Pep, Biou and Franck Paul have left the imprint of their personalities on Dotclear, while respecting its fundamental principles, for as the Prince of Salina in <em>The Leopard</em>, they knew that "if we want things to stay as they are, things will have to change".</p>


<p>Dotclear remains a free (as in both beer and speech) software, supported by a team of passionate volunteers with a little touch of madness. Currently, projects abound and here's what's being discussed on the mailing list:</p>
<ul>
<li>soon, very soon, so soon that it's actually already here, version 2.5.2;</li>
<li>fresh looks for the Dotclear and Dotaddict websites;</li>
<li>more and more improvements in terms of ergonomics, accessibility, and good practices;</li>
<li>a richer, more flexible editor.</li>
</ul>

<p>Even when you don't understand (or read) half the messages on the mailing list, it's fantastic to see so much activity around Dotclear. Users, including silent, anonymous, unknown users we've never met, stay at the heart of the team's concerns, and this warms my cold, cold heart.</p>


<p>We have no doubt that in the future Dotclear will become such a sexy, ergonomic and powerful engine that our friend <a href="http://embruns.net/logbook/2013/07/09.html#dotclear-2003-2013-rip" hreflang="fr">Laurent Gloaguen</a>, who loves to tease us about our imminent death and pretends to hate felines, will move his blog to Dotclear and, in the same swift move, adopt a cat. This remains, after all, our true main goal.</p>
<div class="footnotes"><h4 class="footnotes-title">Notes</h4>
<p>[<a href="https://dotclear.org/blog/post/2013/08/14/Dotclear-and-us%2C-a-love-story#rev-pnote-988-1" id="pnote-988-1">1</a>] The folks behind Firefox, Thunderbird and others.</p>
<p>[<a href="https://dotclear.org/blog/post/2013/08/14/Dotclear-and-us%2C-a-love-story#rev-pnote-988-2" id="pnote-988-2">2</a>] The folks who decide on web standards.</p>
<p>[<a href="https://dotclear.org/blog/post/2013/08/14/Dotclear-and-us%2C-a-love-story#rev-pnote-988-3" id="pnote-988-3">3</a>] A lawyer who is without doubt one of the most known, read and respected French bloggers</p></div>
";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2013-08-14T12:13:00+02:00";s:2:"TS";i:1376475180;}i:19;O:8:"stdClass":8:{s:4:"link";s:56:"https://dotclear.org/blog/post/2013/07/21/Dotclear-2.5.1";s:5:"title";s:14:"Dotclear 2.5.1";s:7:"creator";s:11:"Krazy Kitty";s:11:"description";s:0:"";s:7:"content";s:1834:"    <p>The possibility to update your installation should have appeared on your dashboard.</p>


<p>Here's the brand new 2.5.1, which only came out rapidly after our <a href="http://fr.dotclear.org/blog/post/2013/07/13/Que-faire-tome-1-tester-la-future-2.5.1">call</a> thanks to the numerous testers who got together to help us finalize it. You've been perfect, don't change anything!</p>


<p>In this new version you'll find: bug fixes, cosmetic improvements, a better quality of thumbnails in the media manager, and, most of all, the replacement of the old Flash multiple media upload thingie by another thingie that does exactly the same but in Ajax and without any security vulnerability.</p>


<p>There's also a <a href="http://download.dotclear.org/patches/2.5-2.5.1.diff.gz">patch</a> for the developers who prefer this method.</p>


<p>May thousands of roses flower under the steps of <a href="http://www.nikrou.net/">Nikrou</a>, who has taken care of the conversion of the upload manager with selfless commitment and in the echo free desert of the last weeks. This silence, the last straw that made our <a href="http://dotclear.org/blog/post/2013/07/21/Something-s-in-the-air">ex-but-still-in-the-team-boss</a> throw the towel, has been broken by a mailing list featuring ten times as many users as before and users at the ready every morning on the forum to test updates and report bugs.</p>


<p>I'll be back very soon to tell you more about what's being discussed on the mailing list, but that isn't the goal of that note.</p>


<p>For now, let's rejoice about that new step, update our installs, and for the Parisians, let's celebrate Monday night, from 7pm onwards, at <a href="http://www.openstreetmap.org/browse/node/1616811990">Quigley's Bar</a>.</p>


<p>Talk to you very soon, there's much to tell. Happy times!</p>";s:7:"subject";a:1:{i:0;s:4:"News";}s:7:"pubdate";s:25:"2013-07-21T23:48:00+02:00";s:2:"TS";i:1374443280;}}}