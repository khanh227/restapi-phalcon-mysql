<?php
use Phalcon\Mvc\User\Component;
/**
* 
*/
class CryptLib extends Component
{
	public $key='';

	public function __construct()
	{
		$this->key = $this->config->crypt->key;
	}

	public function encodeBase64($text=null){
    	return base64_encode(base64_encode($text) . $this->key);
    }

    public function decodeBase64($text=null){
    	$text = base64_decode($text);
    	$text = str_replace($this->key, "", $text);
    	return base64_decode($text);
    }

    public function guid($file)
    {
        if (function_exists('com_create_guid') === true)
        {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(rand(0,16384), 20479), mt_rand(rand(0,32768), 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(rand(0,16384), 50479).$file);
    }

    public function token($file)
    {
        return strtoupper($file);
    }
}