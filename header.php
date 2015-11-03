<?php
	$navlinks = simplexml_load_file('xmls/header_navlinks.xml');
	$companyName = "公司名称";
	$copyright_year = "2015";
	$keywords = "SEO: 公司关键词";
	$description = "SEO: 公司简介";
	if ($thisPage != '首页') { // 非首页用文章内容代替
		$tmpstring = preg_replace('/\s+/', '', strip_tags($mycontent));
		$description = substr($tmpstring, 0, min(strlen($tmpstring), 157))."...";
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="zh-Hans"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="zh-Hans"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="zh-Hans"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" lang="zh-Hans"> <!--<![endif]-->

<head>
	<title><?php echo $thisPage.' | '.$companyName;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php if ($thisPage == '首页') {?>
	<meta name="keywords" content="<?php echo $keywords;?>" />
	<?php }?>
	<meta name="description" content="<?php echo $description;?>" />
	<meta name="author" content="Lai4Tech" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" href="css/jsxymq.css" type="text/css" media="all" />
	<script src="js/jquery-2.1.4.min.js"></script>
	<!--[if lt IE 9]>
	<script src="js/html5.js"></script>
	<![endif]-->
</head>

<body>
<div id="wrapper">
	<div id="header">
		<a class="logo left"><h1>公司Logo</h1></a>
		<a class="right">添加到收藏夹</a>
		<li class="right">搜索框</li>
		<div class="clear"></div>
	</div>
	<div id='nav'>
		<?php 
		// here we need to find a more efficient way, so whenever user refresh the page this will not be executed again (maybe keep this, and then later on we can add a cache function)
		foreach ($navlinks->link as $link) {
		?>
		<div class="item left<?php if ($link['href'] == 'page-'.$xmlname.'.html') echo ' current';?>">
			<a <?php echo "href='".$link['href']."'";?>><?php echo $link['title'];?></a>
			<?php
			if ($link->count() > 0) {
			?>
			<ul class="subnav">
				<?php
				foreach ($link->link as $sublink) { // only one level
				?>
				<li class='subitem'><a <?php echo "href='".$sublink['href']."'"; ?>><?php echo $sublink['title'];?></a></li>
				<?php
				}
				?>
			</ul>
			<?php
			}
			?>
		</div>
		<?php
		}
		?>
		<div class="clear"></div>
	</div>
	<div id="top-nav">
		<nav class="clearfix">
			<ul>
			<?php 
			// here we need to find a more efficient way, so whenever user refresh the page this will not be executed again (maybe keep this, and then later on we can add a cache function)
			foreach ($navlinks->link as $link) {
			?>
			<li><a <?php echo "href='".$link['href']."'";?>><?php echo $link['title'];?></a></li>
				<?php
				if ($link->count() > 0) {
				?>
					<?php
					foreach ($link->link as $sublink) { // only one level
					?>
					<li><a <?php echo "href='".$sublink['href']."'";?>><?php echo $sublink['title'];?></a></li>
					<?php
					}
				}
			}
			?>
			</ul>
			<a href="#" id="pull">页面导航</a>
		</nav>
	</div>