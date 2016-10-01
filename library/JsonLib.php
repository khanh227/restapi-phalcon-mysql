<?php 

/**
* Author: ManuDavila
* Github: https://github.com/ManuDavila/php-json-file-decode
* Website: http://jquery-manual.blogspot.com
**/

class JsonLib {
 
    public function json($json)
	{		
	 	$reader = $this->json_decode($json);
	 	foreach($reader as $val)
	 	{
		  	$array[] = $reader;
	 	}
	 	return $array[0];
	}
 
    private function json_decode($json)
    {
        return json_decode($this->removeTrailingCommas(utf8_encode($json)), true);
    }
   
    private function removeTrailingCommas($json)
    {
        $json=preg_replace('/,\s*([\]}])/m', '$1', $json);
        return $json;
    }

}
