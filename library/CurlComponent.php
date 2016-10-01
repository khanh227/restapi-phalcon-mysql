<?php 

class CurlComponent {

	private $url;

	public $result = null;

	public function __construct($url) {
		$this->url = $url;
	}

	public function init($method, $data) {
		$fieldsString = '';

		foreach ($data as $key => $value) {
			$fieldsString .= $key.'='.urlencode($value).'&'; 
		}
		rtrim($fieldsString, '&');

		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $this->url.'?'.$fieldsString);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		if(strtolower($method) == 'GET') {
			curl_setopt($ch,CURLOPT_POST, count($data));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fieldsString);
		}

		$result = curl_exec($ch); 
		

		if($result) {
			try {
				$result = json_decode($result);
				$this->result = $result;
				curl_close($ch);
			} catch (Exception $e) {
				var_dump($e); 
				exit(0);
			}
		}
	}

	public function jsonPost($data) {

		$data_string = json_encode($data);                                                                   
		$ch = curl_init($this->url); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_TIMEOUT, 72000);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json',
		    'Content-Length: ' . strlen($data_string)
		    )                           
		);

		$result = curl_exec($ch);

		if($result) {
			try {
				$result = json_decode($result);
				$this->result = $result;
				curl_close($ch);
			} catch (Exception $e) {
				var_dump($e); 
				exit(0);
			}
		}
	}
}

 ?>