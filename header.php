<?php
	require 'conf_init.php'; 
	//xml改用json
	//$navlinks = simplexml_load_file('xmls/header_navlinks.xml');
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
	<meta charset="utf-8" />
	<?php if ($thisPage == '首页') {?>
	<meta name="keywords" content="<?php echo $keywords;?>" />
	<?php }?>
	<meta name="description" content="<?php echo $description;?>" />
	<meta name="author" content="Lai4Tech" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" href="css/base.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/jsxymq.css" type="text/css"/>
	<?php if ($thisPage == '编辑') {?>
	<link rel="stylesheet" href="css/simplemde.min.css" type="text/css"/>
	<link rel="stylesheet" href="css/editor.css" type="text/css"/>
	<?php }?>
	<script src="js/jquery-2.2.0.min.js"></script>
	<!--[if lt IE 9]>
	<script src="js/html5.js"></script>
	<![endif]-->
</head>

<body>
<?php
// 读取导航链接信息
$navlinks = json_decode((file_get_contents('myJSONs/header_navlinks.json')), true);
?>
<div id="wrapper">
	<div id="header">
		<a class="logo left"><?php echo $mylogo; ?></a>
		<!-- 
<a class="right">添加到收藏夹</a>
		<li class="right">搜索框</li>
 -->
		<div class="clear"></div>
	</div>
	<?php if ($thisPage != '编辑') {?>
	<div id='nav'>
		<?php foreach($navlinks as $link => $info) { ?>
		<div class="item left<?php if ($link == 'page-'.$xmlname.'.html') echo ' current';?>">
			<a <?php echo "href='".$link.".html'";?>><?php echo $info['title'].((isset($info['eng']))?('<span>'.$info['eng'].'</span>'):'');?></a>
			<?php
			if (isset($info["-"])) {
			?>
			<ul class="subnav">
				<?php foreach ($info["-"] as $sublink => $subinfo) { /* 仅一层 */ ?>
				<li class='subitem'><a <?php echo "href='".$link."-".$sublink.".html'"; ?>><?php echo $subinfo['title'].((isset($subinfo['eng']))?('<span>'.$subinfo['eng'].'</span>'):'');?></a></li>
				<?php } ?>
			</ul>
			<?php } ?>
		</div>
		<?php } ?>
		<div class="clear"></div>
	</div>
	<div id="top-nav">
		<nav class="clearfix">
			<a href="#" id="pull">页面导航</a>
			<ul>
				<?php foreach($navlinks as $link => $info) { ?>
				<li><a <?php echo "href='".$link.".html'";?>><?php echo $info['title'].((isset($info['eng']))?('<span>'.$info['eng'].'</span>'):'');?></a></li>
					<?php
					if (isset($info["-"])) {
					?>
						<?php
						foreach ($info["-"] as $sublink => $subinfo) { // 仅一层
						?>
						<li><a <a <?php echo "href='".$link."-".$sublink.".html'"; ?>><?php echo $subinfo['title'].((isset($subinfo['eng']))?('<span>'.$subinfo['eng'].'</span>'):'');?></a></li>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</ul>
		</nav>
	</div>
	<?php } ?>