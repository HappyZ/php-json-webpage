<?php 
	/* parse markdown */
	include 'php_func/Parsedown.php';
	$Parsedown = new Parsedown();
	// sanitize for security reasons
	$jsonname = preg_replace("/[^a-zA-Z0-9\-]+/", "", htmlspecialchars($_GET["name"]));
	$error = true;
	$thisPage = '找不到该页';
	$mycontent = '对不起，您访问的内容不存在，请返回<a href=\'.\'>首页</a>。';
	if (file_exists('myJSONs/page_content_'.$jsonname.'.json'))
	{
		$stuff = json_decode((file_get_contents('myJSONs/page_content_'.$jsonname.'.json')), true);
		foreach($stuff as $title => $content){
			$thisPage = $title;
			$mycontent = $Parsedown->text($content);
		}
	}
	require 'header.php';
	/* for sidebar */
	$levels = explode('-', $jsonname);
// 	var_dump($levels);
?>
	<div id="content" <?php if (!isset($navlinks["page-".$levels[0]]["-"])) echo "style='width: 960px'"; ?>>
		<div id="title">
			<div class="left"><?php echo $companyName;?> > <?php echo $thisPage;?></div>
			<div class="clear"></div>
		</div>
		<?php echo $mycontent;?>
	</div>
	<?php if (isset($navlinks["page-".$levels[0]]["-"])) { ?>
	<ul id="sidebar" class="menu">
		<?php
		foreach ($navlinks["page-".$levels[0]]["-"] as $link => $info) {
		?>
		<li class="menu<?php if ($link == $levels[1]) echo ' current';?>">
			<a <?php echo 'href=\'page-'.$levels[0].'-'.$link.'.html\''?>><?php echo $info["title"]?></a>
			<?php if (isset($info["-"])) { ?>
			<ul class="submenu">
				<?php foreach ($info["-"] as $sublink => $subinfo) { ?>
				<li class="subitem<?php if ($sublink == $levels[2]) echo ' current';?>">
					<a <?php echo 'href=\'page-'.$levels[0].'-'.$link.'-'.$sublink.'.html\''?>><?php echo $subinfo['title']?></a>
				</li>
				<?php } ?>
			</ul>
			<?php } ?>
		</li>
		<?php } ?>
	</ul>
	<?php } ?>
	<div class="clear"></div>
<?php require 'footer.php'; ?>