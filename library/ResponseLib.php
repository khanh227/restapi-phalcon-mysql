<?php
class ResponseLib
{
    public $status = 0;
	private $responseCode = 0;
	public $data;
	public $message;
    private $configStatus;
    private $appConfig;
    private $app;
	private $postData;

	public function __construct($config, $app)
	{
		$this->configStatus = $config->responseCode;
		$this->message = $this->configStatus[$this->status];
        $this->appConfig = $config;
        $this->app = $app;
	}

    public function dataOutput($code=0)
    {

        $this->responseCode = $code;
        $this->message = $this->configStatus[$this->responseCode];
        $this->output();
    }

    public function errorOutput($code=0, $error='')
    {
        $this->responseCode = $code;
    	$this->message = trim($this->configStatus[$this->responseCode] . " " . $error);
    	$this->output();
    }

    private function output()
    {	
        header("Content-Type:text/json");
        $content = array(
                    "status"=>$this->status,
                    "code"=>$this->responseCode,
                    "data"=>$this->data,
                    "mes"=>$this->message 
                );
        
        if(APP_DEBUG)
        {
            $this->outEmail($content);
        }

        $response = new \Phalcon\Http\Response();
        $response->setJsonContent($content);
        $response->send();
    }

    public function outEmail($content=null)
    {
        $this->app->getDI()->getMail()->send(
            $this->appConfig,
            array(
                "tibeopro@gmail.com" => "Tibeopro"
            ),
            $this->message, // Subject
            __DIR__.'/../views/emailTemplates/error.volt',
            array(
                'response' => json_encode($content),
                'device' => $this->app->request->getUserAgent(),
                'ip' => $this->app->request->getServerAddress(),
                'uri' => $this->app->request->getURI(),
                'jsonbody' => (array)$this->app->request->getJsonRawBody(),
                'rawbody' => $this->app->request->getRawBody()
            )
        );
    }

    public function getYear($date=null)
    {
        if($date){
            return date('Y',$date->sec);
        }
        return;
    }

    public function getMonth($date=null)
    {
        if($date){
            return date('m',$date->sec);
        }
        return;
    }

    public function pr($a)
    {
        print_r($a);exit;
    }
}