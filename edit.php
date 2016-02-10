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
	
	$jsonname = preg_replace("/[^a-zA-Z0-9\-]+/", "", htmlspecialchars($_GET["name"]));
	if ($jsonname != "" && file_exists('myJSONs/page_content_'.$jsonname.'.json'))
	{
		$stuff = json_decode((file_get_contents('myJSONs/page_content_'.$jsonname.'.json')), true);
		foreach($stuff as $title => $mycontent){ $mycontent = htmlspecialchars_decode($mycontent); }
	} else {
		$mycontent = "";
		$title = "";
	}
?>
文件:
<div id="editor_files"><?php $files = scandir('myJSONs');
foreach ($files as $file) {
if (strpos($file,'page_content_') !== 0) continue;
$tmp = str_replace('.json','',str_replace('page_content_','',$file));
echo "<a href='?name=".$tmp."'>".$tmp."</a>";
}
?><br /><a href='edit.php'>添加新文件</a></div>
标题：<input type="text" name="title" id="title" value="<?php echo $title;?>">
JSON文件名：<input type="text" name="jsonname" id="jsonname" value="<?php echo $jsonname;?>">
<button type="button" id="submit">提交!</button>
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
			data: { ti: $("#title").val(), json: $("#jsonname").val(), content: simplemde.value() }
		}).done(function( msg ) {
			alert( "Data Saved: " + msg );
		});
	});
</script>
<?php require 'footer.php'; ?>