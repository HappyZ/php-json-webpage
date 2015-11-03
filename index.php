<?php 
	/* this page is index */
	$thisPage = "首页";
	$slider = simplexml_load_file('xmls/index_slider.xml');
	require 'header.php'; 
?>
	<div id="slider">
		<?php
		foreach ($slider->stuff as $stuff) {
		?>
		<div><?php echo $stuff;?></div>
		<?php
		}
		?>
	</div>
	<div id="showcase">
		<div class="eachcase left">case 1</div>
		<div class="eachcase left">case 2</div>
		<div class="eachcase left">case 3</div>
		<div class="clear"></div>
	</div>
	<div id="briefinfo">
		some brief info
	</div>
<?php require 'footer.php'; ?>