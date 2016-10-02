<?php
$app->Methods = [];
foreach (glob("v1/*/*.php") as $filename)
{
	$app->Methods[basename($filename, ".php")]="";
    include str_replace("v1/", "", $filename);
}

// not found or not permission
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();	
    $app->ResponseLib->status = 0;
	$app->ResponseLib->errorOutput(0);
});