<?php
/**
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");  **/
$txt = isset($_POST['field1']) ? $_POST['field1'] : '';
$text= isset($_POST['field2']) ? $_POST['field2'] : '';
echo "Name .$txt.";
/**
fwrite($myfile, $txt);
fwrite($myfile, $text);
fclose($myfile);
**/
?>
