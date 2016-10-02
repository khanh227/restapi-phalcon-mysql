<?php
$method = "addPhoto";

$app->Methods[$method]=null;

$app->get($apiVersionPath.'/'.$method, function () use ($app)
{
	$postData = $app->request->getJsonRawBody();

	try
	{
		$url = "http://flatfull.com/themes/musik/index.html";
		// if($postData->page)
		// {
			$url .= "";
		// }

		$resultHtml = file_get_contents($url);

		preg_match_all('/<img[^>]+>/i',$resultHtml, $imageResult); 

		$img = array();
		// print_r($imageResult);
		foreach ($imageResult[0] as $key => $imgHtml) 
		{			
			preg_match( '@src="([^"]+)"@' , $imgHtml, $proSrc);
			// preg_match( '@title="([^"]+)"@' , $imgHtml, $proTitle);
			$src = array_pop($proSrc);
			// $src[$key]["src"] = array_pop($proSrc);
			// $src[$key]["title"] = array_pop($proTitle);
			$ext = pathinfo($src, PATHINFO_EXTENSION);

			if(in_array($ext, array("jpg","png")))
			{
				// $imageLocal = __DIR__."/../../cosplay-img/".md5($src[$key]["src"]).".".$ext;
				// echo $imageLocal;exit;

				// file_put_contents($imageLocal, file_get_contents($src[$key]["src"]));
				// $cosplay = Cosplay::findFirst(
		  //   		array(
	   //  				array("md5_src" =>  md5($src))
		  //   		)
		  //   	);
		    	echo "<img src='http://flatfull.com/themes/musik/".$src."'/>";
		    	// if($cosplay)
		    	// {
		    	// 	$cosplay->src = $src;
		    	// 	$cosplay->md5_src = md5($src);
		    	// 	$cosplay->save();
		    	// }
		    	// else
		    	// {
		    	// 	$cosplay = new Cosplay();
		    	// 	$cosplay->view = 0;
		    	// 	$cosplay->comments = 0;	
		    	// 	$cosplay->src = $src;
		    	// 	$cosplay->status = false;
		    	// 	$cosplay->md5_src = md5($src);
		    	// 	$cosplay->save();
		    	// }
			}
		}
	} 
	catch (\Exception $e) 
	{
		$app->ResponseLib->status = 0;
		$app->ResponseLib->errorOutput(0,$e);
	}

});