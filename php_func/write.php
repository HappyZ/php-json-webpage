<?php 
$title = htmlspecialchars($_POST["ti"]);
$jsonname = htmlspecialchars($_POST["json"]);
$content = htmlspecialchars($_POST["content"]);
if ($jsonname == "" || $content == "" || $title == "") {
	die("Err");
}
$path = "../myJSONs";
$filename = "page_content_".$jsonname.".json";
$string = '{"'.str_replace("\n",'',$title).'":"'.str_replace("\n",'\n',$content).'"}';
$myfile = fopen($path."/".$filename, "w") or die("Unable to open file!");
fwrite($myfile, $string);
fclose($myfile);
echo "OK!"
?>