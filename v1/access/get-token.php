<?php
$method = "getToken";
$app->post($apiVersionPath.'/'.$method, function () use ($app)
{
	$postData = $app->request->getJsonRawBody();

	try
	{
		$app->ResponseLib->validateParams(1, $postData);

		$phql = "SELECT guid,name,email,phone FROM Users WHERE email LIKE :email: ORDER BY email";

        $userData = $app->modelsManager->executeQuery(
            $phql,
            [
                "email" => "%" . $postData->email . "%"
            ]
        );

        if($userData->count()>0)
        {
        	$guid = "";
        	foreach ($userData as $row) 
        	{
	            $guid = $row->guid;
	        }

	        $phql = "SELECT token FROM UsersToken WHERE uid = :uid:";

	        $tokenData = $app->modelsManager->executeQuery(
	            $phql,
	            [
	                "uid" =>  $guid 
	            ]
	        );

	        if($tokenData->count()>0)
	        {
	        	foreach ($tokenData as $row) 
	        	{
	            	$token = $row->token;
		        }

		        if($token)
		        {
		        	$token = array("AccessToken"=>$token);
		        }
		        else
		        {
		        	$userInfo=[];
		        	foreach ($userData as $row) 
		        	{
			            $userInfo[] = $row->guid;
			        }

		        	$salt = $app->crypt->guid(md5(serialize(time())));
		        	$token = $app->crypt->token(md5(md5(serialize($userInfo)).$salt));
					$phql = "UPDATE UsersToken SET token = :token:, salt = :salt: WHERE uid = :uid:";

			        $status = $app->modelsManager->executeQuery(
			            $phql,
			            [
			                "token" => $token,
			                "salt" => $salt,
			                "uid" => $guid
			            ]
			        );

			        if($status->success())
			        {
			        	$token = array("AccessToken"=>$token);
			        }
		        }

				$app->ResponseLib->status = 1;
				$app->ResponseLib->data = $token;
				$app->ResponseLib->dataOutput(1);
	        }
	        else
	        {

	        }
        }
        else
        {
        	$app->ResponseLib->status = 0;
			$app->ResponseLib->dataOutput(5);
        }
        
	} 
	catch (\Exception $e) 
	{
		$app->ResponseLib->status = 0;
		$app->ResponseLib->errorOutput(0,$e);
	}

});