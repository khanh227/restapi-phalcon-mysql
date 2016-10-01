<?php
$method = "addUser";
$app->post($apiVersionPath.'/'.$method, function () use ($app)
{
	$postData = $app->request->getJsonRawBody();

	try
	{

        $app->ValidateLib->validateParams(4, $postData)->validateToken();

        $guid = $app->CryptLib->guid(md5(serialize($postData)));

        $insert = $app->PHQL
                        ->setQuery("INSERT INTO Users (guid, name, email, phone) VALUES (:guid:, :name:, :email:, :phone:)")
                        ->executeQuery(
                            [
                                "name" => $postData->name,
                                "email" => $postData->email,
                                "phone" => $postData->phone,
                                "guid" => $guid
                            ]
                        );

		

        if($insert->success())
        {
            $salt = $app->CryptLib->guid(time());
            $insert = $app->PHQL
                        ->setQuery("INSERT INTO UsersToken (uid, token, salt) VALUES (:uid:, :token:, :salt:)")
                        ->executeQuery(
                            [
                                "token" => "",
                                "salt" => $salt,
                                "uid" => $guid
                            ]
                        );

            $app->ResponseLib->status = 1;
			$app->ResponseLib->dataOutput(1);
        }
        else
        {
            $errors = "";
            foreach ($insert->getMessages() as $message) {
                $errors .= $message->getMessage();
            }
            $app->ResponseLib->status = 0;
			$app->ResponseLib->errorOutput(42,$errors);
        }

		
	} 
	catch (\Exception $e) 
	{
		$app->ResponseLib->status = 0;
		$app->ResponseLib->errorOutput(0,$e);
	}

});