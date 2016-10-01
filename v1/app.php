<?php

foreach (glob("v1/*/*.php") as $filename)
{
    include str_replace("v1/", "", $filename);
}

// not found or not permission
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();	
    $app->ResponseLib->status = 0;
	$app->ResponseLib->errorOutput(0);
});