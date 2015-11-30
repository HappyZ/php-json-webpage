<?php 
	/* parse markdown */
	include 'php_func/Parsedown.php';
	$Parsedown = new Parsedown();
	// sanitize for security reasons
	$xmlname = preg_replace("/[^a-zA-Z0-9\-]+/", "", htmlspecialchars($_GET["name"]));
	$error = true;
	$thisPage = '找不到该页';
	$mycontent = '对不起，您访问的内容不存在，请返回<a href=\'.\'>首页</a>。';
	if (file_exists('xmls/page_content_'.$xmlname.'.xml'))
	{
		$stuff = simplexml_load_file('xmls/page_content_'.$xmlname.'.xml');
		if (!empty($stuff->title))
		{
			$error = false;
			$thisPage = $stuff->title;
			$mycontent = $Parsedown->text($stuff->content);
		}
	}
	/* for sidebar */
	$levels = explode('-', $xmlname);
	$levelcount = count($levels);
	require 'header.php';
	$match = $navlinks->xpath('/navlinks/link[@href="page-'.$levels[0].'.html"]')[0];
	$sublevelcount = 0;
	if (count($match) > 0)
		$sublevelcount = $match->count();
?>
	<div id="content" <?php if ($sublevelcount == 0) echo "style='width: 960px'"; ?>>
		<div id="title">
			<div class="left"><?php echo $companyName;?> > <?php echo $thisPage;?></div>
			<div class="clear"></div>
		</div>
		<?php echo $mycontent;?>
	</div>
	<?php if ($sublevelcount > 0) { ?>
	<ul id="sidebar" class="menu">
		<?php
		foreach ($match->link as $link) {
		?>
		<li class="menu<?php if ($link['href'] == 'page-'.$xmlname.'.html') echo ' current';?>"><a <?php echo 'href=\''.$link['href'].'\''?>><?php echo $link['title']?></a>
			<?php 
			if ($link->count() > 0) {
			?>
			<ul class="submenu">
			<?php
				foreach ($link->sublink as $sublink) {
			?>
				<li class="subitem<?php if ('page-'.$xmlname.'.html' == $sublink['href']) echo ' current';?>"><a <?php echo 'href=\''.$sublink['href'].'\''?>><?php echo $sublink['title']?></a></li>
			<?php
				}
			?>
			</ul>
			<?php
			}
			?>
		</li>
		<?php
		}
		?>
	</ul>
	<?php 
	}
	?>
	<div class="clear"></div>
<?php require 'footer.php'; ?>