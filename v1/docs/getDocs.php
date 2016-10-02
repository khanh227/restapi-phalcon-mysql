<?php
$method = "getDocs";

$app->get($apiVersionPath.'/'.$method, function () use ($app)
{
	$postData = $app->request->getJsonRawBody();

	try
	{
		$app->ValidateLib->validateParams(0, $postData);

		
		ksort($app->Methods);
		foreach($app->Methods as $method=>$params)
		{
			if($method!="getDocs"){
				echo "<h2>RestAPI</h2><hr>";
				echo "<h3>".$method."</h3>";
				if(is_array($params))
				{
					echo "<table border=1 style='margin-left:20px; width:500px' cellpadding=5>";
					foreach($params as $key=>$type)
					{
						echo "<tr>";
						echo "<td width='25%'>".$key."</td>";
						echo "<td>".$type."</td>";
						echo "</tr>";
					}
					echo "</table>";
				}
				else
				{
					echo "null";
				}
			}
		}
	} 
	catch (\Exception $e) 
	{
		$app->ValidateLib->status = 0;
		$app->ValidateLib->errorOutput(0,$e);
	}

});