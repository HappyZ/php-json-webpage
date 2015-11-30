<?php 
$title = htmlspecialchars($_POST["ti"]);
$xmlname = htmlspecialchars($_POST["xml"]);
$content = htmlspecialchars($_POST["content"]);
if ($xmlname == "" || $content == "" || $title == "") {
	die("Err");
}
$path = "../xmls";
$filename = "page_content_".$xmlname.".xml";
$string = "<?xml version='1.0' encoding='UTF-8'?>
<article>
	<title>".$title."</title>
	<content>".$content."</content>
</article>";
$myfile = fopen($path."/".$filename, "w") or die("Unable to open file!");
fwrite($myfile, $string);
fclose($myfile);
echo "OK!"
?>