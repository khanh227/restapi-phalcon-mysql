<?php
class ValidateLib
{
    private $appConfig;
    private $app;
	private $postData;

	public function __construct($config, $app)
	{
        $this->appConfig = $config;
        $this->app = $app;
	}

    public function validateParams($number, $postData)
    {
        try {
            if(count((array)$postData) != $number )
            {
                $this->app->ResponseLib->status = 0;
                $this->app->ResponseLib->errorOutput(3);
                exit;
            }
            else
            {
                $this->postData = $postData;
                return $this;
            }
        } catch (Exception $e) {
            $this->app->ResponseLib->status = 0;
            $this->app->ResponseLib->errorOutput(0);
            exit;
        }       

    }

    public function validateToken()
    {
        try {
            if(isset($this->postData->token)){
                if($this->postData->token != "A8DCE588BD7A82D35526F6ABE683E6FE")
                {
                    $this->app->ResponseLib->status = 0;
                    $this->app->ResponseLib->errorOutput(41);
                    exit;
                }
                return $this;
            }
            else{
                $this->app->ResponseLib->status = 0;
                $this->app->ResponseLib->errorOutput(4);
                exit;
            }
        } catch (Exception $e) {
            $this->app->ResponseLib->status = 0;
            $this->app->ResponseLib->errorOutput(0);
            exit;
        }
    }
}