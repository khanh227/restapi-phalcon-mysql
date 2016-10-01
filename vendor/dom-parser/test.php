<!DOCTYPE HTML>
<html lang="en"> 
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
    <title>Test</title>
    </head>
    <body>

<?php
include_once "Domparser.class.php";

$obj=new Domparser("http://sizeofint.com");

echo "Page title:";
echo '<pre>'.$obj->getTitle().'</pre>';

echo "All Images:";
echo '<pre>'.print_r($obj->getImages(),true).'</pre>';

echo "All links:";
echo '<pre>'.print_r($obj->getLinks(),true).'</pre>';

echo "Internal links:";

echo '<pre>'.print_r($obj->getInternalinks(),true).'</pre>';

echo "Extrenal links:";

echo '<pre>'.print_r($obj->getExternalinks(),true).'</pre>';

echo "Get div tag by id header:<br/>";
echo "<pre>";
echo htmlspecialchars($obj->getElementbyid("header"));
echo "</pre>";
?>



</body>
</html>