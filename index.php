<?php 
	/* this page is index */
	$thisPage = "首页";
	require 'header.php'; 
	$slider = json_decode((file_get_contents('myJSONs/index_slider.json')), true);
	$briefinfo = json_decode((file_get_contents('myJSONs/index_briefinfo.json')), true);
?>
	<div id="slider">
		<?php foreach ($slider as $stuff) { ?>
		<div><?php echo $stuff;?></div>
		<?php } ?>
	</div>
	<div id="showcase">
		<div class="eachcase left">case 1</div>
		<div class="eachcase left">case 2</div>
		<div class="eachcase left">case 3</div>
		<div class="clear"></div>
	</div>
	<ul id="briefinfo">
		<?php foreach ($briefinfo as $stuff) { ?>
		<li><?php echo $stuff;?></li>
		<?php } ?>
		<div class="clear"></div>
	</ul>
<?php require 'footer.php'; ?>