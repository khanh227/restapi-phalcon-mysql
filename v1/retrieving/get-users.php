<?php
$method = "getUsers";
$app->get($apiVersionPath.'/'.$method, function () use ($app)
{
	$postData = $app->request->getJsonRawBody();

	try
	{
		$app->ValidateLib->validateParams(0, $postData)->validateToken();

		$data = $app->PHQL->setQuery("SELECT name, email, phone FROM Users")
				  ->executeQuery()
				  ->getData();

		$app->ResponseLib->status = 1;
		$app->ResponseLib->data = $data;
		$app->ResponseLib->dataOutput(1);
	} 
	catch (\Exception $e) 
	{
		$app->ResponseLib->status = 0;
		$app->ResponseLib->errorOutput(0,$e);
	}

});