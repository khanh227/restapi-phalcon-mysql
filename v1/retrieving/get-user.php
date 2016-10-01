<?php
$method = "getUser";
$app->get($apiVersionPath.'/'.$method.'/{name}', function ($name) use ($app)
{
	$postData = $app->request->getJsonRawBody();

	try
	{
		$app->ResponseLib->validateParam(0, $postData)->validateToken($postData->token);

		$phql = "SELECT * FROM Users WHERE name LIKE :name: ORDER BY name";

        $users = $app->modelsManager->executeQuery(
            $phql,
            [
                "name" => "%" . $name . "%"
            ]
        );


        $data = [];

        foreach ($users as $user) {
            $data[] = $user;
        }

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