<?php
class PHQL
{
	public $data;
    private $appConfig;
    private $app;

    private $query;

	public function __construct($config, $app)
	{
        $this->appConfig = $config;
        $this->app = $app;
	}

    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    public function executeQuery($params)
    {
        if($params)
        {
            $queryResult = $this->app->modelsManager->executeQuery($this->query, $params);
        }
        else
        {
            $queryResult = $this->app->modelsManager->executeQuery($this->query);
        }
        $this->data = $queryResult;
        return $this;
    }

    public function getData()
    {
        $data = [];

        foreach ($this->data as $row) {
            $data[] = $row;
        }
        return $data;
    }

    public function success(){
        return $this->data->success();
    }

    public function getMessages(){
        return $this->data->getMessages();
    }

}