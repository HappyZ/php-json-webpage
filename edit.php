<?php 
	require 'conf_init.php'; 
	
	$thisPage = "编辑";
	
	$pass = $_POST['p'];
	if (!(isset($_COOKIE['privateLogin']) && ($_COOKIE['privateLogin'] == md5($editPassword.$nonsense)))) {
		if ($pass != $editPassword) {
			if(isset($_POST))
			{?>

					<form method="POST" action="">
					密 <input type="password" name="p"></input><br/>
					<input type="submit" name="submit" value="Go"></input>
					</form>
			<?php }
			die();
		} else {
			setcookie('privateLogin', md5($pass.$nonsense), time()+3600, false, false, false, true);
			header("Location: $_SERVER[PHP_SELF]");
		}
	}
	
	require 'header.php'; 
	
	$xmlname = preg_replace("/[^a-zA-Z0-9\-]+/", "", htmlspecialchars($_GET["name"]));
	if ($xmlname != "" && file_exists('xmls/page_content_'.basename($xmlname).'.xml'))
	{
		$stuff = simplexml_load_file('xmls/page_content_'.basename($xmlname).'.xml');
		if (!empty($stuff->title))
		{
			$error = false;
			$title = $stuff->title;
			$mycontent = $stuff->content;
		}
	} else {
		$mycontent = "";
		$title = "";
	}
?>
文件:
<div id="editor_files"><?php $files = scandir('xmls');
foreach ($files as $file) {
if (strpos($file,'page_content_') !== 0) continue;
$tmp = str_replace('.xml','',str_replace('page_content_','',$file));
echo "<a href='?name=".$tmp."'>".$tmp."</a>";
}
?><br /><a href='edit.php'>添加新文件</a></div>
Title: <input type="text" name="title" id="title" value="<?php echo $title;?>">
XMLName: <input type="text" name="xmlname" id="xmlname" value="<?php echo $xmlname;?>">
<button type="button" id="submit">Submit!</button>
<textarea id="editor"></textarea>
<script src="js/simplemde.min.js"></script>
<script>
	var simplemde = new SimpleMDE({
		element: $("#editor")[0],
		spellChecker: false
	});
	simplemde.value(<?php echo '"'.str_replace('"','\"',str_replace("\n",'\n',$mycontent)).'"';?>);
	$("#submit").click(function(){
		$.ajax({
			method: "POST",
			url: "php_func/write.php",
			data: { ti: $("#title").val(), xml: $("#xmlname").val(), content: simplemde.value() }
		}).done(function( msg ) {
			alert( "Data Saved: " + msg );
		});
	});
</script>
<?php require 'footer.php'; ?>