<?php

class Pagination
{

	public $pageSize;
	public $skipItem;
	public $currentPage;

	public function __construct($config)
	{
		$this->pageSize = $config->pagination->pageSize;
	}

	public function getSkipItem()
	{
		$this->skipItem = ($this->currentPage>0) ? ($this->currentPage * $this->pageSize)-$this->pageSize : $this->currentPage * $this->pageSize;
		return $this->skipItem;
	}
}